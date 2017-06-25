<!-- Show the cropped image in modal -->
<div class="modal fade docs-cropped" id="getCroppedCanvasModal" aria-hidden="true" aria-labelledby="getCroppedCanvasTitle" role="dialog" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="getCroppedCanvasTitle">{{ __('messages.Cropped') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body"></div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('messages.Close') }}</button>
                <a class="btn btn-primary" id="download" href="javascript:void(0);" download="{{ $dataTypeContent->uuid }}_crop">{{ __('messages.Download') }}</a>
            </div>
        </div>
    </div>
</div><!-- /.modal -->