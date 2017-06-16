/**
 * Handles Uploadform
 * @see views/bread/assets/datatable.blade.php
 * @constructor
 */
function UploadForm()
{
    /**
     * Constructor
     */
    this.init = function()
    {
        this.initVars();

        this.pingInDesignserver();

        this.buildDropzone();

        this.attachWebsockets();

        this.setMessageInfosFromImageQueue();

        this.startMessageConsumer();
    };

    /**
     * Calls Emotico api to get left messages in messagequeue
     */
    this.setMessageInfosFromImageQueue = function()
    {
        var that = this;

        setInterval(function() {
            $.get('/admin/queue/imagethumbnails/info' + '?time'+Date.now(), function( data ) {
                that.setMessageCount('imageQueueCount', data.messages)
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
        $.get(pingInDesignServerUrl, function( data ) {

            var message="";

            if(data.result==true)
            {
                message='<div class="alert alert-success"><section>InDesignServer:</section>Successfully connected!</div>';
            }else
            {
                message='<div class="alert alert-danger"><section>InDesignServer:</section>Error: IP '+data.IP+' is not reachable</div>';
            }

            $("#indesign_server").html(message)

        });
    };

    /**
     * Start messaageque consumer
     */
    this.startMessageConsumer = function ()
    {
        $.get("/admin/queue/" + imagethumbnailComsumerCommand + "/startConsumer?time"+Date.now(), function( data ) {

        }).fail(function(data)
        {
            //scope.countDownQueue();
        });
    };

    /**
     * Setup dropzone
     */
    this.buildDropzone = function ()
    {
        var scope = this;

        var myDropzone = new Dropzone("#uploadform",
            {
                url: assetStoreUrl,
                acceptedFiles: allowedFormats,
                paramName: "file", // The name that will be used to transfer the file
                maxFilesize: 600, // MB
                addRemoveLinks: false,
                uploadMultiple: true,
                parallelUploads: 10,
                maxFiles: 500,
                autoProcessQueue: true,
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
            document.querySelector("#total-progress .progress-bar").style.width = 10 + "%";
        });

        /**
         * Run backend queue consumer if assetupload is finished
         */
        myDropzone.on("complete", function(file)
        {
            myDropzone.removeFile(file);

            $.get(triggerProgressUrl + "?file="+file.name+'&time'+Date.now(), function( data ) {

            }).fail(function(data)
            {
                //scope.countDownQueue();
            });

            if (this.getUploadingFiles().length === 0 && this.getQueuedFiles().length === 0) {

                scope.startMessageConsumer();
            }
        });

        /**
         * check if file is already in queue
         */
        myDropzone.on("addedfile", function(file)
        {
            that = this;

            if (this.files.length)
            {
                var _i, _len;

                for (_i = 0, _len = this.files.length; _i < _len - 1; _i++) // -1 to exclude current file
                {
                    if(this.files[_i].name === file.name && this.files[_i].size === file.size && this.files[_i].lastModifiedDate.toString() === file.lastModifiedDate.toString())
                    {
                        this.removeFile(file);

                        that.countDownQueue();
                    }
                }
            }
        });
    };

    /**
     * Attach websocket on uploadform
     */
    this.attachWebsockets =function()
    {
        var webSocket = WS.connect(websocketUrl);

        var that = this;

        /**
         * Initialize websocket connection
         */
        webSocket.on("socket/connect", function (session)
        {
            var message = '<div class="alert alert-success"><section>Websocket:</section>Successfully connected</div>'

            document.getElementById('websocket').innerHTML = message;
        });

        /**
         * When connection is lost
         */
        webSocket.on("socket/disconnect", function (error)
        {
            var message = "Disconnected for " + error.reason + " with code " + error.code + " Url:" + websocketUrl ;

            message = '<div class="alert alert-danger"><section>Websocket:</section>'+message+'</div>'

            document.getElementById('websocket').innerHTML = message;
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

                    $('#message').append('<tr id="row_"' + message.ticketId + '><td><img id="' + message.ticketId +'" class="rounded float-left thumbnail img-responsive" src="/images/loading_blue.gif" alt="Loading" title="Loading" width="120" /></td><td><strong>Folder: </strong>' + message.uuid + '</small><br/><div id="error_' + message.ticketId+'"></div></td><td>' + message.version +'</td><td>' + message.extension +'</td></tr>');

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

                    var thumbnailurl="";

                    //suppress video lowres generation
                    if(message.event =="ffmpeg.lowres.created") return;

                    if(message.thumbnailList[0]== undefined)
                    {
                        thumbnailurl = 'http://quantachrome.com/forms06/img/Not_available_icon.jpg';
                    }
                    else
                    {
                        thumbnailurl = message.thumbnailList[0];
                    }

                    /**
                     * Current browserwindow was closed.
                     */
                    if($('#'+message.ticketId).length == 0)
                    {
                        $('#message').prepend('<tr id="row_"' + message.ticketId + '><td><img id="' + message.ticketId +'" class="rounded float-left thumbnail img-responsive" src="' + thumbnailurl +'" alt="Loading" title="Loading" width="120" /></td><td><strong>Folder: </strong>' + message.uuid + '</small><br/><div id="error_' + message.ticketId+'"></div></td><td>' + message.version +'</td><td>' + message.extension +'</td></tr>');
                    }
                    else
                    {
                        $('#'+message.ticketId).attr('src',thumbnailurl);
                    }

                    document.querySelector("#total-progress .progress-bar").style.width = 100 + "%";

                    $('html, body').animate({
                        scrollTop: $("#row_" + message.ticketId).offset().top
                    }, 500);
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

                    $('#'+message.ticketId).attr('src','http://quantachrome.com/forms06/img/Not_available_icon.jpg');

                    var errorNode = document.createElement('div');

                    errorNode.innerHTML = that.buildErrorMessageMarkup(message);

                    document.getElementById('error_' + message.ticketId).appendChild(errorNode);


                }
                catch(ex)
                {
                    return false;
                }
            });

            session.publish("mittax/mediaconverter/topic/converter/error", "No Errors");
        });

        /**
         * Builds errormessage
         * @param message
         * @returns {string}
         */
        this.buildErrorMessageMarkup = function(message)
        {
            var errorMessageMarkup = '<div class="alert alert-danger">';
            errorMessageMarkup+='<small><strong>TicketID: </strong> '+ message.ticketId + '</small>';
            errorMessageMarkup+='<br/><small><strong>EventName: </strong>'+ message.eventName + '</small>';
            errorMessageMarkup+='<br/><small><strong>Uuid: </strong> '+ message.uuid + '</small>';
            errorMessageMarkup+='<br/><small><strong>Filename: </strong> ' + message.filename + '</small>';
            errorMessageMarkup+='<br/><small><strong>ErrorMessage: </strong><br>' + message.errors[0] + '</small>';
            errorMessageMarkup+='</div>';

            return errorMessageMarkup;
        };
    }
}