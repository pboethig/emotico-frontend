@extends('voyager::master')

@section('page_title','View '.$dataType->display_name_singular)

@section('content')
    @include('voyager::multilingual.language-selector')
    <!-- available Formats dialog -->
    <div class="page-content container-fluid">
        @include('voyager::alerts')
        <div class="row">
            <div class="col-md-12">
                <div class="admin-section-title">
                    <h3><i class="voyager-images"></i>{{ __('messages.assetEdit') }}
                        <a href="{{ url('/admin/assets') }}" class="btn btn-warning">
                            <span class="glyphicon glyphicon-list"></span>&nbsp;
                            {{ __('messages.ReturnToList') }}
                        </a>
                    </h3>
                </div>
                <div class="clear"></div>
                <div id="filemanager" style="background-color: white">
                    <div id="content">
                        <div class="flex panel-bordered" style="height: 1100px!important;">
                            <div id="left">
                                <div style="margin: 5px">
                                    @include('cropper.main')
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
