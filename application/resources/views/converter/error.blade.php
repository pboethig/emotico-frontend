<script id="convertererror" type="text/x-handlebars-template">
    <div class="alert alert-danger">
        <small><strong><?php echo __('messages.TicketID')?>: </strong>@{{ ticketId }}</small>
        <br/>
        <small><strong><?php echo __('messages.EventName')?>: </strong>@{{ eventName }}</small>
        <br/>
        <small><strong><?php echo __('messages.UUid')?>: </strong>@{{ uuid }}</small>
        <br/>
        <small><strong><?php echo __('messages.Filename')?>: </strong>@{{ filename }}</small>
        <br/>
        <small><strong><?php echo __('messages.Errormessage')?>: </strong><br>@{{ error }}</small>
    </div>
</script>