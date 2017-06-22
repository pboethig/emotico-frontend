<div class="col-md-4">
    <div class="thumbnail drop-shadow">
        <div class="imageContainer embed-responsive embed-responsive-16by9">
            <video class="videoTag"  controls  muted preload="metadata" loop>
                <source style="margin: 0;padding:0;" src="{{ $url }}" type="video/mp4">
                <source style="margin: 0;padding:0;" src="{{ $url }}" type="video/ogg">
                Your browser does not support the video tag.
            </video>
        </div>
        <div class="caption">
            <h4 class="pageName">Pagename: {{ \App\Helper\Asset\Thumbnail::getPagenameByUrl($url) }}</h4>
            <hr/>
            <textarea rows="3" class="form-control">{{$url}}</textarea>
            <a href="{{url("admin/assets/downloadHighres")}}?file={{ $url }}" target="blank" class="btn btn-default btn-xs" role="button">{{ __('messages.Download') }}</a>
        </div>
    </div>
</div>