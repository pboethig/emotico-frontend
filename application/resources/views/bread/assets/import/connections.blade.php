@include('websocket.connection-success')
@include('websocket.connection-error')
@include('indesignserver.connection-success')
@include('indesignserver.connection-error')

<div class="panel panel-default">
    <div class="panel-heading">{{ __("messages.connections") }}</div>
    <div class="panel-body">
        <div class="card">
            <div class="card-block">
                <div id="websocket"></div>
                <div id="indesign_server"></div>
            </div>
        </div>
    </div>
</div>

