<div tabindex="-1" class="modal fade" id="thumbnaillistDetails" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button class="close" type="button" data-dismiss="modal">×</button>
                <h3 class="modal-title">Heading</h3>
            </div>
            <div class="modal-body">

            </div>
            <div class="modal-footer">
                <button class="btn btn-default" data-dismiss="modal">{{ __('messages.Close') }}</button>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        $('.thumbnail').click(function(){

            $('.modal-body').empty();

            var title = $(this).parent('a').attr("title");

            $('.modal-title').html(title);
            $($(this).parents('div').html()).appendTo('.modal-body');
            $('#thumbnaillistDetails').modal({show:true});
        });
    });
</script>