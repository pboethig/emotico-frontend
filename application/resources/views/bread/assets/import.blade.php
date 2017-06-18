@extends('voyager::master')

@section('css')
    <link rel="stylesheet" href="{{ voyager_asset('css/media/media.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ voyager_asset('js/select2/select2.min.css') }}">
    <link rel="stylesheet" href="{{ voyager_asset('css/media/dropzone.css') }}"/>
    <script src="{{ asset('js/goswebsocket/js/vendor/autobahn.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/goswebsocket/js/gos_web_socket_client.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/dropzone/dropzone-amd-module-4.3.0.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/dropzone/dropzone-4.3.0.js') }}" type="text/javascript"></script>
@stop

@section('content')
    <div class="page-content container-fluid">
        @include('voyager::alerts')
        <div class="row">
            <div class="col-md-12">
                <div class="admin-section-title">
                    <h3><i class="voyager-images"></i>{{ __('messages.assetimport') }}
                        <a href="{{ url('/admin/assets') }}" class="btn btn-warning">
                            <span class="glyphicon glyphicon-list"></span>&nbsp;
                            {{ __('messages.ReturnToList') }}
                        </a>
                    </h3>
                </div>
                <div class="clear"></div>
                <div id="filemanager">
                    <div id="content">
                        <div class="flex panel-bordered">
                            <div id="left">
                                <div style="margin: 5px">
                                    @include('bread.assets.datatable')
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!-- #filemanager -->
            </div><!-- .row -->
        </div><!-- .col-md-12 -->
    </div><!-- .page-content container-fluid -->
@stop
