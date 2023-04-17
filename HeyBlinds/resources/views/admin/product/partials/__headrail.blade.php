<div>
    <div class="row col-12 pt-3 option-price-heading-text">
        <h6>Add Price</h6>
        <div class="col-md-6">
            <div class="check-box d-inline-block mt-4 ">
                <input type="checkbox" id="headrail-status" name="headrail_status"
                    {{ !empty($headrailOption->headrail_status) && $headrailOption->headrail_status == 1 ? 'checked' : '' }}
                    onchange="headrailStatus(this)">
                <label for="headrail-status" class="ml-2"><b>Active</b></label>
            </div>
        </div>
        <div class="col-md-6">
            <div class="check-box d-inline-block mt-4 ">
                <input type="checkbox" id="separate-blind" name="separate_blind"
                    {{ !empty($headrailOption->is_separate_blinds) && $headrailOption->is_separate_blinds == 1 ? 'checked' : '' }}
                    onchange="separateBlind(this)">
                <label for="separate-blind" class="ml-2"><b>Price as two separate blinds</b></label>
            </div>
        </div>
    </div>
    <div class="row mt-4 ">
        <input type="hidden" name="product_id_for_side" id="product_id_for_side" value="{{ $productID }}" />
        <div class="col-6">
            <label><b>Left Side</b></label>
            <div class="d-flex">
                <div class="radio-box d-inline-block mt-3 me-3">
                    <input id="left_side_left" class="form-check-input" type="radio" value="1" name="left_side_panel"
                        {{ ($headrailOption->left_status ?? '') == 1 ? 'checked' : '' }}
                        onclick="changeLeftStatus(this)">
                    <label class="form-check-label" for="left_side_left">
                        Left
                    </label>
                </div>
                <div class="radio-box d-inline-block mt-3 me-3">
                    <input id="left_side_right" class="form-check-input" type="radio" value="2" name="left_side_panel"
                        {{ ($headrailOption->left_status ?? '') == 2 ? 'checked' : '' }}
                        onclick="changeLeftStatus(this)">
                    <label class="form-check-label" for="left_side_right">
                        Right
                    </label>
                </div>
                <div class="radio-box d-inline-block mt-3 me-3">
                    <input id="left_side_both" class="form-check-input" type="radio" value="3" id="radio"
                        name="left_side_panel" {{ ($headrailOption->left_status ?? '') == 3 ? 'checked' : '' }}
                        onclick="changeLeftStatus(this)">
                    <label class="form-check-label" for="left_side_both">
                        Left and Right.
                    </label>
                </div>
            </div>
        </div>
        <div class="col-6">
            <label><b>Right Side</b></label>
            <div class="d-flex">
                <input type="hidden" name="product_id_for_side" id="product_id_for_side" value="{{ $productID }}" />
                <div class="radio-box d-inline-block mt-3 me-3">
                    <input id="right_side_left" class="" type="radio" value="1" name="right_side"
                        {{ ($headrailOption->right_status ?? '') == 1 ? 'checked' : '' }}
                        onclick="changeRightStatus(this)">
                    <label class="radio-label" for="right_side_left">
                        Left
                    </label>
                </div>
                <div class="radio-box d-inline-block mt-3 me-3">
                    <input id="right_side_right" class="form-check-input" type="radio" value="2" name="right_side"
                        {{ ($headrailOption->right_status ?? '') == 2 ? 'checked' : '' }}
                        onclick="changeRightStatus(this)">
                    <label class="form-check-label" for="right_side_right">
                        Right
                    </label>
                </div>
                <div class="radio-box d-inline-block mt-3 me-3">
                    <input id="right_side_both" class="form-check-input" type="radio" value="3" name="right_side"
                        {{ ($headrailOption->right_status ?? '') == 3 ? 'checked' : '' }}
                        onclick="changeRightStatus(this)">
                    <label class="form-check-label" for="right_side_both">
                        Left and Right
                    </label>
                </div>
            </div>
        </div>
    </div>
    <div id="option-price-check" class="col-12">
        <form action="#" method="post" id="headrail-form">
            <input type="hidden" name="product_id" value="{{ $productID }}" />
            @if ($headrails->count() > 0)
                @foreach ($headrails as $headrail)
                    <div class="row gx-2  mt-3 option-price">
                        <div class="col-md-3">
                            <div class="form-floating">
                                <input type="number" class="form-control" value="{{ $headrail->min_width }}"
                                    placeholder="Width" name="min_width[]" required>
                                <label for="">Min Width</label>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-floating">
                                <input type="number" class="form-control" value="{{ $headrail->max_width }}"
                                    placeholder="Width" name="max_width[]" min="0" required>
                                <label for="">Max Width</label>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-floating">
                                <select class="form-select" aria-label="Floating label select" name="price_type[]">
                                    <option value="1" {{ $headrail->price_type == 1 ? 'selected' : '' }}>Dollar
                                    </option>
                                    <option value="2" {{ $headrail->price_type == 2 ? 'selected' : '' }}>
                                        Percentage</option>
                                </select>
                                <label for="">Price Type</label>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-floating">
                                <input type="text" class="form-control price_headrail" value="{{ $headrail->price }}"
                                    placeholder="Width" name="price[]" required>
                                <label for="">Price</label>
                            </div>
                        </div>
                        <div class="col-md-1">
                            <a class="btn remove-option-price btn-secondary btn-sm pe-3 d-flex justify-content-center align-items-center h-100 ms-auto"
                                data-id="{{ $headrail->id }}" data-type="price"><svg
                                    xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-trash ml-2" viewBox="0 0 16 16">
                                    <path
                                        d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z">
                                    </path>
                                    <path fill-rule="evenodd"
                                        d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z">
                                    </path>
                                </svg><span class="d-none ms-2 d-md-block">Remove</span></a>
                        </div>
                    </div>
                @endforeach

            @else
                <input type="hidden" name="product_id" value="{{ $productID }}" />
                <div class="row gx-2 option-price mt-3">
                    <div class="col-md-3">
                        <div class="form-floating">
                            <input type="number" class="form-control" value="" placeholder="Width" name="min_width[]"
                                required />
                            <label for="">Min Width</label>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-floating">
                            <input type="number" class="form-control" value="" placeholder="Width" name="max_width[]"
                                required />
                            <label for="">Max Width</label>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-floating">
                            <select class="form-select" aria-label="Floating label select" name="price_type[]">
                                <option value="1">Dollar</option>
                                <option value="2">Percentage</option>
                            </select>
                            <label for="">Price Type</label>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-floating">
                            <input type="text" class="form-control price_headrail" placeholder="Width" name="price[]" />
                            <label for="">Price</label>
                        </div>
                    </div>
                </div>
            @endif
            <div id="append-price">

            </div>

            <div class="row">
                <div class="col-md-6 mt-3">
                    <div class="form-floating">
                        <textarea class="form-control" placeholder="Leave a comment here" name="tooltip_description"
                            style="height:100px">{{ $headrailOption->tooltip_description ?? '' }}</textarea>
                        <label for="">Add Tooltip Text:</label>
                    </div>
                </div>

                <div class="col-md-6 mt-3">
                    <div class="form-floating">
                        <textarea class="form-control" placeholder="Leave a comment here" name="note" id=""
                            style="height:100px">{{ $headrailOption->headrail_toltip ?? '' }}</textarea>
                        <label for="">Add Headrail tooltip:</label>
                    </div>
                </div>

            </div>

            <div class="row pull-right pt-4">
                <div class="col-md-12 justify-content-between d-flex">
                    <button id="add-headrail-price" type="button"
                        class="btn btn-primary btn-sm pe-3 d-flex align-items-center add-option-price">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-plus" viewBox="0 0 16 16">
                            <path
                                d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z">
                            </path>
                        </svg>
                        <span class="d-none d-md-block ">Add more</span>
                    </button>
                    <button class="btn btn-primary px-5" type="submit">Save</button>
                </div>
            </div>

        </form>


    </div>
