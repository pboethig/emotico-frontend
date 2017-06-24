<link href="{{ asset('css/assets/datatable.blade.css') }}" rel="stylesheet">
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