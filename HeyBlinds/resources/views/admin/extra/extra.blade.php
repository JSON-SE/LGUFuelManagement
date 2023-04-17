@extends('layouts.Backend.admin.admin')
@section('content')

    <section id="body-content" class="">
        <div class="container-fluid px-lg-5 px-md-4 pb-5 pt-lg-3">
            <div class="row pt-4">
                <div class="col-12">
                    <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='white'/%3E%3C/svg%3E&#34;);"
                        aria-label="breadcrumb">
                        <ol class="breadcrumb mb-2">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Add Extra price</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <div class="row pb-4">
                <div class="col-sm-6 text-white my-auto">
                    <h3 class="mb-0">Extra price</h3>
                </div>
            </div>

            <div class="bg-white rounded page-height mt-3 shadow">
                @include('partial.message')
                <div class="p-4 pb-5">
                    <ul class="nav nav-tabs product-management-tab __tabslide" id="myTab" role="tablist">

                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="Shipping-tab" data-bs-toggle="tab"
                                data-bs-target="#Shipping" type="button" role="tab" aria-controls="Shipping"
                                aria-selected="true">Shipping</button>
                        </li>

                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="Handling-tab" data-bs-toggle="tab" data-bs-target="#Handling"
                                type="button" role="tab" aria-controls="Handling" aria-selected="false">Handling</button>
                        </li>

                    </ul>

                    <div class="tab-content" id="myTabContent">

                        <div class="tab-pane fade show active" id="Shipping" role="tabpanel" aria-labelledby="Shipping-tab">
                            <div class="pt-2">
                                <form action="{{url('/admin/extra-setting-shipping-price')}}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('post')
                                    {{-- <input type="hidden" name="shipping_price_id" value="{{$shipping_price->id ?? ''}}"> --}}
                                    <div class="col-12"  id="option-price-Shipping">
                                        @if($shipping_price->count() > 0)
                                            @foreach ($shipping_price as $key => $shipping)
                                                <div class="row option-Shipping">
                                                
                                                    <div class="col-lg-3 col-md-3">
                                                        <div class="form-floating mt-3">
                                                            <input type="text" class="form-control shipping_min_width" name="min_width[]" id="min_width"
                                                                value="{{ $shipping->min_width??'' }}" placeholder="Minimum width"
                                                                autocomplete="off"  oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"  required>
                                                            <label for="min_width">Minimum width <span
                                                                    class="text-primary"></span></label>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3 col-md-3">
                                                        <div class="form-floating mt-3">
                                                            <input type="text" class="form-control shipping_max_width" name="max_width[]" id="min_width"
                                                                value="{{ $shipping->max_width??'' }}" placeholder="Maximum width"
                                                                autocomplete="off"  oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" required>
                                                            <label for="min_width">Maximum width <span
                                                                    class="text-primary"></span></label>
                                                        </div>
                                                    </div>
                                                
                                                    <div class="col-lg-3 col-md-3">
                                                        <div class="form-floating mt-3">
                                                            <input type="text" class="form-control shipping_amount" required name="amount[]" id="amount"
                                                                value="{{ $shipping->amount?? '' }}" placeholder="Amount">
                                                            <label for="amount">Amount<span class="text-primary">*</span></label>
                                                        </div>
                                                    </div>

                                            

                                                    @if($key == 0)
                                                    <div class="col-lg-3 col-md-6 mt-3">
                                                        {{-- <button type="submit" class="btn btn-primary">Update</button> --}}
                                                        <a href="javascript:void(0)"
                                                            class="btn btn-primary btn-sm pe-3 h-100 add-option-Shipping ms-auto">
                                                            <span class="d-flex h-100 align-items-center">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                                    fill="currentColor" class="bi bi-plus" viewBox="0 0 16 16">
                                                                    <path
                                                                        d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z">
                                                                    </path>
                                                                </svg>
                                                                <span class="d-none d-md-block">Add more</span>
                                                            </span>
                                                        </a>
                                                    </div>
                                                    @else
                                                    <div class="col-lg-3 col-md-6 mt-3">
                                                        {{-- <button type="submit" class="btn btn-primary">Update</button> --}}
                                                        <a href="javascript:void(0)"
                                                        class="btn btn-secondary btn-sm pe-3 h-100 remove-shipping-price ms-auto">
                                                            <span class="d-flex h-100 align-items-center">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-dash" viewBox="0 0 16 16">
                                                                        <path d="M4 8a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7A.5.5 0 0 1 4 8z"/>
                                                                        </svg>
                                                                <span class="d-none d-md-block">Remove</span>
                                                            </span>
                                                        </a>
                                                    </div>
                                                    @endif
                                                </div>
                                            @endforeach
                                        @else
                                            <div class="row option-Shipping">
                                                <div class="col-lg-3 col-md-3">
                                                    <div class="form-floating mt-3">
                                                        <input type="text" class="form-control shipping_min_width" name="min_width[]" id="min_width"
                                                            value="" placeholder="Minimum width"
                                                            autocomplete="off"  oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" required>
                                                        <label for="min_width">Minimum width <span
                                                                class="text-primary"></span></label>
                                                    </div>
                                                </div>
                                                
                                                <div class="col-lg-3 col-md-3">
                                                    <div class="form-floating mt-3">
                                                        <input type="text" class="form-control shipping_max_width" name="max_width[]" id="min_width"
                                                            value="" placeholder="Maximum width"
                                                            autocomplete="off"  oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"  required>
                                                        <label for="min_width">Maximum width <span
                                                                class="text-primary"></span></label>
                                                    </div>
                                                </div>
                                                
                                            
                                                <div class="col-lg-3 col-md-3">
                                                    <div class="form-floating mt-3">
                                                        <input type="text" class="form-control amount" required name="amount[]" id="amount"
                                                            value="" placeholder="Amount"  oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                                                        <label for="amount">Amount<span class="text-primary">*</span></label>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3 col-md-3 mt-3">
                                                    {{-- <button type="submit" class="btn btn-primary">Update</button> --}}
                                                    <a href="javascript:void(0)"
                                                        class="btn btn-primary btn-sm pe-3 h-100 add-option-Shipping ms-auto">
                                                        <span class="d-flex h-100 align-items-center">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                                fill="currentColor" class="bi bi-plus" viewBox="0 0 16 16">
                                                                <path
                                                                    d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z">
                                                                </path>
                                                            </svg>
                                                            <span class="d-none d-md-block">Add more</span>
                                                        </span>
                                                    </a>
                                                </div>
                                            </div>
                                        
                                        @endif
                                    </div>
                                    <div class="col-lg-12 col-md-6 mt-3">
                                        <button type="submit" class="btn btn-primary">Update</button>
                                    </div>

                                </form>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="Handling" role="tabpanel" aria-labelledby="Handling-tab">
                           
                            <div class="pt-2">
                                <form action="{{url('/admin/extra-setting-handling-price')}}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('post')
                                   
                                    <div class="row align-items-end">
                                        
                                        <div class="col-12" id="option-price-Handling">
                                            @if($handlingPrice->count() > 0)
                                            @foreach ($handlingPrice as $key => $handling)
                                            <div class="row gx-2 option-price pb-3 option-Handling">
                                                <div class="col-md-3">
                                                    <div class="form-floating">
                                                        <input type="text" class="form-control min_range" id="min_range" value="{{$handling->min_range}}"
                                                               placeholder="Width" name="min_range[]" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                                                        <label for="">Min Range</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-floating">
                                                        <input type="text" class="form-control range"
                                                               placeholder="Width" name="max_range[]" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"  value="{{$handling->max_range}}" required>
                                                        <label for="">Max Range</label>
                                                    </div>
                                                </div>
                                                
                                                <div class="col-md-3">
                                                    <div class="form-floating">
                                                        <input type="text" class="form-control" id="" value="{{$handling->amount}}"
                                                               placeholder="Price" name="price[]" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"  required>
                                                        <label for="">Price</label>
                                                    </div>
                                                </div>
                                                @if($key == 0)
                                                <div class="col-md-3">
                                                    <a href="javascript:void(0)"
                                                       class="btn btn-primary btn-sm pe-3 h-100 add-option-Handling ms-auto">
                                                       <span class="d-flex h-100 align-items-center">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                                fill="currentColor" class="bi bi-plus" viewBox="0 0 16 16">
                                                                <path
                                                                    d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z">
                                                                </path>
                                                            </svg>
                                                            <span class="d-none d-md-block">Add more</span>
                                                        </span>
                                                    </a>
                                                   
                                                </div>
                                                @else
                                                <div class="col-md-3">
                                                    <a href="javascript:void(0)"
                                                       class="btn btn-secondary btn-sm pe-3 h-100 remove-option-price ms-auto">
                                                       <span class="d-flex h-100 align-items-center">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-dash" viewBox="0 0 16 16">
                                                            <path d="M4 8a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7A.5.5 0 0 1 4 8z"/>
                                                          </svg>
                                                            <span class="d-none d-md-block">Remove</span>
                                                        </span>
                                                    </a>
                                                   
                                                </div>
                                                @endif
                                            </div>
                                            @endforeach
                                            @else
                                              <div class="row gx-2 option-price pb-3 option-Handling">
                                                <div class="col-md-3">
                                                    <div class="form-floating">
                                                        <input type="text" class="form-control min_range" 
                                                               placeholder="Width" name="min_range[]" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                                                        <label for="">Min Range</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-floating">
                                                        <input type="text" class="form-control range"
                                                               placeholder="Width" name="max_range[]" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"   required>
                                                        <label for="">Max Range</label>
                                                    </div>
                                                </div>
                                                
                                                <div class="col-md-3">
                                                    <div class="form-floating">
                                                        <input type="text" class="form-control" id="" 
                                                               placeholder="Price" name="price[]" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"  required>
                                                        <label for="">Price</label>
                                                    </div>
                                                </div>
                                               
                                                <div class="col-md-3">
                                                    <a href="javascript:void(0)"
                                                       class="btn btn-primary btn-sm pe-3 h-100 add-option-Handling ms-auto">
                                                       <span class="d-flex h-100 align-items-center">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                                fill="currentColor" class="bi bi-plus" viewBox="0 0 16 16">
                                                                <path
                                                                    d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z">
                                                                </path>
                                                            </svg>
                                                            <span class="d-none d-md-block">Add more</span>
                                                        </span>
                                                    </a>
                                                </div>
                                            </div>
                                            @endif
                                        </div>
                                        
                                        {{-- <div id="option-price-Handling" class="col-12">
                                        </div> --}}

                                        <div class="col-lg-12 col-md-6 mt-3">
                                            <button type="submit" class="btn btn-primary">Update</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