</div>

@push('js')
    <script type="text/javascript">
        // $(document).ready(function(){
        //     if($('#separate-blind').is(':checked')){
        //         $('.price_headrail').attr('readonly',true);
        //     }else{
        //         $('.price_headrail').attr('readonly',false);
        //     }
        // })
        function headrailStatus($this) {
            var product_id = $('#product_id_for_side').val();
            axios.post(`/admin/headrail-status/${product_id}`, {

            }).then((response) => {

            })
        }

        function separateBlind($this) {
            // if($($this).is(':checked')){
            //     $('.price_headrail').attr('readonly',true);
            // }
            // else{
            //     $('.price_headrail').attr('readonly',false);
            // }
            var product_id = $('#product_id_for_side').val();
            axios.post(`/admin/separate-blinds/${product_id}`, {

            }).then((response) => {

            })
        }

        function changeLeftStatus($this) {
            var product_id = $('#product_id_for_side').val();
            axios.post(`/admin/product/headrail-left-side/${product_id}`, {
                    'left_side_panel': $this.value
                })
                .then((response) => {
                    console.log(response)
                })
        }

        function changeRightStatus($this) {
            var product_id = $('#product_id_for_side').val();
            axios.post(`/admin/product/headrail-right-side/${product_id}`, {
                    'right_side_panel': $this.value
                })
                .then((response) => {
                    console.log(response)
                })
        }
        $(document).on('click', "#add-headrail-price", function(e) {
            e.preventDefault();
            let appendRow = `<div class="row gx-2 mt-3 option-price option-price-add-row">
                <div class="col-md-3">
                    <div class="form-floating">
                        <input type="number" class="form-control" value="" placeholder="Width" name="min_width[]" required>
                        <label for="">Min Width</label>
                    </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-floating">
                            <input type="number" class="form-control" value="" placeholder="Width" name="max_width[]" min="0" required>
                            <label for="">Max Width</label>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-floating">
                            <select class="form-select" aria-label="Floating label select" name="price_type[]">
                                <option value='1'>Dollar</option>
                                <option value='2'>Percentage</option>
                            </select>
                            <label for="">Price Type</label>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-floating">
                            <input type="text" class="form-control price_headrail" id="price"  placeholder="Width" name="price[]">
                            <label for="">Price</label>
                        </div>
                    </div>
                <div class="col-md-1">
                    <button type="button" class="btn remove-button  btn-secondary btn-sm pe-3 d-flex w-100 justify-content-center align-items-center h-100">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                            <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                            <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                        </svg>
                        <span class="ms-2">Remove</span>
                    </button>
                </div>
            </div>`;
            $("#append-price").append(appendRow);
        })
        $(document).on('click', '.remove-button', function(e) {
            e.preventDefault();
            $(this).parents(".option-price-add-row").remove();
            toastr.error('Removed!')
        })

        $(document).on('submit', '#headrail-form', function(e) {
            e.preventDefault();
            let $this = $(this);
            let formData = $this.serialize();
            axios.post(`/admin/product/product-headreail`, formData)
                .then((res) => {
                    if (res.data.status == true) {
                        toastr.success(res.data.message);
                    }
                })
        })
        $(document).on('click', '.remove-option-price', function(e) {
            e.preventDefault();
            let $this = $(this);
            let id = $this.attr('data-id');
            if ($this.attr('data-id') !== "") {
                axios.delete(`/admin/product/product-headreail-delete/${id}`)
                    .then(function(response) {
                        toastr.error('Removed!')
                        $this.parents('.option-price').remove();
                    }).catch(function(error) {
                        console.log(error)
                        let errors = error.response.data.errors;
                        $.each(errors, function(key, value) {
                            toastr.error(value)
                        })
                    });
            }
        })
    </script>
@endpush
