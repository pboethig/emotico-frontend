@include('cropper.datatable-row')
<link href="{{ asset('css/assets/cropper.datatable.blade.css') }}" rel="stylesheet">
<div class="cropperDatatable">
    <table class="table">
            <tbody id="message">
            </tbody>
            @foreach($userCroppings as $cropping)
                <tr id="row_{{ $cropping->id }}" >
                    <td>
                        <img class="rounded thumbnail img-responsive drop-shadow float-left"  src="{{ $cropping->getThumbnailUrl() }}" alt="<?php echo __('messages.Loading')?>" title="<?php echo __('messages.Loading')?>" width="120" />
                        <a class="delete triggerDeleteCropping" data-cropping-id="{{ $cropping->id}}" id="cropping_{{ $cropping->id}}" href="javascript:void(0)"><img src="{{ asset('images/delete.jpeg') }}" width="20" alt="{{ __('messages.delete') }}" title="{{ __('messages.delete') }}"/></a>
                    </td>
                </tr>
            @endforeach
    </table>
</div>
