<div class="row justify-content-center">
<div class="col-7 mt-3">
    <div class="form-floating">
        <input type="text" class="form-control" id="seo_name" name="seo_name" placeholder="Meta Title" value="{{!empty($seo->title) ? $seo->title : ""}}">
        <label for="seo_name">Meta Title <span class="text-danger">*</span></label>
    </div>
</div>
<div class="col-7  mt-3">
    <div class="form-floating">
        <textarea class="form-control" id="seo_description" name="seo_description" style="height: 100px"> {{!empty($seo->description) ? $seo->description : ""}} </textarea>
        <label for="seo_description">Meta Description <span class="text-danger">*</span></label>
    </div>
</div>
<div class="col-7  mt-3">
    <div class="mt-lg-1 mt-3">
        <label class="mb-2" for="">Upload OG Image</label>
        <div class="dropzone justify-content-center product-image-uplode d-flex flex-wrap align-items-center scrollbar" id="seo_og_image">
        </div>
    </div>
    @if(!empty($seo->og_media_id))
        <a class="mt-3" href="{{$helpers->getImage($seo->og_media_id)}}">View Image</a>
    @endif
</div>
</div>
<div class="px-4 pb-4 text-end tab-btn-position">
<button type="submit" class="btn btn-primary info-submit productBasicForm">Submit</button>
</div>
