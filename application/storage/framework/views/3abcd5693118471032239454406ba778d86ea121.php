<?php $__env->startSection('css'); ?>
    <script type="text/javascript" src="<?php echo e(voyager_asset('js/vue1.min.js')); ?>"></script>
    <link rel="stylesheet" href="<?php echo e(voyager_asset('css/media/media.css')); ?>"/>
    <link rel="stylesheet" type="text/css" href="<?php echo e(voyager_asset('js/select2/select2.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(voyager_asset('css/media/dropzone.css')); ?>"/>
    <script src="<?php echo e(asset('js/goswebsocket/js/vendor/autobahn.min.js')); ?>" type="text/javascript"></script>
    <script src="<?php echo e(asset('js/goswebsocket/js/gos_web_socket_client.js')); ?>" type="text/javascript"></script>
    <script src="<?php echo e(asset('js/dropzone/dropzone-amd-module-4.3.0.js')); ?>" type="text/javascript"></script>
    <script src="<?php echo e(asset('js/dropzone/dropzone-4.3.0.js')); ?>" type="text/javascript"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" />
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="page-content container-fluid">
        <?php echo $__env->make('voyager::alerts', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <div class="row">
            <div class="col-md-12">
                <div class="admin-section-title">
                    <h3><i class="voyager-images"></i>Media Import</h3>
                </div>
                <div class="clear"></div>
                <div id="filemanager">
                    <div id="content">
                        <div class="flex panel-bordered">
                            <div id="left">
                                <div style="margin: 5px">
                                    <?php echo $__env->make('media.datatable', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
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