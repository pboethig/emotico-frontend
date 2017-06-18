<?php $__env->startSection('css'); ?>
    <link rel="stylesheet" href="<?php echo e(voyager_asset('css/media/media.css')); ?>"/>
    <link rel="stylesheet" type="text/css" href="<?php echo e(voyager_asset('js/select2/select2.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(voyager_asset('css/media/dropzone.css')); ?>"/>
    <script src="<?php echo e(asset('js/goswebsocket/js/vendor/autobahn.min.js')); ?>" type="text/javascript"></script>
    <script src="<?php echo e(asset('js/goswebsocket/js/gos_web_socket_client.js')); ?>" type="text/javascript"></script>
    <script src="<?php echo e(asset('js/dropzone/dropzone-amd-module-4.3.0.js')); ?>" type="text/javascript"></script>
    <script src="<?php echo e(asset('js/dropzone/dropzone-4.3.0.js')); ?>" type="text/javascript"></script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

    <!-- available Formats dialog -->
    <?php echo $__env->make('bread.assets.dialogs.supported-formats', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <div class="page-content container-fluid">
        <?php echo $__env->make('voyager::alerts', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <div class="row">
            <div class="col-md-12">
                <div class="admin-section-title">
                    <h3><i class="voyager-images"></i><?php echo e(__('messages.assetimport')); ?>

                        <a href="<?php echo e(url('/admin/assets')); ?>" class="btn btn-warning">
                            <span class="glyphicon glyphicon-list"></span>&nbsp;
                            <?php echo e(__('messages.ReturnToList')); ?>

                        </a>
                        <a href="javascript:void(0);" class="btn btn-primary openSupportedFormats">
                            <span class="glyphicon glyphicon-list"></span>&nbsp;
                            <?php echo e(__('messages.ShowSupportedFormats')); ?>

                        </a>

                    </h3>
                </div>
                <div class="clear"></div>
                <div id="filemanager">
                    <div id="content">
                        <div class="flex panel-bordered">
                            <div id="left">
                                <div style="margin: 5px">
                                    <?php echo $__env->make('bread.assets.datatable', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!-- #filemanager -->
            </div><!-- .row -->
        </div><!-- .col-md-12 -->
    </div><!-- .page-content container-fluid -->
<?php $__env->stopSection(); ?>

<?php echo $__env->make('voyager::master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>