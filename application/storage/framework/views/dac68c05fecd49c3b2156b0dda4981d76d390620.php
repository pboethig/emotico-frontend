<script src="https://unpkg.com/babel-standalone@6/babel.min.js" type="text/javascript"/>
<link href="<?php echo e(asset('css/assets/datatable.blade.css')); ?>" rel="stylesheet">
<script src="<?php echo e(mix('js/app.js')); ?>"></script>
    <form id="uploadform" class="dropzone"  method="post" enctype="multipart/form-data"></form>
    <hr/>
        <label><strong><?php echo e(__('messages.filesinimagequeue')); ?>: </strong></label>
        <div class="imagethumbnails">0</div>
        <hr class="clear-both"/>

        <label><strong><?php echo e(__('messages.filesinvideoqueue')); ?>: </strong></label>
        <div class="videothumbnails">0</div>
        <hr class="clear-both"/>

        <label ><strong><?php echo e(__('messages.filesinindesignqueue')); ?>:</strong></label>
        <div class="indesignthumbnails">0</div>

        <hr class="clear-both"/>
        <span class="fileupload-process">
          <div id="total-progress" class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0">
              <div class="progress-bar progress-bar-info" style="width:0%;" data-dz-uploadprogress></div>
          </div>
        </span>

        <div class="col-sm-9">
            <table class="table">
                <thead class="thead-default">
                <tr>
                    <th width="120"><?php echo e(__('messages.Preview')); ?></th>
                    <th>Uuid</th>
                    <th><?php echo e(__('messages.Filename')); ?></th>
                    <th><?php echo e(__('messages.Extension')); ?></th>
                </tr>
                </thead>
                <tbody id="message">
                <tr id="initialRow">
                    <td colspan="4"><?php echo e(__('messages.NoFilesInProgress')); ?></td>
                </tr>
                </tbody>
            </table>
        </div>
        <div class="col-sm-3">
            <div class="card">
                <h3 class="card-header"><?php echo e(__('messages.Connection')); ?></h3>
                <div class="card-block">
                    <div id="websocket"></div>
                    <div id="indesign_server"></div>
                </div>
            </div>
            <br/>
        </div>

    <?php
    /**
     * Include all html handlebar templates to be rensered by upload class
     */
    ?>
    <?php echo $__env->make('bread.assets.datatable-row', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php echo $__env->make('websocket.connection-success', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php echo $__env->make('websocket.connection-error', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php echo $__env->make('indesignserver.connection-success', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php echo $__env->make('indesignserver.connection-error', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php echo $__env->make('converter.error', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

    <script src="<?php echo e(mix('js/app/UploadForm.js')); ?>" type="text/javascript"></script>

    <script type="text/javascript">
        var uploadForm = new UploadForm(<?php echo json_encode(new \App\Helper\Asset\Import\UploadFormConfig())?>);

        uploadForm.init();
   </script>
