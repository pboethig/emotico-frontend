<?php
/**
 * Add UploadForm and attach all needed websocket topic by adding the websocket converter
 *
 * Step 0) Create $uploadFormConfig see AssetController::import()
 *
 * Step 1) Include all needed html templates
 *
 * Step2) Include converter and uploadform class
 *
 * Step 3) Pass converter to uploadform
 *
 */
?>
<script src="https://unpkg.com/babel-standalone@6/babel.min.js" type="text/javascript"/>
<script src="{{ mix('js/app.js') }}"></script>
<form id="uploadform" class="dropzone"  method="post" enctype="multipart/form-data"></form>
<hr/>
<!-- diplay video, image and indesign queue-->
@include('bread.assets.import.queues')

<!-- get the import data table -->
<div class="col-sm-9">
    @include('bread.assets.import.datatable')
    @include('bread.assets.import.datatable-row')
</div>

<!-- all needed backend connections-->
<div class="col-sm-3">
    @include('bread.assets.import.connections')
</div>

@include('converter.error')


<script src="{{ asset('js/goswebsocket/js/vendor/autobahn.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/goswebsocket/js/gos_web_socket_client.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/app/Websockets/Converter.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/app/UploadForm.js') }}" type="text/javascript"></script>

<script type="text/javascript">
    $(document).ready(function()
    {
        new UploadForm(<?=$uploadFormConfig?>).init(new Converter(<?=$uploadFormConfig?>));
    });
</script>
