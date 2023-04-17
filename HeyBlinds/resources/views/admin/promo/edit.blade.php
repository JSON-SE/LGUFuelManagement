@extends('layouts.Backend.admin.admin')
@section('content')
    <form action="{{ route('admin.promo.update', $promo->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <section id="body-content" class="">
            <div class="container-fluid px-lg-5 px-md-4 pb-5 pt-lg-3">
                <div class="row pt-4">
                    <div class="col-12">
                        <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='white'/%3E%3C/svg%3E&#34;);"
                            aria-label="breadcrumb">
                            <ol class="breadcrumb mb-2">
                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Update Promo</li>
                            </ol>
                        </nav>
                    </div>
                </div>
                <div class="row pb-4">
                    <div class="col-sm-6 text-white my-auto">
                        <h3 class="mb-0">Edit: {{ $promo->name ?? '' }}</h3>
                    </div>
                    <div class="col-sm-6 pt-3 pt-lg-0 my-auto d-flex justify-content-sm-end">
                        <a href="{{ route('admin.promo.index') }}" class="btn btn-light">All Promos</a>
                        <a href="{{ route('admin.promo.create') }}"
                            class="btn btn-primary d-flex align-items-center ms-2">
                            <span class="d-none d-md-block">Create new Promo</span>
                        </a>
                    </div>

                </div>

                <div class="bg-white rounded page-height mt-3 shadow">
                    @include('partial.message')
                    <div class="p-4">
                        <div class="row gx-2">
                            <div class="col-lg-3">
                                <div class="form-floating mt-3">
                                    <input type="text" class="form-control" name="name" id="name"
                                        value="{{ $promo->name }}" placeholder="Coupon Name">
                                    <label for="name">Promo Title<span class="text-primary">*</span></label>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-floating mt-3">
                                    <select name="type" id="type" class="form-select discount-selectbox">
                                        <option value="">Select Type</option>
                                        <option value="percentage"
                                            {{ $promo->discount_type === 'percentage' ? 'selected' : (old('type') == 'percentage' ? 'selected' : '') }}>
                                            Percentage
                                        </option>
                                        <option value="flat"
                                            {{ $promo->discount_type === 'flat' ? 'selected' : (old('type') == 'flat' ? 'selected' : '') }}>
                                            Fixed
                                            Amount</option>
                                        {{-- <option value="free_shipping"
                                            {{ $promo->discount_type === 'free_shipping' ? 'selected' : (old('type') == 'free_shipping' ? 'selected' : '') }}>Free Shipping
                                        </option> --}}
                                    </select>
                                    <label for="type">Promo Type<span class="text-primary">*</span></label>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="input-group mt-3">
                                    <span class="input-group-text input-group-text-amount">%</span>
                                    <input type="text" class="form-control" id="amountField" name="amount"
                                        value="{{ $promo->amount }}"
                                        {{ $promo->discount_type === 'free_shipping' ? 'disabled' : '' }}
                                        aria-label="Amount (to the nearest dollar)"
                                        oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                                        maxlength="2">
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="input-group mt-3">
                                    <span class="input-group-text input-group-text-amount">%</span>
                                    <input type="text" class="form-control" id="extra_amount_promo" name="extra_amount"
                                        value="{{ $promo->extra_amount }}"
                                        {{ $promo->discount_type === 'free_shipping' ? 'disabled' : '' }}
                                        aria-label="Amount (to the nearest dollar)"
                                        oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                                        placeholder="Extra discount" autocomplete="off" maxlength="2">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-floating mt-3">
                                    <input type="datetime-local" class="form-control" id="start_date" name="start_date"
                                        step="1"
                                        value="{{ date('Y-m-d', strtotime($promo->start_date)) . 'T' . date('H:i:s', strtotime($promo->start_date)) }}"
                                        placeholder="Start Date">
                                    <label for="start_date">Start Date<span class="text-primary">*</span></label>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-floating mt-3">
                                    <input type="datetime-local" class="form-control" id="end_date" name="end_date"
                                        step="1"
                                        value="{{ date('Y-m-d', strtotime($promo->end_date)) . 'T' . date('H:i:s', strtotime($promo->end_date)) }}"
                                        placeholder="End Date" min="{{ date('Y-m-d') . 'T' . date('H:i:s') }}">
                                    <label for="end_date">End Date<span class="text-primary">*</span></label>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="mt-3">
                                    <input class="form-control form-control-lg" type="file" id="formFile" name="banner"
                                        accept="image/*">
                                    {{-- @if (!empty($promo->promo_banner))
                                        <a href="{{ $helpers->getImage($promo->promo_banner) }}" target="_blank">Click Here To See image</a>
                                    @endif --}}
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-floating mt-3">
                                    {{-- <input type="text" class="form-control" name="banner_link" id="banner_link" value="{{$promo->helpbanner_link}}" placeholder="Banner Link" > --}}
                                    <input type="text" class="form-control" name="banner_link" id="banner_link"
                                        value="{{ $helpers->bannerUrl($promo->id) }}" placeholder="Banner Link">
                                    <label for="banner_link">Banner Link</label>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="form-floating mt-3">
                                    <input type="text" class="form-control" name="ticker" id="ticker"
                                        value="{{ $promo->ticker }}" placeholder="Message Bar Text">
                                    <label for="ticker">Message Bar Text</label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="check-box d-inline-block mt-4">
                                    <input type="checkbox" id="is_active" name="is_active" value="1"
                                        {{ $promo->is_active == true ? 'checked' : '' }}>
                                    <label for="is_active">Active</label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="check-box d-inline-block mt-4">
                                    <input type="checkbox" id="hide_timer" name="hide_timer" value="1"
                                        {{ $promo->hide_timer == true ? 'checked' : '' }}>
                                    <label for="hide_timer">Hide Timer</label>
                                </div>
                            </div>
                        </div>

                        <div class="row gx-2 mt-3">
                            <div class="col-md-6">
                                <div class="form-floating mt-3">
                                    <input type="text" class="form-control" name="mob_text_bar" id="mob_text_bar"
                                        value="{{ $promo->mob_text_bar }}" placeholder="Message Bar Text">
                                    <label for="ticker">Message Bar for mobile </label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating mt-3">
                                    <input type="text" class="form-control" name="coupon_text_box" id="coupon_text_box"
                                        value="{{ $promo->coupon_text_box ?? ' ' }}"
                                        placeholder="Enter coupon box message" />
                                    <label for="ticker">Enter coupon box message </label>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="mt-3">
                                    <label for="content" class="mb-2 fw-bold">Detail Promo Description </label>
                                    <textarea id="content" name="content"
                                        class="summernote">{{ $promo->content }}</textarea>
                                </div>
                            </div>
                        </div>
                        @if ($sliders->count() > 0)
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="mt-3">
                                        <label for="content" class="mb-2 fw-bold">Slider reorder</label>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table table-hover colourtable">
                                            <tbody class="ui-sortable sortable">
                                                @foreach ($sliders as $key => $slider)
                                                    <tr id="item-{{ $slider->id }}">
                                                        <td>#</td>
                                                        <td>Slider {{ $key + 1 }} <a
                                                                href="{{ $helpers->getSliderImage($slider->media_id) }}"
                                                                target="_blank" class="ml-3">Show image</a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        @endif
                        <div class="product-specific-discount mt-4">
                            <label class="mb-2 fw-bold">Product specific discount </label>.
                            {{-- {{ json_decode($promo->product_specific_discount) }} --}}
                            @php
                                $extra_pomos = json_decode($promo->product_specific_discount) ?? [];
                                // print_r($extra_pomos);
                            @endphp

                            {{-- {{ print_r($products) }} --}}
                            <div class="product-specific-discount-row" id="product-specific-discount-row">
                                @foreach ($extra_pomos as $key => $item)

                                    <div class="row">
                                        <div class="col-lg-2 col-md-6 mb-3">
                                            <div class="form-floating">
                                                <select name="dorp_down_subcategori_list_{{ $key }}[]"
                                                    class="form-select form-control all-product-category"
                                                    data-counter="{{ $key }}" required multiple>
                                                    <option value="">Select Subcategory</option>
                                                    @foreach ($item->categories_id ?? [] as $sub_category_id)
                                                        @foreach ($subcategories as $sub_category)
                                                            @if ($sub_category_id == $sub_category->id)
                                                                <option value="{{ $sub_category->id }}" selected>
                                                                    {{ $sub_category->name }}</option>
                                                            @else
                                                                <option value="{{ $sub_category->id }}">
                                                                    {{ $sub_category->name }}</option>
                                                            @endif
                                                        @endforeach
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-2 col-md-6 mb-3">
                                            <div class="form-floating">
                                                <select name="dorp_down_product_list_{{ $key }}[]"
                                                    class="form-select form-control all-product-list" required multiple>
                                                    <option value="">Select Products</option>
                                                    @foreach ($item->products_id ?? [] as $product_list_id)
                                                        @foreach ($products as $product)
                                                            @if ($product_list_id == $product->id)
                                                                <option value="{{ $product->id }}" selected>
                                                                    {{ $product->name }}</option>
                                                            @else
                                                                <option value="{{ $product->id }}">
                                                                    {{ $product->name }}
                                                                </option>
                                                            @endif
                                                        @endforeach
                                                    @endforeach

                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-2 col-md-6 mb-3">
                                            <div class="form-floating">
                                                <select name="discount_type[]" id="product_discount_row_type_1"
                                                    class="form-select form_discount_type_select" required
                                                    onchange="setAmountPrefix(this)">
                                                    <option value="">Select Type</option>
                                                    <option value="percentage"
                                                        {{ $item->discount_type == 'percentage' ? 'selected' : '' }}>
                                                        Percentage</option>
                                                    <option value="flat"
                                                        {{ $item->discount_type == 'flat' ? 'selected' : '' }}>Fixed
                                                        Amount</option>
                                                    {{-- <option value="free_shipping"
                                                        {{ $item->discount_type == 'free_shipping' ? 'selected' : '' }}>
                                                        Free Shipping</option> --}}
                                                </select>
                                                <label for="product_discount_row_type_1">Promo Type <span
                                                        class="text-primary">*</span></label>
                                            </div>
                                        </div>
                                        <div class="col-lg-2 col-md-6 mb-3">
                                            <div class="input-group product_row_amount_group">
                                                <span
                                                    class="input-group-text">{{ $item->discount_type == 'percentage' ? '%' : ($item->discount_type == 'flat' ? "$" : ' ') }}</span>
                                                <input type="text" name="discount_amount[]"
                                                    class="form-control number-format"
                                                    value="{{ $item->discount_amount ?? 0 }}" maxlength="5" max="999"
                                                    aria-label="Amount (to the nearest dollar)"
                                                    oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                                                    {{ $item->discount_type === 'free_shipping' ? 'disabled=""' : '' }}
                                                    {{ empty($item->discount_type) ? 'style="text-indent: -1000px;"' : '' }}>
                                            </div>
                                        </div>
                                        <div class="col-lg-2 col-md-6 mb-3">
                                            <div class="input-group product_row_extra_amount_group">
                                                <span
                                                    class="input-group-text">{{ $item->discount_type == 'percentage' ? '%' : ($item->discount_type == 'flat' ? "$" : ' ') }}</span>
                                                <input type="text" name="extra_discount_amount[]"
                                                    class="form-control number-format"
                                                    value="{{ $item->extra_discount_amount ?? 0 }}" maxlength="5"
                                                    max="999" aria-label="Amount (to the nearest dollar)"
                                                    oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                                                    {{ $item->extra_discount_amount == 0 ? 'disabled=""' : '' }}
                                                    {{ $item->extra_discount_amount == 0 ? 'style="text-indent: -1000px;"' : '' }}>
                                            </div>
                                        </div>
                                        {{-- @if ($key > 0) --}}
                                        <div class="col-lg-1 col-md-6">
                                            <button type="button" data-id="{{ $promo->id ?? ' ' }}"
                                                data-extra-field-id="{{ $key ?? '' }}"
                                                class="btn remove-button btn-secondary pe-3 d-flex justify-content-center align-items-center"
                                                onclick="addProductRow(this)">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                                    <path
                                                        d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z">
                                                    </path>
                                                    <path fill-rule="evenodd"
                                                        d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z">
                                                    </path>
                                                </svg>
                                                <span class="ms-2">Remove</span>
                                            </button>
                                        </div>
                                        {{-- @endif --}}

                                    </div>
                                @endforeach

                            </div>
                        </div>


                        <div
                            class="col-md-12 mt-5 text-end mt-4 text-end d-flex align-items-center justify-content-between">
                            <button type="button" class="btn btn-primary pe-3 d-flex align-items-center me-2" id="add_row">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-plus" viewBox="0 0 16 16">
                                    <path
                                        d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z">
                                    </path>
                                </svg>
                                <span class="d-none d-md-block ">Add more</span>
                            </button>
                            <button type="submit" class="btn btn-primary">Update Promo</button>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </form>
