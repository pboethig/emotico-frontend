window.Wizard = class Wizard {
    InitSteps() {
        alert("test");
    }
}

Dropzone.autodiscover = false;

var addedFiles = 0;

function countDownQueue()
{
    $(".addedFiles").html(addedFiles--);
}


function buildDropzone()
{
    var myDropzone = new Dropzone("#uploadform",
        {
            url: assetStoreUrl,
            acceptedFiles: allowedFormats,
            paramName: "file", // The name that will be used to transfer the file
            maxFilesize: 600, // MB
            addRemoveLinks: false,
            uploadMultiple: true,
            parallelUploads: 1,
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

    myDropzone.on("addedfile", function (file) {

        addedFiles++;

        $(".addedFiles").html(addedFiles);

    });

    //alert(myDropzone.getAcceptedFiles().length);

    myDropzone.on("complete", function(file) {
        myDropzone.removeFile(file);

        $.get(triggerProgressUrl + "?file="+file.name+'&time'+Date.now(), function( data ) {

        }).fail(function(data)
        {
            countDownQueue();
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

                    countDownQueue();

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
}

/**
 * Attach to Autobahn websockets
 */
function attachWebsockets()
{
    var webSocket = WS.connect(websocketUrl);

    webSocket.on("socket/connect", function (session) {
        var message = '<div class="alert alert-success"><section>Websocket:</section>Successfully connected</div>'

        document.getElementById('websocket').innerHTML = message;
    });

    webSocket.on("socket/disconnect", function (error)
    {
        var message = "Disconnected for " + error.reason + " with code " + error.code + " Url:" + websocketUrl ;

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

                if($('#'+message.ticketId).length > 0) return false;

                $('#message').prepend('<tr><td><img id="' + message.ticketId +'" class="rounded float-left" src="/images/loading_blue.gif" alt="Loading" title="Loading" width="120" /></td><td><strong>Folder: </strong>' + message.uuid + '</small><br/><div id="error_' + message.ticketId+'"></div></td><td>' + message.version +'</td><td>' + message.extension +'</td></tr>');
            }
        });

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

                countDownQueue();
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