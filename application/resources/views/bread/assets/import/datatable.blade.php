<link href="{{ asset('css/assets/datatable.blade.css') }}" rel="stylesheet">
<div class="panel panel-default">
    <div class="panel-heading">{{ __("messages.data") }}</div>
        <div class="panel-body">
            <!-- Display the progressbar -->
            @include('bread.assets.import.progressbar')
            <table class="table">
                <thead class="thead-default">
                <tr>
                    <th width="120">{{ __('messages.Preview') }}</th>
                    <th>Uuid</th>
                    <th>{{ __('messages.Filename') }}</th>
                    <th>{{ __('messages.Extension') }}</th>
                </tr>
                </thead>
            <tbody id="message">
            <tr id="initialRow">
                <td colspan="4">{{ __('messages.NoFilesInProgress') }}</td>
            </tr>
            </tbody>
        </table>
    </div>
 </div>
