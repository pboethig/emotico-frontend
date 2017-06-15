    <form id="uploadform" class="dropzone"  method="post" enctype="multipart/form-data"></form>
    <hr/>
        <label class="float-left">Files in Queue: </label>
        <div class="addedFiles">0</div>
        <hr class="clear-both"/>
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
        assetStoreUrl = "<?php echo e(config('app')['mediaconverter.public.web.url']); ?>/assets/store";
        triggerProgressUrl = "<?php echo e(config('app')['mediaconverter.public.web.url']); ?>/assets/process";
        pingInDesignServerUrl = "<?php echo e(config('app')['mediaconverter.public.web.url']); ?>/indesignserver/ping";
        websocketUrl = "<?php echo e(config('app')['mediaconverter.public.websocket.url']); ?>";
        allowedFormats = ".jpeg,.jpg,.png,.gif,.eps,.tiff,.tif,.psd,.indd,.mp4,.mov,.pdf,.divx,.mkv,.wmv";
    </script>

    <script src="<?php echo e(mix('js/app/asset.import.js')); ?>" type="text/javascript"></script>
    <?php echo $__env->yieldPushContent('scripts'); ?>
    <!--
    <script type="text/javascript" src="<?php echo e(asset('js/app/asset.import.js')); ?>"></script>
-->