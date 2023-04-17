<form  method="post"  enctype="multipart/form-data">
    <div class="pt-3">
        <div class="row">
            <div class="col-lg-12">
                <div>
                    <label>Blinds Guarantee</label>
                    <div class="mt-2">
                        <textarea name="blinds_guarantee" class="summernote" id="blinds_guarantee">{{$product->tooltip->blind_guarantee ?? ''}}</textarea>
                    </div>
                </div>
                <div>
                    <label>RightFit Guarantee</label>
                    <div class="mt-2">
                        <textarea name="riight_fit_guarantee" class="summernote" id="riight_fit_guarantee">{{$product->tooltip->riight_fit_guarantee ?? ''}}</textarea>
                    </div>
                </div>
                <div>
                    <label>Delivery Time</label>
                    <div class="mt-2">
                        <textarea name="devlivery_time" class="summernote" id="devlivery_time">{{$product->tooltip->devlivery_time ?? ''}}</textarea>
                    </div>
                </div>
            </div>
        </div>
        <div class="px-4 pb-4 text-end tab-btn-position">
            <button type="submit" class="btn btn-primary info-submit" id="tooltipForm">Update</button>
        </div>
    </div>
</form>

@push('js')
<script type="text/javascript">
     jQuery(function($) {
          $('#tooltipForm').on("click", function(e) {
                e.preventDefault();
                var formData = new FormData();
                formData.append('blinds_guarantee', $('#blinds_guarantee').val());
                formData.append('riight_fit_guarantee', $('#riight_fit_guarantee').val());
                formData.append('devlivery_time', $('#devlivery_time').val());
                formData.append('product_id', {{ $productID }})
                axios.post('/admin/product/tooltip/update',formData)
                .then((response) =>{
                    if(response.data.status  == true){
                        toastr.success(response.data.message);
                    }
                })
                .catch((error) =>{
                    console.log(error);
                })

          })
    
})
</script>
@endpush
