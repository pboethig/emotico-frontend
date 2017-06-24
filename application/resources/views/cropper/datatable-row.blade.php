<script id="data_table_row" type="text/x-handlebars-template">
    <tr id="row_@{{ ticketId }}">
        <td>
            <img id="@{{ ticketId }}" class="rounded thumbnail img-responsive drop-shadow" src="@{{ imageUrl }}" alt="<?php echo __('messages.Loading')?>" title="<?php echo __('messages.Loading')?>" width="120" />
            <strong style="clear: both;margin:0;padding:0"><?php echo __('messages.Foldername')?>:
                <br/></strong>@{{ uuid }}</small><br/>
            <div id="error_@{{ ticketId }}"></div>
        </td>
    </tr>
</script>
