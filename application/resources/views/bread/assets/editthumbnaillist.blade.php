
@php(
    $thumbnailList = json_decode($dataTypeContent->{$row->field},true)
)
<hr class="">
<div class="container editthumbnaillist">
    <div class="row">
       @foreach($thumbnailList as $url)
            <div class="col-md-4">
                <div class="thumbnail drop-shadow">
                    <div class="imageContainer">
                        <a  title="{{ __('messages.Pagename') }}: {{ \App\Helper\Asset\Thumbnail::getPagenameByUrl($url) }}" href="#">
                            <img src="{{$url}}" class="thumbnail img-responsive">
                        </a>
                    </div>
                    <div class="caption">
                        <h4 class="pageName">Pagename: {{ \App\Helper\Asset\Thumbnail::getPagenameByUrl($url) }}</h4>
                        <hr/>
                            <textarea rows="3" class="form-control">{{$url}}</textarea>
                        <a href="{{url("admin/assets/downloadHighres")}}?file={{ $url }}" target="blank" class="btn btn-default btn-xs" role="button">{{ __('messages.Download') }}</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <!--/row-->
</div>
<!--/container -->
@include('bread.assets.dialogs.thumbnail-details');
