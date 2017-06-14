<div class="col-md-12">
    <div class="panel panel-primary">
        <div class="panel-heading">&nbsp;<strong>All Companies and their stocks in all markets</strong></div>
        <div class="panel-body" style="height:400px !important;max-height: 400px; overflow-y: auto; overflow-x: hidden">
            <br/>
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>Company</th>
                    <th>Stock</th>
                    <th>Market</th>
                    <th>Price</th>
                </tr>
                </thead>
                <tbody>
                @foreach($collection as $marketMember)
                    <tr>
                        <td>{{ $marketMember->companyId->name }}</td>
                        <td>
                            {{ $marketMember->stockId->name }}
                        </td>
                        <td>
                            <img width="80" src="{{  config('app.url') }}/storage/{{ $marketMember->marketId->logo }}"  alt="{{ $marketMember->marketId->name }}" title="{{ $marketMember->marketId->name }}"/>
                        </td>
                        <td width="100">
                             € {{ $marketMember->price }}
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

    </div>
</div>
