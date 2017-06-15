    <form id="uploadform" class="dropzone"  method="post" enctype="multipart/form-data"></form>
    <hr/>
        <div class="col-sm-9" style="overflow-y: scroll; max-height: 800px">
            <table class="table" id="message">
                <thead class="thead-default">
                <tr>
                    <th width="120">Preview</th>
                    <th>Uuid</th>
                    <th>Filename</th>
                    <th>Extension</th>
                </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
        <div class="col-sm-3">
            <div class="card">
                <h3 class="card-header">Connection</h3>
                <div class="card-block">
                    <div id="websocket"></div>
                    <div id="indesign_server"></div>
                </div>
            </div>
            <br/>
        </div>

<script type="text/javascript">
    Dropzone.autodiscover = false;
    function buildDropzone()
    {
        var myDropzone = new Dropzone("#uploadform",
                {
                    url: "{{ config('app')['mediaconverter.public.web.url'] }}/assets/store",
                    acceptedFiles: ".jpeg,.jpg,.png,.gif,.eps,.tiff,.tif,.psd,.indd,.mp4,.mov,.pdf,.divx,.mkv,.wmv",
                    paramName: "file", // The name that will be used to transfer the file
                    maxFilesize: 600, // MB
                    addRemoveLinks: true,
                    uploadMultiple: true,
                    parallelUploads: 100,
                    maxFiles: 100,
                    autoProcessQueue: true,
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

        myDropzone.on("complete", function(file) {
            myDropzone.removeFile(file);

            $.get("{{ config('app')['mediaconverter.public.web.url'] }}/assets/process?file="+file.name+'&time'+Date.now(), function( data ) {

            }).fail(function(data)
            {

            });

        });

        myDropzone.on("addedfile", function(file) {
            if (this.files.length) {
                var _i, _len;
                for (_i = 0, _len = this.files.length; _i < _len - 1; _i++) // -1 to exclude current file
                {
                    if(this.files[_i].name === file.name && this.files[_i].size === file.size && this.files[_i].lastModifiedDate.toString() === file.lastModifiedDate.toString())
                    {
                        this.removeFile(file);
                    }
                }
            }});


        $('#submit').click(function(){
            myDropzone.processQueue();
        });
    }

    /**
     * Pings INDD Server and types out message
     */
    function pingInDesignserver()
    {

        $.get("{{ config('app')['mediaconverter.public.web.url'] }}/indesignserver/ping", function( data ) {

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
    }

    /**
     * Attach to Autobahn websockets
     */
    function attachWebsockets()
    {
        var webSocket = WS.connect("{{ config('app')['mediaconverter.public.websocket.url'] }}");

        webSocket.on("socket/connect", function (session) {
            var message = '<div class="alert alert-success"><section>Websocket:</section>Successfully connected</div>'

            document.getElementById('websocket').innerHTML = message;
        });

        webSocket.on("socket/disconnect", function (error)
        {
            var message = "Disconnected for " + error.reason + " with code " + error.code + " Url: {{ config('app')['mediaconverter.public.websocket.url'] }}" ;

            message = '<div class="alert alert-danger"><section>Websocket:</section>'+message+'</div>'

            document.getElementById('websocket').innerHTML = message;
        });

        webSocket.on("socket/connect", function (session)
        {
            //the callback function in "subscribe" is called everytime an event is published in that channel.
            session.subscribe("mittax/mediaconverter/topic/converter/ticketcreated", function (uri, payload)
            {
                if (payload.msg.indexOf('has joined') >-1)
                {

                }
                else
                {
                    var message = JSON.parse(payload.msg).message;

                    if($('#'+message.ticketId).length > 0) return;

                    $('#message').prepend('<tr><td><img id="' + message.ticketId +'" class="rounded float-left" src="{{ asset('images/loading_blue.gif') }}" alt="Loading" title="Loading" width="120" /></td><td><strong>Folder: </strong>' + message.uuid + '</small><br/><div id="error_' + message.ticketId+'"></div></td><td>' + message.version +'</td><td>' + message.extension +'</td></tr>');
                }
            });

            //the callback function in "subscribe" is called everytime an event is published in that channel.
            session.subscribe("mittax/mediaconverter/topic/converter/success", function (uri, payload)
            {
                if (payload.msg.indexOf('has joined') >-1)
                {

                }
                else
                {
                    var message = JSON.parse(payload.msg).message;

                    var thumbnailurl="";

                    if(message.event =="ffmpeg.lowres.created") return;

                    if(message.thumbnailList[0]== undefined)
                    {
                        thumbnailurl = 'http://quantachrome.com/forms06/img/Not_available_icon.jpg';
                    }
                    else
                    {
                        thumbnailurl = message.thumbnailList[0];
                    }

                    $('#'+message.ticketId).attr('src',thumbnailurl);
                }
            });

            //the callback function in "subscribe" is called everytime an event is published in that channel.
            session.subscribe("mittax/mediaconverter/topic/converter/error", function (uri, payload)
            {
                try
                {
                    var message = JSON.parse(payload.msg).message;
                }
                catch(ex)
                {
                    return;
                }

                $('#'+message.ticketId).attr('src','http://quantachrome.com/forms06/img/Not_available_icon.jpg');

                var errorNode = document.createElement('div');

                var innerHTML = '<div class="alert alert-danger">';
                innerHTML+='<small><strong>TicketID: </strong> '+ message.ticketId + '</small>';
                innerHTML+='<br/><small><strong>EventName: </strong>'+ message.eventName + '</small>';
                innerHTML+='<br/><small><strong>Uuid: </strong> '+ message.uuid + '</small>';
                innerHTML+='<br/><small><strong>Filename: </strong> ' + message.filename + '</small>';
                innerHTML+='<br/><small><strong>ErrorMessage: </strong><br>' + message.errors[0] + '</small>';
                innerHTML+='</div>';

                errorNode.innerHTML = innerHTML;

                document.getElementById('error_' + message.ticketId).appendChild(errorNode);
            });

            session.publish("mittax/mediaconverter/topic/converter/error", "No Errors");
        });
    }

    $(function()
    {
        pingInDesignserver();

        buildDropzone();

        attachWebsockets();
    });
</script>
