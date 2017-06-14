<div class="readmore">
    <?php $thumbnailList = json_decode($data->{$row->field}, true);?>
    @if($thumbnailList)
        <img src="{{ $thumbnailList[0] }}" width="200" /><br/>
    @endif
</div>