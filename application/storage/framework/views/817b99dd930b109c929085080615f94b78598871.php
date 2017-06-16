<div class="readmore">
    <?php $thumbnailList = json_decode($data->{$row->field}, true);?>
    <?php if($thumbnailList): ?>
        <img src="<?php echo e($thumbnailList[0]); ?>" width="200" /><br/>
    <?php endif; ?>
</div>