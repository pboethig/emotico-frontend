<!-- DownloadDialog -->

@include('cropper.dialogs.getCroppedCanvas')
<!-- Content -->
    <div class="row">
        <div class="col-md-2">
            @include('cropper.storedCroppings')
        </div>
        <div class="col-md-7">
            <div class="img-container" style="margin-top:10px">
                <img style="width: 800px!important;" id="image" src="{{ \App\Helper\Asset\Cropper\Image::getBase64Image($dataTypeContent) }}" alt="Picture" class="drop-shadow" />
            </div>
        </div>
        <div class="col-md-3">
          @include("cropper.data-panel")
        </div>
    </div>
    @include("cropper.buttons")
<script type="text/javascript" src="{{ asset('js/app/cropper.js') }}"></script>
