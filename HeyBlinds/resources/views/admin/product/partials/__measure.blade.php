<form action="{{route('admin.main.product.measure.store', $productID)}}" enctype="multipart/form-data" id="productMeasureForm">
    @csrf
    <div class="pt-3">
    <div class="row">
        <div class="col-lg-12">
            <h6 class="text-uppercase">Please upload Files Only, PDF, JPG, PNG, JPEG, MP4, mov, avi, wmv, ogg, qt, webm format.</h6>
            <div class="row mt-4">
                <div class="col-sm-6">
                    <label>Installation & Care Instructions</label>
                    <label for="installation_media_id" class="fileUpload btn btn-orange d-flex align-items-center mt-2">
                        <img src="{{asset('images/demo-file.svg')}}" class="icon">
                        <p class="upl ps-2 small mb-0" id="upload">Upload your File</p>
                        <input type="file" class="upload up" name="installation_media_id" id="installation_media_id" accept="application/pdf" onchange="readURL(this);">
                   </label>

                    @if(!empty($productMeasurement->installation_media_id))
                        <a target="_blank" href="{{ $helpers->getImage($productMeasurement->installation_media_id)}}">Uploaded File</a>
                         <span class="text-danger" style="cursor: pointer;" onclick="return removeMeasureMedia({{$productMeasurement->installation_media_id}},{{$productID}});">X</span>
                    @endif
                    
                    @if(!empty($productMeasurement->installation_media_id_1))
                        <a target="_blank" href="{{ $helpers->getImage($productMeasurement->installation_media_id_1)}}">Uploaded File</a>
                    @endif
                    <div class="align-items-center mt-3 form-group">
                        <label class="mb-2 fw-bold" for="installation_media_id_2">Add YouTube Link</label>
                        <input type="text" class="form-control" id="installation_media_id_2" name="installation_media_id_2" value="{{!empty($productMeasurement->installation_media_id_2) ? $productMeasurement->installation_media_id_2 : "" }}" placeholder="For Youtube link">
                    </div>

                </div>
                <div class="col-sm-6">
                    <label>Measuring Guide</label>
                      <label for="measure_media_id" class="fileUpload btn btn-orange d-flex align-items-center mt-2">
                        <img src="{{asset('images/demo-file.svg')}}" class="icon">
                        <p class="upl ps-2 small mb-0" id="upload">Upload your File</p>
                        <input type="file" class="upload up"  name="measure_media_id" id="measure_media_id" accept="application/pdf" onchange="readURL(this);">
                    </label>
                    @if(!empty($productMeasurement->measure_media_id))
                        <a target="_blank" href="{{$helpers->getImage($productMeasurement->measure_media_id)}}">Uploaded File</a>
                        <span class="text-danger" style="cursor: pointer;" onclick="return removeMeasureMedia({{$productMeasurement->measure_media_id}},{{$productID}});">X</span>
                    @endif
                    
                </div>
            </div>
            <div class="mt-3">
                <label for="measure-content">Content</label>
                <div class="mt-2">
                    <textarea name="content" id="measure-content" class="summernote">{{!empty($productMeasurement->content) ? $productMeasurement->content : "" }}</textarea>
                </div>
            </div>
        </div>

    </div>
    <div class="px-4 pb-4 text-end tab-btn-position">
        <button type="submit" class="btn btn-primary info-submit productBasicForm">Submit</button>
    </div>
</div>
</form>
<script type="text/javascript">
    function removeMeasureMedia(id,product_id){
        if(confirm("Are You Sure to delete this")){
           axios.post(`/admin/media/measure/delete`,{
            'media_id': id,
            'product_id': product_id
           }).then((response) =>{
                if(response.data.status == true){
                    toastr.success(response.data.message);
                    window.location.reload();
                }else{
                    toastr.error(response.data.message);
                }
            })
        }
    }
</script>
