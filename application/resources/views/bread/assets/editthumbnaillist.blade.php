
@php(
    $thumbnailList = json_decode($dataTypeContent->{$row->field},true)
)
<hr class="">
<div class="container editthumbnaillist">
    <div class="row">
       @foreach($thumbnailList as $url)
            @if(strpos($url,'lowres.mp4')>-1)
                @include('bread.assets.listitems.video')
            @else
                @include('bread.assets.listitems.image')
            @endif
        @endforeach
    </div>
    <!--/row-->
</div>
<!--/container -->
@include('bread.assets.dialogs.thumbnail-details');
