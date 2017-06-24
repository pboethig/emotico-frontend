<!-- include websockets to get generetaed croppings -->
    <script src="{{ asset('js/goswebsocket/js/vendor/autobahn.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/goswebsocket/js/gos_web_socket_client.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/app/Websockets/Converter.js') }}" type="text/javascript"></script>
<!-- DownloadDialog -->
@include('cropper.dialogs.getCroppedCanvas')
<!-- Content -->
    @include("cropper.buttons")
    <div class="row">
        <div class="col-md-2" style="overflow-y: visible; max-height: 400px!important;">
            @include('cropper.storedCroppings')
        </div>
        <div class="col-md-7">
            <div class="img-container" style="margin-top:10px">
                <img style="width: 800px!important;" id="image" src="{{ $base64Image }}" alt="Picture" class="drop-shadow" />
            </div>
        </div>
        <div class="col-md-3">
            @include("cropper.data-panel")

            <!-- imort backend connectionpanel for crop saving-->
            @include("bread.assets.import.connections")
        </div>
    </div>

<script type="text/javascript">
    var base64ImageUploadUrl = '{{ $emoticoConfig::$base64ImageUploadUrl }}';

    $(document).ready(function()
    {
        var converter = new Converter(<?=$uploadFormConfig?>);

        converter.init();
    });

</script>

<script type="text/javascript" src="{{ asset('js/app/cropper.js') }}"></script>
