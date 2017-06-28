<div class="panel panel-default">
    <div class="panel-heading">{{ __("messages.OriginalAsset") }}</div>
    <div class="panel-body">
        <img style="width:{{ \App\Helper\Asset\Cropper\Image::getCropperImageWith() }}px!important;" id="image" src="{{ $base64Image }}" alt="Picture" class="drop-shadow" />
    </div>
</div>
