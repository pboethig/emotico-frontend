@include('websocket.connection-success')
@include('websocket.connection-error')
@include('indesignserver.connection-success')
@include('indesignserver.connection-error')
<div class="card">
    <h3 class="card-header">{{ __('messages.Connection') }}</h3>
    <div class="card-block">
        <div id="websocket"></div>
        <div id="indesign_server"></div>
    </div>
</div>
<br/>
