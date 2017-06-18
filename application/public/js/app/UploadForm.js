/**
 * Handles Uploadform
 *
 * @see views/bread/assets/datatable.blade.php
 * @constructor
 */
function UploadForm(config)
{
    /**
     * Configs uploadform
     */
    this.config = config;

    /**
     * Constructor
     */
    this.init = function()
    {
        this.initVars();

        this.pingInDesignserver();

        this.attachWebsockets();

        this.setMessageInfosFromQueue('imagethumbnails');

        this.setMessageInfosFromQueue('videothumbnails');

        this.setMessageInfosFromQueue('indesignthumbnails');

        this.startMessageConsumer(this.config.imagethumbnailConsumerCommand);

        this.startMessageConsumer(this.config.videothumbnailConsumerCommand);

        this.buildDropzone();
    };

    /**
     * Calls Emotico api to get left messages in messagequeue
     */
    this.setMessageInfosFromQueue = function(thumbnailtype)
    {
        var that = this;

        setInterval(function() {
            $.get('/admin/queue/' + thumbnailtype + '/info' + '?time'+Date.now(), function( data ) {
                that.setMessageCount(thumbnailtype, data.messages)
            });
        }, 2000);
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
     * set base variables vars
     */
    this.initVars = function(){

        Dropzone.autodiscover = false;
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
     */
    this.startMessageConsumer = function (command)
    {
        $.get("/admin/queue/" + command + "/startConsumer?time"+Date.now(), function( data )
        {

        }).fail(function(data)
        {

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

                $('#message').append(template(data));

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

        $('#websocket').append(template({}));
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

        $('#websocket').append(template({"message": message}));
    };

    /**
     * Set indesignserver connection error
     * @param error
     */
    this.setInDesignServerConnectionError = function (IP)
    {
        var source = $('#indesignserverconnectionerror').html();

        var template = Handlebars.compile(source);

        $('#indesign_server').append(template({"IP": IP}));
    };

    /**
     * Set indesignserver connection error
     * @param error
     */
    this.setInDesignServerConnectionSuccess = function ()
    {
        var template = Handlebars.compile($('#indesignserverconnectionsuccess').html());

        $('#indesign_server').append(template({}));
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
     * Setup dropzone
     */
    this.buildDropzone = function ()
    {
        var scope = this;

        $(document).ready(function()
        {
            var myDropzone = new Dropzone("#uploadform",
            {
                url: 'http://172.17.0.1:8089/assets/store',
                acceptedFiles: scope.config.allowedFormats,
                paramName: "file", // The name that will be used to transfer the file
                maxFilesize: 600, // MB
                addRemoveLinks: false,
                uploadMultiple: true,
                parallelUploads: 20,
                maxFiles: 500,
                autoProcessQueue: true,
                dictDefaultMessage: scope.config.dropzoneConfig['initmessage'],
                previewTemplate: "<div></div>",
                headers: {
                    'Authorization': 'emotico',
                    // remove Cache-Control and X-Requested-With
                    // to be sent along with the request
                    'Cache-Control': null,
                    'X-Requested-With': null
                },
                queuecomplete: function(errors)
                {
                    if(errors)
                    {
                        alert("There were errors!");
                    }
                }
            }
        );

        /**
         * Count up queue
         */
        myDropzone.on("addedfile", function (file)
        {
            if (this.files.length)
            {
                var _i, _len;

                for (_i = 0, _len = this.files.length; _i < _len - 1; _i++) // -1 to exclude current file
                {
                    if(this.files[_i].name === file.name && this.files[_i].size === file.size && this.files[_i].lastModifiedDate.toString() === file.lastModifiedDate.toString())
                    {
                        this.removeFile(file);
                    }
                }
            }

            document.querySelector("#total-progress .progress-bar").style.width = 10 + "%";
        });

        /**
         * Run backend queue consumer if assetupload is finished
         */
        myDropzone.on("complete", function(file)
        {
            if($("#initialRow").length > 0) $("#initialRow").remove();

            myDropzone.removeFile(file);

            $.get(scope.config.triggerProgressUrl + "?file="+file.name+'&time'+Date.now(), function( data ) {

            }).fail(function(data)
            {
            });

            if (this.getUploadingFiles().length === 0 && this.getQueuedFiles().length === 0) {

                scope.startMessageConsumer(scope.config.imagethumbnailConsumerCommand);
                scope.startMessageConsumer(scope.config.videothumbnailConsumerCommand);
            }
        });

        });

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
            thumbnailurl = 'http://quantachrome.com/forms06/img/Not_available_icon.jpg';
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
        var webSocket = WS.connect(this.config.websocketUrl);

        var that = this;

        /**
         * Initialize websocket connection
         */
        webSocket.on("socket/connect", function (session)
        {
            that.setWebsocketConnectionCreatedMessage();
        });

        /**
         * When connection is lost
         */
        webSocket.on("socket/disconnect", function (error)
        {
            that.setWebsocketConnectionError(error);
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

                    that.setDataTableRow(message);

                    document.querySelector("#total-progress .progress-bar").style.width = 50 + "%";

                }catch(Exception)
                {

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

                    var thumbnailurl = that.getThumbnailUrl(message);

                    /**
                     * Current browserwindow was closed.
                     */
                    if($('#'+message.ticketId).length == 0)
                    {
                        message.imageUrl = thumbnailurl;
                        that.setDataTableRow(message);
                    }
                    else
                    {
                        $('#'+message.ticketId).attr('src',thumbnailurl);
                    }

                    document.querySelector("#total-progress .progress-bar").style.width = 100 + "%";
                }
                catch(Exception)
                {

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

                    that.addConverterError(message);
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