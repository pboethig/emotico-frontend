<div class="col-md-12">
    <div class="panel panel-warning">
        <div class="panel-heading">&nbsp;<strong>All Markets and their stocks</strong></div>
        <div class="panel-body" style="height:400px !important;max-height: 400px; overflow-y: auto; overflow-x: hidden">
            <br/>
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>Market</th>
                    <th>Stock</th>
                </tr>
                </thead>
                <tbody>
                @foreach($collection as $marketMember)
                    <tr>
                        <td>
                            <img width="80" src="{{  config('app.url') }}/storage/{{ $marketMember->marketId->logo }}"  alt="{{ $marketMember->marketId->name }}" title="{{ $marketMember->marketId->name }}"/>
                        </td>

                        <td>{{ $marketMember->stockId->name }}
                            WKN:{{ $marketMember->stockId->wkn }}
                            ISIN:{{ $marketMember->stockId->isin }}
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
