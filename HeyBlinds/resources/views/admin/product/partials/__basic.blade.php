<form action="{{route('admin.product.update.new', $productID)}}" enctype="multipart/form-data">
    @csrf
    <div class="row pt-2">
        <div class="col-lg-8">
            <div class="row gx-2">
                <div class="col-xl-6 col-md-7 mt-3">
                    <div class="form-floating">
                        <input type="text" class="form-control clone-product-name" id="name" name="name" placeholder="Product Name *" value="{{!empty($product->name) ? $product->name : ""}}">
                        <label for="name">Product Name <span class="text-primary">*</span></label>
                    </div>
                </div>
               {{--  <div class="col-xl-2 col-md-2 mt-3">
                    <div class="form-floating">
                        <input type="text" class="form-control clone-product-name" id="headrail_price" name="headrail_price" placeholder="Headrail Price" value="{{!empty($product->headrail_price) ? $product->headrail_price : "0"}}">
                        <label for="name">Headrail Price </label>
                    </div>
                </div> --}}
                <div class="col-md-3 col-5 col-xl-2 mt-3">
                    <div class="form-floating">
                        <input type="text" class="form-control clone-product-name" id="sku" name="sku" placeholder="SKU *" value="{{!empty($product->sku) ? $product->sku : ""}}">
                        <label for="sku">SKU <span class="text-primary">*</span></label>
                    </div>
                </div>
                <div class="col-xl-2 col-md-4 col-6 mt-3">
                    <div class="form-floating">
                        <input type="number" class="form-control clone-product-name" id="stock" name="stock" placeholder="Stock" value="{{!empty($product->stock) ? $product->stock : ""}}">
                        <label for="stock">Stock</label>
                    </div>
                </div>
                <div class="col-md-8 mt-3">
                    <div class="input-group ">
						<span class="input-group-text small" id="basic-addon3">https://HeyBlinds.ca/product/</span>
                        <input type="text" class="form-control" id="basic-url" name="slug" placeholder="Enter your slug *" value="{{!empty($product->slug) ? $product->slug : ""}}">
                    </div>
                </div>

                <div class="col-xl-4 col-md-6 col-sm-12 mt-3">
                    <div class="form-floating">
                        <select class="form-select" id="floatingSelectGrid" name="category">
                            <option value="">Select a category *</option>
                            @if(!empty($categories->toArray()))
                                @foreach($categories as $category)
                                    <option value="{{$category->id}}" {{!empty($product->category_id ) && $product->category_id == $category->id ? "selected": "" }}>{{$category->name}}</option>
                                @endforeach
                            @endif
                        </select>
                        <label for="floatingSelectGrid">Category</label>

                    </div>
                </div>
                <div class="col-xl-4 col-md-6 col-sm-12 mt-3">
                    <div class="form-floating">
                        <select class="form-select" id="subCategory" name="sub_category" >

                            <option value="">Select a subcategory</option>
                            @if(!empty($subCategories->toArray()))
                                @foreach($subCategories as $subCategory)
                                    <option value="{{$subCategory->id}}" {{!empty($product->sub_category_id) && $product->sub_category_id  === $subCategory->id ? "selected" : ""}}>{{$subCategory->name}}</option>
                                @endforeach
                            @endif
                        </select>
                        <label for="subCategory">Sub-category</label>
                    </div>
                </div>

                <div class="col-xl-4 col-6  mt-3">
                    <div class="form-floating">
                        <input type="text" class="form-control" id="default_width" placeholder="00" name="default_width" value="{{!empty($product->default_width) ? $product->default_width : ""}}">
                        <label for="default_width">Default Width <span class="text-primary">*</span></label>
                    </div>
                </div>

                <div class="col-xl-4 col-6 mt-3">
                    <div class="form-floating">
                        <input type="text" class="form-control" id="default_height" placeholder="00" name="default_height" value="{{!empty($product->default_height) ? $product->default_height : ""}}">
                        <label for="default_height">Default Height <span class="text-primary">*</span></label>
                    </div>
                </div>

                <div class="col-xl-4 col-6 mt-3">
                    <label >Feature One (50 Char Max) <span class="text-counter">0</span></label>
                    <input type="text" maxlength="50" class="form-control" name="features[]" value="{{!empty($features[0]) ? $features[0] : ""}}">
                </div>
                <div class="col-xl-4 col-6 mt-3">
                    <label >Feature Two (50 Char Max) <span class="text-counter">0</span></label>
                    <input type="text" maxlength="50" class="form-control" name="features[]" value="{{!empty($features[1]) ? $features[1] : ""}}">
                </div>
                <div class="col-xl-4 col-6 mt-3">
                    <label >Feature Three (50 Char Max) <span class="text-counter">0</span></label>
                    <input type="text" maxlength="50" class="form-control" name="features[]" value="{{!empty($features[2]) ? $features[2] : ""}}">
                </div>
                <div class="col-xl-12 col-6 mt-3">
                    <div class="form-floating">
                        <input type="text" class="form-control clone-product-name" id="product_image_alt_title" name="product_image_alt_title" placeholder="Product image alt title" value="{{!empty($product->product_image_alt_title) ? $product->product_image_alt_title : ""}}">
                        <label for="product_image_alt_title">Product image alt title <span class="text-primary">*</span></label>
                    </div>
                </div>
               <div class="col-12 mt-1">
                       <div class="check-box d-inline-block mt-3 me-3">
                           <input class="form-check-input" type="checkbox" value="1" id="is_new" name="is_new" {{!empty($product->is_new) && $product->is_new == 1 ? "checked" : ""}}>
                           <label class="form-check-label" for="is_new">
                               New Product
                           </label>
                       </div>

                       <div class="check-box d-inline-block mt-3 me-3">
                           <input class="form-check-input" type="checkbox" value="1" id="is_feature" name="is_feature" {{!empty($product->is_feature) && $product->is_feature == 1 ? "checked" : ""}}>
                           <label class="form-check-label" for="is_feature">
                               Make Featured
                           </label>
                       </div>

                       <div class="check-box d-inline-block mt-3 me-3">
                           <input class="form-check-input" type="checkbox" value="1" id="show_home_page" name="show_home_page" {{!empty($product->show_home_page) && $product->show_home_page == 1 ? "checked" : ""}}>
                           <label class="form-check-label" for="show_home_page">
                               Show On Home Page
                           </label>
                       </div>

                       <div class="check-box d-inline-block mt-3 me-3">
                           <input class="form-check-input" type="checkbox" value="1" id="is_on_sale" name="is_on_sale" {{!empty($product->is_on_sale) && $product->is_on_sale == 1 ? "checked" : ""}}>
                           <label class="form-check-label" for="is_on_sale">
                               On Sale
                           </label>
                       </div>

                       <div class="check-box d-inline-block mt-3 me-3">
                           <input class="form-check-input" type="checkbox" value="1" id="is_live" name="is_live" {{empty($product->is_live) && $product->is_live == 0 ? "checked" : ""}}>
                           <label class="form-check-label" for="is_live">
                               Inactive
                           </label>
                       </div>
                       <div class="check-box d-inline-block mt-3 me-3">
                           <input class="form-check-input" type="checkbox" value="1" id="made_in_canada" name="made_in_canada" {{$product->made_in_canada == 1 ? "checked" : ""}}>
                           <label class="form-check-label" for="made_in_canada">
                               Made in Canada
                           </label>
                       </div>

               </div>
                <div class="col-12  mt-3">
                    <label>Excerpt (250 Char Max)</label>
                    <div class="mt-2">
                        <textarea name="excerpt" class="summernote">{{!empty($product->excerpt) ? $product->excerpt : ""}}</textarea>
                    </div>
                </div>

                <div class="col-12 mt-4">
                    <div class="pt-3">
                        <div class="video-url-input mb-3">
                            <label class="mb-2">YouTube Video URL</label>
                            <div class="form-floating">
                                <select type="text" class="form-control enter-video-url" id="enter-video-url" name="video_url[]" multiple>
                                    @if(!empty($product->video_url))
                                        @foreach(json_decode($product->video_url) as $video)
                                            <option value="{{$video}}" selected>{{$video}}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="upload-video-section ">
                            <label class="mb-2">Upload Videos</label>
                            <div class="dropzone justify-content-center product-video-uplode d-flex flex-wrap align-items-center scrollbar" id="video_id">
                            </div>
                            @if(!empty($product->video_id))
                                @foreach(json_decode($product->video_id) as $vKey => $videoURL)
                                    <div class="mt-3 ms-2 image-link">
                                        <a href="{{$helpers->getImage($videoURL)}}" target="_blank">Video URL {{$vKey+1}}</a>
                                        <span data-pid="{{$product->id}}" data-type="video" data-id="{{$videoURL}}" class="badge bg-danger remove-product-image-badge">x</span>
                                        <input type="hidden" value="{{$videoURL}}" name="video_id[]">
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="mt-lg-1 mt-3">
                <label class="mb-2" for="">Upload Product Display Image <span class="text-danger"> *</span></label>
                <div class="dropzone justify-content-center product-image-uplode d-flex flex-wrap align-items-center scrollbar" id="display_image">
                    <input type="hidden" name="display_media_id" value="{{$product->display_media_id}}">
                </div>
                @if(!empty($product->display_media_id))
                   <div class="mt-3 ms-2 image-link"> <a href="{{$helpers->getImage($product->display_media_id)}}"  target="_blank">Display Image URL </a> <span data-pid="{{$product->id}}" data-type="display" data-id="{{$product->display_media_id}}" class="badge bg-danger remove-product-image-badge">x</span></div>
                @endif
            </div>

            <div class="mt-3">
                <label class="mb-2" for="">Upload Slider Images for Product Details Page</label>
                <div class="dropzone justify-content-center product-image-uplode d-flex flex-wrap align-items-center scrollbar" id="slider_image">
                </div>
                @if(!empty($product->slider_id))
                    <div class="table-responsive">
                        <table class="table table-hover colourtable">
                            <tbody class="ui-sortable sortable">


                                    @foreach(json_decode($product->slider_id) as $sKey => $sliderID)

                                    <tr id="item-{{$sliderID}}">
                                        <td>#</td>
                                            <td>
                                                Slider Image URL {{$sKey+1}} <a href="{{$helpers->getImage($sliderID)}}" target="_blank" class="ml-3">Show image</a>
                                                <span data-pid="{{$product->id}}" data-id="{{$sliderID}}" data-type="slider" class="badge bg-danger remove-product-image-badge">x</span>
                                            </td>
                                    </tr>
                                    <input type="hidden"  value="{{$sliderID}}" name="slider_id[]">

                                    @endforeach
                                    <input type="hidden" id="new_slider" name="new_slider" value="">

                            </tbody>
                        </table>
                    </div>
                    @endif
                </div>
            </div>

        <div class="col-12 mt-3">
            <lable>Product Specification</lable>
            <div class="d-block mt-2">
                <textarea class="summernote" name="content">
                {{!empty($product->content) ? $product->content : ""}}
              </textarea>
            </div>

        </div>
    </div>
    <div class="px-4 pb-4 text-end tab-btn-position">

        <button type="submit"  class="btn btn-secondary info-submit productBasicForm" name="draft" data-type="draft">Save Draft</button>
        <button type="submit" class="btn btn-primary info-submit productBasicForm" name="save" data-type="save">Submit</button>
    </div>
</form>
@push('js')
<script>
    $(document).ready(function(e){
            $(".sortable" ).sortable({
                stop: function (event, ui) {
                    var data = $(this).sortable('serialize');
                    $.ajax({
                        data: {
                            'request_id' : {{$productID}},
                            "data" : data,
                        },
                        type: 'POST',
                        url: '{{route('sort.product.slide.image')}}',
                        success: function(response) {
                            if (response ) {
                                $('#new_slider').val(1);
                                // var inputEl = document.createElement('INPUT');
                                // inputEl.setAttribute('type', 'hidden');
                                // inputEl.setAttribute('name', 'new_slider');
                                // inputEl.setAttribute('value', '1');
                                // console.log(inputEl);
                            }
                        }
                    });
                }
            });
        })
</script>

@endpush
