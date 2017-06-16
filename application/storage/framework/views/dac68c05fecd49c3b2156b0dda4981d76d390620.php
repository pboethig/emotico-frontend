<script src="https://unpkg.com/babel-standalone@6/babel.min.js" type="text/javascript"/>
<script src="<?php echo e(mix('js/app.js')); ?>"></script>
    <form id="uploadform" class="dropzone"  method="post" enctype="multipart/form-data"></form>
    <hr/>
        <label>Files in ImageQueue: </label>
        <div class="imageQueueCount">0</div>
        <hr class="clear-both"/>

        <label>Files in VideoQueue: </label>
        <div class="videoQueueCount">0</div>
        <hr class="clear-both"/>

        <label >Files in InDesignQueue:</label>
        <div class="indesignQueueCount">0</div>

        <hr class="clear-both"/>
        <span class="fileupload-process">
          <div id="total-progress" class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0">
              <div class="progress-bar progress-bar-info" style="width:0%;" data-dz-uploadprogress></div>
          </div>
        </span>

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
        /**
         * Init scope before including import script
         * @type  {string}
         */
        $(function()
        {
            assetStoreUrl = "<?php echo e(config('app')['mediaconverter.public.web.url']); ?>/assets/store";
            triggerProgressUrl = "<?php echo e(config('app')['mediaconverter.public.web.url']); ?>/assets/process";
            pingInDesignServerUrl = "<?php echo e(config('app')['mediaconverter.public.web.url']); ?>/indesignserver/ping";
            websocketUrl = "<?php echo e(config('app')['mediaconverter.public.websocket.url']); ?>";
            allowedFormats = ".jpeg,.jpg,.png,.gif,.eps,.tiff,.tif,.psd,.indd,.mp4,.mov,.pdf,.divx,.mkv,.wmv";

            <?php $queueConfig = new \App\Repository\Emotico\Config()?>

            imagethumbnailComsumerCommand = "<?php echo e($queueConfig::$imagethumbnailComsumerCommand); ?>";

            var uploadForm = new UploadForm();

            uploadForm.init();
        });

    </script>
    <script src="<?php echo e(mix('js/app/UploadForm.js')); ?>" type="text/javascript"></script>


