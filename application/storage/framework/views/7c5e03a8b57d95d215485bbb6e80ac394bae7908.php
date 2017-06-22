<script id="data_table_row" type="text/x-handlebars-template">
    <tr id="row_{{ ticketId }}">
        <td>
            <img id="{{ ticketId }}" class="rounded float-left thumbnail img-responsive drop-shadow" src="{{ imageUrl }}" alt="<?php echo __('messages.Loading')?>" title="<?php echo __('messages.Loading')?>" width="120" />
        </td>
        <td><strong><?php echo __('messages.Foldername')?>: </strong>{{ uuid }}</small><br/>
            <div id="error_{{ ticketId }}"></div>
        </td>
        <td>{{ version }}</td>
        <td>{{ extension }}</td>
    </tr>
</script>
