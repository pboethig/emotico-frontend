<!-- include websockets to get genereted croppings -->
    <script src="{{ asset('js/goswebsocket/js/vendor/autobahn.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/goswebsocket/js/gos_web_socket_client.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/app/Websockets/Converter.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/app/jquery-md5.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/app/makefixed.min.js') }}" type="text/javascript"></script>


<!-- DownloadDialog -->
@include('cropper.dialogs.getCroppedCanvas')
<!-- Content -->
    <div class="row">
        @include("cropper.buttons")
        <div class="col-md-2">
            @include('cropper.storedCroppings')
        </div>
        <div class="col-md-8">
           @include('cropper.imagepanel')
        </div>
        <div class="col-md-2">
            @include('cropper.sidebar')
            @include("bread.assets.import.connections")
        </div>
    </div>

<script type="text/javascript">

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    /**
     * Initialize WebsocketListener for imageconverter
     * @type {Converter}
     */
    $(document).ready(function()
    {
        var converter = new Converter(<?=$uploadFormConfig?>);
        converter.init(false);
    });

    /**
     * Extend finedata success listener and save new cropping in database
     */
    $(document).on("thumbnail.finedata.created", function (event)
    {
        event.message.user_id = '{{ \Illuminate\Support\Facades\Auth::user()->id }}';
        event.message.canvasdata = window.cropboxdata;
        event.message.browserimagedata = window.browserimagedata;

        $.post('{{ config('app.url') }}/admin/assets/saveCropping', {message: event.message}, function(result)
        {

        });
    });

    /**
     * delete crop event
     */
    $('.triggerDeleteCropping').on("click", function (event)
    {
        var crop = $(this);

        $.get('{{ config('app.url') }}/admin/assets/' + crop.attr("data-cropping-id") + '/deleteCropping', function(result)
        {
            crop.remove();

            $("#row_" + crop.attr("data-cropping-id")).remove();
        });
    });

    /**
     * Configure cropperjs and include it
     * @type {string}
     */
    var base64ImageUploadUrl = '/admin/assets/storeBase64Image';

    var imageThumbnailConsumerUrl = '/admin/queue/{{ $emoticoConfig::$imagethumbnailConsumerCommand }}/startConsumer';

</script>
<script type="text/javascript" src="{{ asset('js/app/cropper.js') }}"></script>

<script type="text/javascript">
    /**
     * make sticky elements
     */
    $(".docs-buttons").makeFixed();

    /**
     * Fix sidebar
     */
    $(".croppingSidebar").makeFixed({
        onFixed: function (el)
        {
            $(el).children().css
            ({
                top: '70px'
            });

            $(".breadcrumb").hide();
        },
        onUnFixed: function (el)
        {
            $(el).children().css
            ({
                top: '0px'
            });

            $(".breadcrumb").show();
        }
    });
</script>