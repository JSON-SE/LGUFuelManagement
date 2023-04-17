<div class="h-100 w-100 d-flex pt-4 justify-content-center">
    <form id="home_media_form" class="border p-3 rounded-3" action="">
        @include('partial.message')
        <div class="avatar-upload">
            <label>Upload image for Homepage </label>

            <div class="avatar-preview mt-2">

                <img id="banner-image-up" src="{{ $helpers->getImage($product->home_media_id) }}" alt="" />
            </div>
            <div class="avatar-edit mt-3">
                <input type="hidden" name="product_id" value="{{ $productID }}">
                <input
                    onchange="document.getElementById('banner-image-up').src = window.URL.createObjectURL(this.files[0])"
                    type="file" class="form-control" name="home_media_id" accept=".png, .jpg, .jpeg">
                <label for="imageUpload"></label>
            </div>
            <div class="col-xl-12 col-6 mt-2">
                <div class="form-floating">
                    <input type="text" class="form-control clone-product-name" id="product_home_image_alt_title"
                        name="product_home_image_alt_title" placeholder="Product image alt title"
                        value="{{ !empty($product->product_home_image_alt_title) ? $product->product_home_image_alt_title : '' }}">
                    <label for="product_home_image_alt_title">Product home image alt title <span
                            class="text-primary">*</span></label>
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-primary mt-2">Submit</button>
    </form>

</div>


{{-- <a href="{{$helpers->getImage($product->home_media_id)}}"> View Image</a> --}}


@push('js')

    <script type="text/javascript">
        $(document).on('submit', "#home_media_form", function(e) {
            e.preventDefault();
            let formData = new FormData(this)
            $("#loader").show();
            axios.post(`/admin/product/home-media-form`, formData)
                .then((response) => {
                    $("#loader").hide();
                    if (response.data.status == true) {
                        toastr.success(response.data.message);
                    }
                })
                .catch((error) => {
                    toastr.error('Something went wrong.');
                })
        });
    </script>
@endpush
