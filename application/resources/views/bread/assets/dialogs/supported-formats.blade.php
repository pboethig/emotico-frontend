<?php
/**
 * @todo: make facade to keep mvc
 */
$mediaconverterConfig = new \App\Repository\Emotico\MediaconverterConfig(new \App\Repository\Emotico\Config());
$supprtedFormatsGroupedByConverter = $mediaconverterConfig->getFormatsGroupedByConverter();
?>
<div tabindex="-1" class="modal fade" id="supportedFormats" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button class="close" type="button" data-dismiss="modal">×</button>
                <h3 class="modal-title supportedFormatsDialogTitle">{{ __('messages.supportedFormats') }}</h3>
            </div>
            <div class="modal-body supportedFormatsDialogBody">
                @foreach($supprtedFormatsGroupedByConverter as $converterName=>$formats)
                    <hr/>
                    <label><strong>{{ $converterName }}</strong></label>
                    <span style="word-wrap:break-word;">{{ $formats }}</span>
                @endforeach
            </div>
            <div class="modal-footer">
                <button class="btn btn-default" data-dismiss="modal">{{ __('messages.Close') }}</button>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        $('.openSupportedFormats').click(function()
        {
            $('#supportedFormats').modal({show:true});
        });
    });
</script>