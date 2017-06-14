
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
                        <a  title="Pagename: {{ \App\Helper\Asset\Thumbnail::getPagenameByUrl($url) }}" href="#">
                            <img src="{{$url}}" class="thumbnail img-responsive">
                        </a>
                    </div>
                    <div class="caption">
                        <h4 class="pageName">Pagename: {{ \App\Helper\Asset\Thumbnail::getPagenameByUrl($url) }}</h4>
                        <hr/>
                            <textarea rows="3" class="form-control">{{$url}}</textarea>
                        <a href="{{url("admin/assets/downloadHighres")}}?file={{ $url }}" target="blank" class="btn btn-default btn-xs" role="button">Download</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <!--/row-->
</div>
<!--/container -->

<div tabindex="-1" class="modal fade" id="thumbnaillistDetails" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button class="close" type="button" data-dismiss="modal">×</button>
                <h3 class="modal-title">Heading</h3>
            </div>
            <div class="modal-body">

            </div>
            <div class="modal-footer">
                <button class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        $('.thumbnail').click(function(){

            $('.modal-body').empty();

            var title = $(this).parent('a').attr("title");

            $('.modal-title').html(title);
            $($(this).parents('div').html()).appendTo('.modal-body');
            $('#thumbnaillistDetails').modal({show:true});
        });
    });
</script>




