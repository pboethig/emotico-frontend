<script id="data_table_row" type="text/x-handlebars-template">
    <tr id="row_@{{ ticketId }}">
        <td>
            <img id="@{{ ticketId }}" class="rounded thumbnail img-responsive drop-shadow float-left" src="@{{ imageUrl }}" alt="<?php echo __('messages.Loading')?>" title="<?php echo __('messages.Loading')?>" width="120" />
            <a class="delete" href="javascript:void(0)" onclick="$('#row_@{{ ticketId }}').remove()"><img src="{{ asset('images/delete.jpeg') }}" width="20" alt="{{ __('messages.delete') }}" title="{{ __('messages.delete') }}"/></a>
            <div id="error_@{{ ticketId }}"></div>
        </td>
    </tr>
</script>
