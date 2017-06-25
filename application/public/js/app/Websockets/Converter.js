/**
 * Handles Uploadform
 *
 * @see views/bread/assets/datatable.blade.php
 * @constructor
 */

function Converter(config)
{
    /**
     * Configs sockets
     */
    this.config = config;

    this.initMessageQueue=true;

    /**
     * Constructor
     */
    this.init = function(initMessageQueue)
    {
        if(initMessageQueue==undefined) initMessageQueue=false;

        this.initMessageQueue = initMessageQueue;

        this.attachWebsockets();

        this.pingInDesignserver();

        if(this.initMessageQueue)
        {
            this.setMessageInfosFromQueue(['indesignthumbnails', 'videothumbnails', 'imagethumbnails']);

            this.startMessageConsumer([this.config.videothumbnailConsumerCommand,this.config.videoLowresConsumerCommand, this.config.imagethumbnailConsumerCommand]);
        }
    };

    /**
     * Calls Emotico api to get left messages in messagequeue
     */
    this.setMessageInfosFromQueue = function(arrayOfThumbnailtypes)
    {
        var that = this;

        setInterval(function()
        {
            $.each(arrayOfThumbnailtypes, function (index, thumbnailtype)
            {
                $.get('/admin/queue/' + thumbnailtype + '/info' + '?time'+Date.now(), function( data ) {
                    that.setMessageCount(thumbnailtype, data.messages)
                });
            });

        }, 5000);
    };

    /**
     * Sets the serviceresponse from emotico backend to count messages in queues
     * @param queueType
     * @param count
     */
    this.setMessageCount = function (queueType, count)
    {
        $("."+queueType).html(count);
    };


    /**
     * Pings INDD Server and types out message
     */
    this.pingInDesignserver = function()
    {
        var that = this;

        $.get(this.config.pingInDesignServerUrl, function( data ) {

            if(data.result==true)
            {
                that.setInDesignServerConnectionSuccess()
            }
            else
            {
                that.setInDesignServerConnectionError(data.IP)
            }
        });
    };

    /**
     * Start messaageque consumer
     * @param arrayOfCommands
     */
    this.startMessageConsumer = function (arrayOfCommands)
    {
        $.each(arrayOfCommands, function (index, command)
        {
            $.get("/admin/queue/" + command + "/startConsumer?time"+Date.now(), function( data ){});
        });
    };

    /**
     * Set placeholderrow on adding image in dropzone
     * @param message
     */
    this.setDataTableRow = function (message)
    {
        $(document).ready(function()
        {
            try
            {
                var source = $('#data_table_row').html();

                var template = Handlebars.compile(source)

                var imageUrl = '/images/loading_blue.gif';

                if(message.imageUrl != undefined)
                {
                    imageUrl = message.imageUrl;
                }

                var data = {
                    "ticketId" : message.ticketId,
                    "uuid" : message.uuid,
                    "version" : message.version,
                    "extension" : message.extension,
                    "imageUrl" : imageUrl
                };

                $('#message').prepend(template(data));
            }
            catch(Exception)
            {
                alert(Exception);
            }
        });
    };

    /**
     * Set WebsocketConnection created message
     */
    this.setWebsocketConnectionCreatedMessage = function ()
    {
        var source = $('#websocketconnection').html();

        var template = Handlebars.compile(source);

        $('#websocket').html("").append(template({}));
    };

    /**
     * Set Websocket connection error
     * @param error
     */
    this.setWebsocketConnectionError = function (error)
    {
        var message = "Disconnected for " + error.reason + " with code " + error.code + " Url:" + this.config.websocketUrl;

        var source = $('#websocketconnectionerror').html();

        var template = Handlebars.compile(source);

        $('#websocket').html(template({"message": message}));
    };

    /**
     * Set indesignserver connection error
     * @param error
     */
    this.setInDesignServerConnectionError = function (IP)
    {
        var source = $('#indesignserverconnectionerror').html();

        var template = Handlebars.compile(source);

        $('#indesign_server').html(template({"IP": IP}));
    };

    /**
     * Set indesignserver connection error
     * @param error
     */
    this.setInDesignServerConnectionSuccess = function ()
    {
        var template = Handlebars.compile($('#indesignserverconnectionsuccess').html());

        $('#indesign_server').html(template({}));
    };

    /**
     * Builds errormessage
     * @param message
     * @returns {string}
     */
    this.addConverterError = function(message)
    {
        $('#'+message.ticketId).attr('src','/images/Not_available_icon.jpg');

        var source = $('#convertererror').html();

        var data = {
            "ticketId" : message.ticketId,
            "uuid" : message.uuid,
            "eventName" : message.eventName,
            "filename" : message.filename,
            "error" : message.errors[0]
        };

        var template = Handlebars.compile(source);

        $('#error_' + message.ticketId).append(template(data));
    };

    /**
     * Get thumbnailUrl from websocketMessage
     * @param message
     * @returns {string}
     */
    this.getThumbnailUrl = function (message) {

        var thumbnailurl="";

        if(message.thumbnailList[0] == undefined)
        {
            thumbnailurl = '/images/Not_available_icon.jpg';
        }
        else
        {
            thumbnailurl = message.thumbnailList[0];
        }

        return thumbnailurl;
    };


    /**
     * Attach websocket on uploadform
     */
    this.attachWebsockets =function()
    {
        var scope = this;

        var websocketStarterUrl =  '/admin/websocket/start?time' + Date.now();

        try
        {
            //have to request 2 times after backend restart. Why ever. WTF
            $.get(websocketStarterUrl, function( data )
            {
                scope.addWebsocketListener(scope);
            });


            $.get(websocketStarterUrl, function( data )
            {
                scope.addWebsocketListener(scope);

            }).fail(function(data)
            {
                var error = {};

                error.message = data;

                scope.setWebsocketConnectionError(error);
            });

        }catch(Exception)
        {
          alert(Exception);
        }
    };

    /**
     * adds websocketListener
     */
    this.addWebsocketListener = function (scope)
    {

        var webSocket = WS.connect(this.config.websocketUrl);

        /**
         * Initialize websocket connection
         */
        webSocket.on("socket/connect", function (session)
        {
            scope.setWebsocketConnectionCreatedMessage();
        });

        /**
         * When connection is lost
         */
        webSocket.on("socket/disconnect", function (error)
        {
            scope.setWebsocketConnectionError(error);
        });

        /**
         * On successfull websocket connection
         */
        webSocket.on("socket/connect", function (session)
        {
            /**
             * Connect to creation of a thumbnailticket event
             */
            session.subscribe("mittax/mediaconverter/topic/converter/ticketcreated", function (uri, payload)
            {
                try
                {
                    var message = JSON.parse(payload.msg).message;

                    if($('#'+message.ticketId).length > 0) return false;

                    scope.setDataTableRow(message);

                    document.querySelector("#total-progress .progress-bar").style.width = 50 + "%";

                }catch(Exception)
                {
                    var err = new Error();

                    console.log("ticketcreated websocket listener error: "+ Exception + ' Trace:' + err.stack);
                }
            });

            /**
             * Subscribe to all successful conversions
             */
            session.subscribe("mittax/mediaconverter/topic/converter/success", function (uri, payload)
            {
                try
                {
                    var message = JSON.parse(payload.msg).message;

                    if(message.event =="ffmpeg.lowres.created") return;

                    var thumbnailurl = scope.getThumbnailUrl(message);

                    /**
                     * Current browserwindow was closed.
                     */
                    if($('#'+message.ticketId).length == 0)
                    {
                        message.imageUrl = thumbnailurl;
                        scope.setDataTableRow(message);
                    }
                    else
                    {
                        $('#'+message.ticketId).attr('src',thumbnailurl);
                    }


                    $.event.trigger({
                        type: "thumbnail.finedata.created",
                        message: message,
                        time: new Date()
                    });

                    document.querySelector("#total-progress .progress-bar").style.width = 100 + "%";
                }
                catch(Exception)
                {
                    var err = new Error();

                    console.log("success websocket listener error: "+ Exception + ' Trace:' + err.stack);
                }
            });

            /**
             * Subscribe on all errors during import
             */
            session.subscribe("mittax/mediaconverter/topic/converter/error", function (uri, payload)
            {
                try
                {
                    var message = JSON.parse(payload.msg).message;

                    scope.addConverterError(message);
                }
                catch(ex)
                {
                    return false;
                }
            });

            session.publish("mittax/mediaconverter/topic/converter/error", "No Errors");
        });
    }
}