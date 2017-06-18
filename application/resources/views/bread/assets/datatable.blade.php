<script src="https://unpkg.com/babel-standalone@6/babel.min.js" type="text/javascript"/>
<link href="{{ asset('css/assets/datatable.blade.css') }}" rel="stylesheet">
<script src="{{ mix('js/app.js') }}"></script>
    <form id="uploadform" class="dropzone"  method="post" enctype="multipart/form-data"></form>
    <hr/>
        <span class="badge  label-primary imagethumbnails">0</span>
        <label><strong>{{ __('messages.filesinimagequeue') }}: </strong></label>
        <hr class="clear-both"/>


        <span class="badge  label-success videothumbnails">0</span>
        <label><strong>{{ __('messages.filesinvideoqueue') }}: </strong></label>
        <hr class="clear-both"/>

        <span class="badge indesignthumbnails">0</span>
        <label ><strong>{{ __('messages.filesinindesignqueue') }}:</strong></label>

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
                    <th width="120">{{ __('messages.Preview') }}</th>
                    <th>Uuid</th>
                    <th>{{ __('messages.Filename') }}</th>
                    <th>{{ __('messages.Extension') }}</th>
                </tr>
                </thead>
                <tbody id="message">
                <tr id="initialRow">
                    <td colspan="4">{{ __('messages.NoFilesInProgress') }}</td>
                </tr>
                </tbody>
            </table>
        </div>
        <div class="col-sm-3">
            <div class="card">
                <h3 class="card-header">{{ __('messages.Connection') }}</h3>
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
    @include('bread.assets.datatable-row')
    @include('websocket.connection-success')
    @include('websocket.connection-error')
    @include('indesignserver.connection-success')
    @include('indesignserver.connection-error')
    @include('converter.error')

    <script src="{{ mix('js/app/UploadForm.js') }}" type="text/javascript"></script>

    <script type="text/javascript">

        <?php $uploadFormConfig = new \App\Helper\Asset\Import\UploadFormConfig()?>

        var uploadForm = new UploadForm(<?php echo $uploadFormConfig->toJson()?>);

        uploadForm.init();
   </script>
