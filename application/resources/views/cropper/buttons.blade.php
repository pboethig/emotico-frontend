<div class="row">
    <div class="col-md-9 docs-buttons">
        <h3>{{ __("messages.Toolbar") }}:</h3>
        <hr>
        <div class="btn-group">
            <button type="button" class="btn btn-primary" data-method="setDragMode" data-option="move" title="Move">
            <span class="docs-tooltip" data-toggle="tooltip" data-animation="false" title="$().cropper(&quot;setDragMode&quot;, &quot;move&quot;)">
              <span class="fa fa-arrows"></span>
            </span>
            </button>
            <button type="button" class="btn btn-primary" data-method="setDragMode" data-option="crop" title="Crop">
            <span class="docs-tooltip" data-toggle="tooltip" data-animation="false" title="$().cropper(&quot;setDragMode&quot;, &quot;crop&quot;)">
              <span class="fa fa-crop"></span>
            </span>
            </button>
        </div>
        <!--

           <div class="btn-group">
               <button type="button" class="btn btn-primary" data-method="zoom" data-option="0.1" title="Zoom In">
               <span class="docs-tooltip" data-toggle="tooltip" data-animation="false" title="$().cropper(&quot;zoom&quot;, 0.1)">
                 <span class="fa fa-search-plus"></span>
               </span>
               </button>
               <button type="button" class="btn btn-primary" data-method="zoom" data-option="-0.1" title="Zoom Out">
               <span class="docs-tooltip" data-toggle="tooltip" data-animation="false" title="$().cropper(&quot;zoom&quot;, -0.1)">
                 <span class="fa fa-search-minus"></span>
               </span>
               </button>
           </div>

           <div class="btn-group">
               <button type="button" class="btn btn-primary" data-method="move" data-option="-10" data-second-option="0" title="Move Left">
               <span class="docs-tooltip" data-toggle="tooltip" data-animation="false" title="$().cropper(&quot;move&quot;, -10, 0)">
                 <span class="fa fa-arrow-left"></span>
               </span>
               </button>
               <button type="button" class="btn btn-primary" data-method="move" data-option="10" data-second-option="0" title="Move Right">
               <span class="docs-tooltip" data-toggle="tooltip" data-animation="false" title="$().cropper(&quot;move&quot;, 10, 0)">
                 <span class="fa fa-arrow-right"></span>
               </span>
               </button>
               <button type="button" class="btn btn-primary" data-method="move" data-option="0" data-second-option="-10" title="Move Up">
               <span class="docs-tooltip" data-toggle="tooltip" data-animation="false" title="$().cropper(&quot;move&quot;, 0, -10)">
                 <span class="fa fa-arrow-up"></span>
               </span>
               </button>
               <button type="button" class="btn btn-primary" data-method="move" data-option="0" data-second-option="10" title="Move Down">
               <span class="docs-tooltip" data-toggle="tooltip" data-animation="false" title="$().cropper(&quot;move&quot;, 0, 10)">
                 <span class="fa fa-arrow-down"></span>
               </span>
               </button>
           </div>

           <div class="btn-group">
               <button type="button" class="btn btn-primary" data-method="rotate" data-option="-45" title="Rotate Left">
               <span class="docs-tooltip" data-toggle="tooltip" data-animation="false" title="$().cropper(&quot;rotate&quot;, -45)">
                 <span class="fa fa-rotate-left"></span>
               </span>
               </button>
               <button type="button" class="btn btn-primary" data-method="rotate" data-option="45" title="Rotate Right">
               <span class="docs-tooltip" data-toggle="tooltip" data-animation="false" title="$().cropper(&quot;rotate&quot;, 45)">
                 <span class="fa fa-rotate-right"></span>
               </span>
               </button>
           </div>

           <div class="btn-group">
               <button type="button" class="btn btn-primary" data-method="scaleX" data-option="-1" title="Flip Horizontal">
               <span class="docs-tooltip" data-toggle="tooltip" data-animation="false" title="$().cropper(&quot;scaleX&quot;, -1)">
                 <span class="fa fa-arrows-h"></span>
               </span>
               </button>
               <button type="button" class="btn btn-primary" data-method="scaleY" data-option="-1" title="Flip Vertical">
               <span class="docs-tooltip" data-toggle="tooltip" data-animation="false" title="$().cropper(&quot;scaleY&quot;, -1)">
                 <span class="fa fa-arrows-v"></span>
               </span>
               </button>
           </div>
   -->
        <div class="btn-group">
            <button type="button" class="btn btn-primary" data-method="reset" title="Reset">
            <span class="docs-tooltip" data-toggle="tooltip" data-animation="false" title="$().cropper(&quot;reset&quot;)">
              <span class="fa fa-refresh"></span>
            </span>
            </button>
        </div>

        <div class="btn-group btn-group-crop">
            <button type="button" class="btn btn-success" data-method="getCroppedCanvas">
            <span class="docs-tooltip" data-toggle="tooltip" data-animation="false" title="$().cropper(&quot;getCroppedCanvas&quot;)">
              {{ __('messages.GetCroppedCanvas') }}
            </span>
            </button>
        </div>

        <button type="button" class="btn btn-warning" data-method="zoomTo" data-option="1">
          <span class="docs-tooltip" data-toggle="tooltip" data-animation="false" title="cropper.zoomTo(1)">
            {{ __('messages.Zoom') }} 100%
          </span>
        </button>
    </div><!-- /.docs-buttons -->
    @include("cropper.predefinedFormats");
</div>