</section>

    @push('js')
        <script type="text/javascript">

        $(document).ready(function (){

            $(document).on('click', '.__tabslide li .nav-link', function(e) {
                e.preventDefault();
                var newurl = window.location.protocol + "//" + window.location.host + window.location.pathname + '?tab=' + this.id;
                window.history.pushState({ path: newurl }, '', newurl);
            });

            $(window).on('load', function() {
                var queryString = window.location.search;
                var urlParams = new URLSearchParams(queryString);

                var id = urlParams.get('tab')
             
                if(urlParams.has('tab')== true){
                    // $('.product-management-tab ')
                    $('.tab-content .tab-pane').removeClass('active show');
                    $('.__tabslide li button').removeClass('active');
                    $(".tab-content").find("[aria-labelledby="+id+"]").addClass('active show');
                    $('.__tabslide li').find('#'+id).addClass('active');
                    console.log(id);
                }
            });

            $(document).on("click", ".add-option-Handling", function () {
                $("#option-price-Handling").append(html())
            });
         

            $(document).on('click', '.remove-option-price', function(){
                $(this).parents('.option-Handling').remove();
            });

            function html() {
                    return `<div class="row gx-2 option-price pb-3 option-Handling">
                            <div class="col-md-3">
                                <div class="form-floating">
                                    <input type="text" class="form-control min_range" value=""
                                           placeholder="Width" name="min_range[]" oninput="this.value = this.value.replace(/[^0-9.]/g, '')"  required>
                                    <label for="">Min Range</label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-floating">
                                    <input type="text" class="form-control range" 
                                           placeholder="Width" name="max_range[]" oninput="this.value = this.value.replace(/[^0-9.]/g, '')"  required>
                                    <label for="">Max Range</label>
                                </div>
                            </div>
                            
                            <div class="col-md-3">
                                <div class="form-floating">
                                    <input type="text" class="form-control"
                                           placeholder="Price" name="price[]" oninput="this.value = this.value.replace(/[^0-9.]/g, '')" required>
                                    <label for="">Price</label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <a href="javascript:void(0)"
                                   class="btn btn-secondary btn-sm pe-3 h-100 remove-option-price ms-auto">
                                    <span class="d-flex h-100 align-items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-dash" viewBox="0 0 16 16">
                                                <path d="M4 8a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7A.5.5 0 0 1 4 8z"/>
                                                </svg>
                                        <span class="d-none d-md-block">Remove</span>
                                    </span>
                                </a>
                            </div>
                        </div>`;
        }
          $(document).on('change','.range', function() {
                const optionRow = $(this).closest('.option-Handling');
                const optionMinValue = optionRow.find('.min_range').val();
                const optionMaxValue = $(this).val();
                const optionMinValueNum = parseInt(optionMinValue);
                const optionMaxValueNum = parseInt(optionMaxValue);
                if (optionMaxValueNum < optionMinValueNum  ) {
                    alert("Max range is grater than min rage");
                    $(this).val('');
                    $(this).focus();
                }
            })

            $(document).on('change','.min_range', function() {
                const optionRow = $(this).closest('.option-Handling');
                const previousRowMaxField = optionRow.prev().find('.range');
                const previousRowMaxFieldValue = previousRowMaxField.length > 0 ? parseFloat(previousRowMaxField.val()) : 0;
                const currentMinFieldValue = parseFloat($(this).val());

                const optionMaxValue = optionRow.find('.range').val();
                const optionMaxValueNum = parseFloat(optionMaxValue);

                if(currentMinFieldValue!==NaN && currentMinFieldValue <= previousRowMaxFieldValue){
                    alert(`Min range value has to be greater than last max range value i.e. ${previousRowMaxFieldValue}`);
                    $(this).val('');
                    $(this).focus();
                    return
                } else if(currentMinFieldValue > optionMaxValueNum){
                    alert(`Min range value cann't be greater than max range value`);
                    $(this).val('');
                    $(this).focus();
                    return
                }

            })


            // Shipping charge add more option
            $(document).on("click", ".add-option-Shipping", function () {
                $("#option-price-Shipping").append(shipping_html())
                // alert();
            });

            function shipping_html(){
                return `<div class="row option-Shipping">
                                            <div class="col-lg-3 col-md-3">
                                                <div class="form-floating mt-3">
                                                    <input type="text" class="form-control shipping_min_width" name="min_width[]" 
                                                        placeholder="Minimum width" oninput="this.value = this.value.replace(/[^0-9.]/g, '')"
                                                        autocomplete="off"    required>
                                                    <label for="min_width">Minimum width <span
                                                            class="text-primary"></span></label>
                                                </div>
                                            </div>
                                            <div class="col-lg-3 col-md-3">
                                                <div class="form-floating mt-3">
                                                    <input type="text" class="form-control shipping_max_width" name="max_width[]" 
                                                        value="" placeholder="Maximum width"
                                                        autocomplete="off"    required>
                                                    <label for="max_width">Maximum width <span
                                                            class="text-primary"></span></label>
                                                </div>
                                            </div>
                                        
                                            <div class="col-lg-3 col-md-3">
                                                <div class="form-floating mt-3">
                                                    <input type="text" class="form-control shipping_amount" required name="amount[]" id="amount"
                                                        value="" placeholder="Amount" oninput="this.value = this.value.replace(/[^0-9.]/g, '')" >
                                                    <label for="amount">Amount<span class="text-primary">*</span></label>
                                                </div>
                                            </div>

                                            <div class="col-lg-3 col-md-6 mt-3">
                                                {{-- <button type="submit" class="btn btn-primary">Update</button> --}}
                                                <a href="javascript:void(0)"
                                                class="btn btn-secondary btn-sm pe-3 h-100 remove-shipping-price ms-auto">
                                                    <span class="d-flex h-100 align-items-center">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-dash" viewBox="0 0 16 16">
                                                                <path d="M4 8a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7A.5.5 0 0 1 4 8z"/>
                                                                </svg>
                                                        <span class="d-none d-md-block">Remove</span>
                                                    </span>
                                                </a>
                                            </div>
                                        </div>`;
            }

            $(document).on('click', '.remove-shipping-price', function(){
                $(this).parents('.option-Shipping').remove();
            });

            $(document).on('change','.shipping_max_width', function() {
               
                const optionRow = $(this).closest('.option-Shipping');
                
                const optionMinValue = optionRow.find('.shipping_min_width').val();
                const optionMaxValue = $(this).val();
                const optionMinValueNum = parseFloat(optionMinValue);
                const optionMaxValueNum = parseFloat(optionMaxValue);
                if (optionMaxValueNum <= optionMinValueNum  ) {
                   // console.log(optionMaxValueNum)
                    alert("Max range is grater than min rageaa");
                    $(this).val('');
                    $(this).focus();
                }
            })

            $(document).on('change','.shipping_min_width', function(){
                const optionRow = $(this).closest('.option-Shipping');
                const previousRowMaxField = optionRow.prev().find('.shipping_max_width');
                const previousRowMaxFieldValue = previousRowMaxField.length > 0 ? parseFloat(previousRowMaxField.val()) : 0;
                const currentMinFieldValue = parseFloat($(this).val());
                const optionMaxValue = optionRow.find('.shipping_max_width').val();
                const optionMaxValueNum = parseFloat(optionMaxValue);
                if(currentMinFieldValue!==NaN && currentMinFieldValue <= previousRowMaxFieldValue){
                    alert(`Min amount value has to be greater than last amount value i.e. ${previousRowMaxFieldValue}`);
                    $(this).val('');
                    $(this).focus();
                    return
                } else if(currentMinFieldValue > optionMaxValueNum){
                    alert(`Min amount value cann't be greater than max amount value`);
                    $(this).val('');
                    $(this).focus();
                    return
                }
            });


        });
        </script>


    @endpush
@endsection
