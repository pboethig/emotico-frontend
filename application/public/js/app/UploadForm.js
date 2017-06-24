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
     * js/app/websocket/converter.js
     */
    this.converter = undefined;

    /**
     * Constructor
     */
    this.init = function(converter)
    {
        this.converter = converter;

        this.converter.init();
        
        this.buildDropzone();
    };

    /**
     * set base variables vars
     */
    this.initVars = function(){

        Dropzone.autodiscover = false;
    };


    /**
     * Setup dropzone
     */
    this.buildDropzone = function ()
    {
        var scope = this;

        $(document).ready(function()
        {
            var myDropzone = new Dropzone("#uploadform", scope.config.dropzoneConfig);

            /**
             * Count up queue
             */
            myDropzone.on("addedfile", function (file)
            {
                /**
                 * Remove file if already exists
                 */
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

                if (this.getUploadingFiles().length === 0 && this.getQueuedFiles().length === 0)
                {
                    scope.converter.startMessageConsumer([scope.config.videothumbnailConsumerCommand,scope.config.videoLowresConsumerCommand, scope.config.imagethumbnailConsumerCommand]);
                }
            });
        });
    };
}