@endsection

@section('scripts')

    <script>
        var golbal_product_id_store = [];
        const addProductRow = (elem) => {
            const row = $(elem).closest('.row');
            const prev_div = row.prev().find(".all-product-category").data('counter');
            const total_div = row.nextAll();

            $(".remove-button").prop('disabled', true);
            const remove_selected_value = row.find(".all-product-list").val();

            if (remove_selected_value.length > 0) {
                $.each(remove_selected_value, function(key, value) {
                    golbal_product_id_store = arrayRemove(golbal_product_id_store, value);
                });
            }
            var dataCount = prev_div == undefined ? -1 : prev_div;
            total_div.each(function(index, element) {
                // element == this
                dataCount++;
                $(element).find(".all-product-category").attr('name', 'dorp_down_subcategori_list_' +
                    dataCount + '[]');
                $(element).find(".all-product-category").attr('data-counter', dataCount);
                $(element).find(".all-product-list").attr('name', 'dorp_down_product_list_' + dataCount + '[]');

            });

            if (row.length) {
                removeExtraPomo(elem);
                // row.remove();
            }
        }

        function arrayRemove(arr, value) {
            return arr.filter(function(ele) {
                return ele != value;
            });
        }
        const setAmountPrefix = (selectfield) => {
            const value = $(selectfield).val();
            const row = $(selectfield).closest('.row');
            const amountColInput = $(row).find('.product_row_amount_group input');
            const extraAmountColInput = $(row).find('.product_row_extra_amount_group input');

            if (value === "percentage") {
                $(row).find('.input-group-text').text("%")
                $(amountColInput).css('text-indent', 'inherit').prop('disabled', false);
                $(extraAmountColInput).css('text-indent', 'inherit').prop('disabled', false);
            } else if (value === "flat") {
                $(row).find('.input-group-text').text("$")
                $(amountColInput).css('text-indent', 'inherit').prop('disabled', false);
                $(extraAmountColInput).css('text-indent', 'inherit').prop('disabled', true);
            } else if (value === "free_shipping") {
                $(row).find('.input-group-text').text("");
                $("input[name='value']").css('text-indent', '-1000px').prop('disabled', true);
                $(amountColInput).css('text-indent', '-1000px').prop('disabled', true);
                $(extraAmountColInput).css('text-indent', '-1000px').prop('disabled', true);
            } else {
                $(row).find('.input-group-text').text("");
                $(amountColInput).css('text-indent', '-1000px').prop('disabled', true);
                $(extraAmountColInput).css('text-indent', '-1000px').prop('disabled', true);
            }
        }
        $(document).ready(function() {
            const initSelect2 = () => {
                $('.all-product-list').select2({
                    placeholder: "Select products",
                });
                $('.all-product-category').select2({
                    placeholder: "Select product category",
                });
            }
            initSelect2();
        })
        jQuery(function($) {
            $(".sortable").sortable({
                stop: function(event, ui) {
                    var data = $(this).sortable('serialize');
                    $.ajax({
                        data: {
                            "data": data,
                            "where": "id",
                            "t": "sliders",
                        },
                        type: 'POST',
                        url: '{{ route('global.sort') }}'

                    });
                }
            });
        })

        function isNumber(o) {
            return !isNaN(o - 0);
        }

        $(document).on('keyup', "#amountField", function(e) {
            let txtVal = $(this).val();
            if (isNumber(txtVal) && txtVal.length > 3) {
                $(this).val(txtVal.substring(0, 3))
            }
        });
        jQuery(function($) {
            if ($("#type").val() === "") {
                $(".input-group-text-amount").text("");
                $("input[name='amount']").css('text-indent', '-1000px').prop('disabled', true);
                $("input[name='extra_amount']").css('text-indent', '-1000px').prop('disabled', true);
            }
            $(document).on('change', "#type", function() {
                let $this = $(this);
                if ($this.val() === "percentage") {
                    $(".input-group-text-amount").text("%")
                    $("input[name='amount']").css('text-indent', 'inherit').prop('disabled', false);
                    $("input[name='extra_amount']").css('text-indent', 'inherit').prop('disabled', false);
                } else if ($this.val() === "flat") {
                    $(".input-group-text-amount").text("$")
                    $("input[name='amount']").css('text-indent', 'inherit').prop('disabled', false);
                    $("input[name='extra_amount']").css('text-indent', '-1000px').prop('disabled', true);
                } else if ($this.val() === "free_shipping") {
                    $(".input-group-text-amount").text("");
                    $("input[name='amount']").css('text-indent', '-1000px').prop('disabled', true);
                    $("input[name='extra_amount']").css('text-indent', '-1000px').prop('disabled', true);
                } else {
                    $(".input-group-text-amount").text("");
                    $("input[name='amount']").css('text-indent', '-1000px').prop('disabled', true);
                    $("input[name='extra_amount']").css('text-indent', '-1000px').prop('disabled', true);
                }
            })
        })

        function isNumber(o) {
            return !isNaN(o - 0);
        }

        function typeOfCoupon(value) {
            if (value === "percentage") {
                $(".input-group-text-amount").text("%")
                $("input[name='amount']").css('text-indent', 'inherit').prop('disabled', false);
                $("input[name='extra_amount']").css('text-indent', 'inherit').prop('disabled', false);
            } else if (value === "flat") {
                $(".input-group-text-amount").text("$")
                $("input[name='amount']").css('text-indent', 'inherit').prop('disabled', false);
                $("input[name='extra_amount']").css('text-indent', 'inherit').prop('disabled', true);
            } else if (value === "free_shipping") {
                $(".input-group-text-amount").text("");
                $("input[name='value']").css('text-indent', '-1000px').prop('disabled', true);
            } else {
                $(".input-group-text-amount").text("");
                $("input[name='amount']").css('text-indent', '-1000px').prop('disabled', true);
                $("input[name='extra_amount']").css('text-indent', '-1000px').prop('disabled', true);
            }
        }
        $(document).ready(function() {
            const initSelect2 = () => {
                $('.all-product-list').select2({
                    placeholder: "Select products",
                });
                $('.all-product-category').select2({
                    placeholder: "Select product category",
                });
            }
            initSelect2();
            var value = $('#type').val();
            if (value) {
                typeOfCoupon(value);
            }

            var count = 0;
            $('#add_row').on('click', function() {
                const row_count = $('#product-specific-discount-row').find('.all-product-category:last')
                    .data('counter');

                count = row_count == undefined ? -1 : row_count;
                count++;

                const html = `<div class="row">
                    <div class="col-lg-2 col-md-3 mb-3">
                        <div class="form-floating">
                            <select class="form-select form-control all-product-category"  name="dorp_down_subcategori_list_${count}[]" data-counter="${count}" required multiple>
                                <option value="">Select Product Category</option>
                                @foreach ($subCategories as $sub_cat)
                                    <option value="{{ $sub_cat->id }}">{{ $sub_cat->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-6 mb-3">
                        <div class="form-floating">
                            <select class="form-select form-control all-product-list" name="dorp_down_product_list_${count}[]" disabled required multiple>
                                <option value="">Select Products</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-6 mb-3">
                        <div class="form-floating">
                            <select name="discount_type[]" class="form-select form_discount_type_select" required onchange="setAmountPrefix(this)">
                                <option value="">Select Type</option>
                                <option value="percentage">Percentage</option>
                                <option value="flat">Fixed Amount</option>

                            </select>
                            <label >Promo Type <span class="text-primary">*</span></label>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-6 mb-3">
                        <div class="input-group product_row_amount_group">
                            <span class="input-group-text"></span>
                            <input type="text" name="discount_amount[]" class="form-control number-format" value="" maxlength="5" max="999" aria-label="Amount (to the nearest dollar)" disabled="" style="text-indent: -1000px;" oninput="this.value = this.value.replace(/[^0-9.]/g, '')">
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-6 mb-3">
                        <div class="input-group product_row_extra_amount_group">
                            <span class="input-group-text"></span>
                            <input type="text" name="extra_discount_amount[]" class="form-control number-format" value=""  maxlength="5" max="999" aria-label="Amount (to the nearest dollar)" disabled="" style="text-indent: -1000px;"  oninput="this.value = this.value.replace(/[^0-9.]/g, '')">
                        </div>
                    </div>
                    <div class="col-lg-1 col-md-6">
                        <button type="button" class="btn remove-button btn-secondary pe-3 d-flex justify-content-center align-items-center" onclick="addProductRow(this)">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"></path>
                                <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"></path>
                            </svg>
                            <span class="ms-2">Remove</span>
                        </button>
                    </div>
                    </div>`
                $('#product-specific-discount-row').append(html);
                initSelect2();

            })
        })
        $(document).on('keyup', "#amountField, .number-format", function(e) {
            let txtVal = $(this).val();
            if (isNumber(txtVal) && txtVal.length > 5) {
                $(this).val(txtVal.substring(0, 5))
            }
        });
        jQuery(function($) {
            if ($("#type").val() === "") {
                $(".input-group-text").text("");
                $("input[name='amount']").css('text-indent', '-1000px').prop('disabled', true);
                $("input[name='extra_amount']").css('text-indent', '-1000px').prop('disabled', true);
            }
            $(document).on('change', "#type", function(e) {
                e.preventDefault();
                let value = $(this).val();
                typeOfCoupon(value);
            })
        })
        $(document).on('change', ".all-product-category", function(e) {
            e.preventDefault();

            var product_id_match = [];
            const row = $(this).closest('.row');
            const prev_div = row.prevAll();

            prev_div.each(function(index, element) {
                golbal_product_id_store.push($(element).find(".all-product-list").val());
            });
            var product_id_store = [];
            for (var i = 0; i < golbal_product_id_store.length; i++) {
                product_id_store = product_id_store.concat(golbal_product_id_store[i]);
            }


            var disable_product_id = product_id_store.filter(function(elem, index, self) {
                return index === self.indexOf(elem);
            });

            var subcategory_id = $(this).val();

            const child_row = row.find('.all-product-list').prop('disabled', false);
            axios.post(`/admin/multiple-subcategory-product-info`, {
                'subcategory_id': subcategory_id,
            }).then((response) => {
                var products = response.data.products;
                $(child_row).html(
                    '<option value="">Select product</option>');

                var productDropdown = '';

                $.each(products, function(key, value) {

                    var disabled = '';
                    if (disable_product_id.includes(value.id.toString()) == true) {
                        disabled = ' disabled="disabled"';
                    }

                    productDropdown += '<option value="' + value.id + '" ' + disabled + '>' + value
                        .name + '</option>';
                });

                if (products.length == 0) {
                    child_row.prop('disabled', true).empty();
                } else {
                    $(child_row).html(
                        '<option value="all">Select all product</option>' + productDropdown);
                }
                // $(child_row).html(productDropdown);
            })

        });

        function removeExtraPomo(elem) {

            const row = $(elem).closest('.row');
            const prev_div = row.prev().find(".all-product-category").data('counter');

            const extra_field_id = $(elem).attr('data-extra-field-id');
            const promo_id = $(elem).attr('data-id');

            if (extra_field_id !== "" && extra_field_id !== undefined) {

                axios.post(`/admin/promo/extra-field-remove`, {
                        promo_id: promo_id,
                        extra_field_id: extra_field_id
                    })
                    .then(function(response) {
                        toastr.error('Removed!');
                        row.remove();
                        $(".remove-button").prop('disabled', false);

                    }).catch(function(error) {
                        console.log(error)
                        let errors = error.response.data.errors;
                        $.each(errors, function(key, value) {
                            toastr.error(value)
                        })
                    });
            } else {
                row.remove();
                $(".remove-button").prop('disabled', false);
            }
        }

        $(document).on("select2:select", '.all-product-list', function(e) {
            var data = e.params.data.id;
            var product_list = $(this).children('option');
            if (data == 'all') {
                $.each(product_list, function(key, element) {
                    if ($(element).val() == 'all') {
                        $(element).prop("selected", "");
                    } else {
                        if ($(element).attr("disabled") == "disabled") {
                            // alert('work');
                        } else {
                            $(element).prop("selected", "selected");
                        }

                    }
                });

                $(product_list).trigger("change");
            }
        });
    </script>
@endsection
