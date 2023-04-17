@extends('layouts.Backend.admin.admin')
@section('content')
<style>
    .customDisabled {
        pointer-events:none;
    }
    .customEnable {
        pointer-events:all;
    }
    .entrySave{
        display:none;
    }
    .input-color{
        color:#2100a1;
    }
    .activeColor{
        color:#000;
    }
</style>

<section id="body-content" class="">
    <div class="container-fluid px-lg-5 px-md-4 pb-5 pt-lg-3">
        <div class="row pt-4">
            <div class="col-12">
                <nav  aria-label="breadcrumb">
                    <ol class="breadcrumb mb-2">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">
                            Order details
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="row pb-4">
            <div class="col-sm-6 text-white my-auto">
                <h3 class="mb-0">Order Details ({{ $order->order_id }})</h3>
            </div>

            <div class="col-sm-6 pt-3 pt-lg-0 my-auto d-flex justify-content-sm-end">

                <a href="{{ url('admin/order-export') }}"  class="btn btn-primary d-flex align-items-center ms-2">
                    <span class="d-none d-md-block">Export</span>

                </a>
                 <a href="{{route('frontend.checkout', $cart->external_id.'#review')}}" target="_blank" class="btn btn-primary d-flex align-items-center ms-2">
                    <span class="d-none d-md-block">View Order </span>
                </a>

                <a href="{{ route('admin.order.index') }}" class="btn btn-primary d-flex align-items-center ms-2">

                    <span class="d-none d-md-block">View All Orders</span>
                </a>
            </div>
        </div>

        <div class="bg-white rounded page-height mt-3 shadow p-4">
            <div
                class="bg-primary p-2 rounded mb-3 text-white d-flex flex-wrap align-items-center justify-content-between">
                <p class="mb-0">
                    Order status: {{ $status }}  {{date("Y-m-d h.i A",strtotime($order->updated_at))}}
                   
                </p>
                <p class="mb-0">Order ID: {{ $order->order_id }}</p>
            </div>

            <div class="row">
                <div class="col-md-4 mb-3">
                    <h5>Shipping information</h5>
                    @include('admin.order.shipping')
                </div>

                <div class="col-md-4 mb-3">
                    <h5>Billing information</h5>
                 @include('admin.order.billing')
                </div>

                <div class="col-md-4 mb-3">
                    <ul class="payment-history">
                        <li>
                            <p class="mb-2 me-3">Subtotal</p>
                            <p class="mb-2">$<span id="subtotal{{$order->id}}">{{number_format($cart->cart_total_price,2)}}</span></p>
                        </li>
                        <li>
                            <p class="mb-2 me-3">Sale Discount</p>
                            <p class="mb-2">-$<span id="discount">{{number_format($totalSave,2)}}</span></p>
                        </li>
                        @if (!empty($order->cart->coupon) && !empty($order->cart->discount))
                        <li>
                            <p class="mb-2 me-3">Coupon Discount <b>({{$order->cart->coupon}})</b></p>
                            <p class="mb-2">-${{ $helpers->withoutRounding($cart->cart_item_discount, 2) }} </p>
                        </li>
                        @endif
                        <li>
                            <p class="mb-0 me-3">Tax</p>
                            <p class="mb-0">+${{$helpers->taxCalculation($order->cart_id)}}</p>
                        </li>
                        <li>
                            <p class="mb-0 me-3">Shipping</p>
                            <p class="mb-0">+${{number_format($cart->shipping_extra_amount,2) ?? 0.00}}</p>
                        </li>
                        <li>
                            <p class="mb-0 me-3">Handling</p>
                            <p class="mb-0">+${{number_format($cart->handling_extra_amount,2)?? 0.00}}</p>
                        </li>
                    </ul>
                    <ul class="payment-history mb-0">
                        <li>
                            <p class="mb-2 me-3 fw-bold">Your Price:</p>
                            <p class="mb-2">$<span id="your_price">{{ $helpers->grand_total_amount($cart->id) }}</span></p>
                         {{--   <p class="mb-2">$<span id="your_price">{{ $helpers->withoutRounding($totalAmount,2) }}</span></p> --}}
                        </li>
                    </ul>

                    <div>
                        <h5 class="mt-3">Order Status:</h5>
                      {{--   <p class=" mt-2 text-danger">Caution--any change in status will fire an email.</p> --}}
                        <div class="check-box d-inline-block mb-2">
                            <input type="checkbox" id="email_status" name="email_status">
                            <label for="email_status">Send Email</label>
                        </div>
                         {{-- <input type="checkbox" name="email_status" id="email_status" checked> --}}
                        <select class="form-select" aria-label="Default select example" id="order_status">
                            @foreach($orderStatus as $status)
                            <option value="{{ $status->id }}" {{ $order->order_status == $status->id ? 'selected' : ''}} >{{ $status->name }}</option>
                            @endforeach
                        </select>

                        <input type="hidden" name="current" id="current" value="{{ $order->order_status }}" />
                    </div>
                </div>
            </div>
            <div class="row pt-2">
                <form>
                    <div class="row">
                        <div class="col-sm-6 mb-3">
                            <h5>Customer note</h5>
                            <div class="shadow-sm p-3 mb-3 rounded customer_note_list">
                                <h6 class="text-secondary">{{ $order->customer->customer_first_name ?? '' }}</h6>
                                <hr class="my-2" />
                                @foreach ($order->notes->where('receiver','customer') as $cnote )
                                <p class="txt__sm mb-0">
                                    {{ $cnote->note }}
                                </p>
                                <small>
                                    {{ $cnote->created_at->diffForHumans() }}
                                </small>
                                <hr>
                                @endforeach
                            </div>

                            <form method="post" action="">
                                <textarea class="form-control mb-3" rows="5" name="customer_note" id="customer_note"
                                    placeholder="Message"></textarea>
                                <input type="hidden" name="corder_id" id="corder_id" value="{{$order->id}}">
                                <select class="btn btn-primary" name="customer" id="customer">
                                    <option value="customer">Select Action</option>
                                    <option value="customer">Send to Customer</option>
                                    <option value="internally">Save it Internally</option>
                                </select>
                            </form>
                        </div>
                        <div class="col-sm-6 mb-3">
                            <h5>Vendor note</h5>
                            <div class="shadow-sm p-3 mb-3 rounded vendor_note_list">
                                <h6 class="text-secondary">{{ @$order->customer->customer_first_name }} NC</h6>
                                <hr class="my-2" />
                                @foreach ($order->notes->where('receiver','vendor') as $cnote )
                                <p class="txt__sm mb-0">
                                    {{ $cnote->note }}
                                </p>
                                <small>
                                    {{ $cnote->created_at->diffForHumans() }}
                                </small>
                                <hr>
                                @endforeach
                            </div>
                            <form method="post" action="">
                                <textarea class="form-control mb-3" rows="5" name="vendor_note" id="vendor_note"
                                    placeholder="Message"></textarea>
                                <input type="hidden" name="vorder_id" id="vorder_id" value="{{$order->id}}">
                                <select class="btn btn-primary" name="vendor" id="vendor">
                                    <option value="">Select Action</option>
                                    <option value="vendor">Send to Vendor</option>
                                    <option value="internally">Save it Internally</option>
                                </select>
                            </form>
                        </div>
                    </div>
                </form>
            </div>
            <div class="row pt-4 align-items-center">
                <div class="col-sm-4 mb-3">
                    <h5 class="mb-0 d-flex"><p id="line_items">{{ count($order->orderEntries)}}</p><p class="mx-1">LINE ITEMS</p></h5>
                </div>
                {{-- <div class="col-sm-8 mb-3">
                    <div class="d-flex align-items-center flex-wrap justify-content-sm-end line-items-btn">

                        <button type="button" class="btn btn-secondary me-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="me-1" width="14" height="14"
                                fill="currentColor" viewBox="0 0 16 16">
                                <path
                                    d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z" />
                            </svg>
                            <small>Add item</small>
                        </button>
                    </div>
                </div> --}}
            </div>

            @foreach ($order->orderEntries as $item)
                <form method="post" action="{{ url('admin/update-order-entry')}}" id="form{{ $item->id }}">
                    <div class="bg-ex-light rounded mb-3 p-3" id="entry_id{{$item->id}}">

                        <h5>
                            {{ $item->product->name }}
                        </h5>
                        <hr />
                        <div class="row">

                            <div class="col-lg-8">
                                <div class="row">

                                    @php

                                        $allOptions = $item->item($item->option_value);
                                        $canEdit = "editOptions";
                                        $disable = "customDisabledd";
                                        $days = $order->created_at->diffInDays(now());
                                        if( $days >= 1 ){
                                            $canEdit ="";
                                            $disable = "customDisabled";
                                        }

                                    @endphp
                                    @foreach($item->item($item->option_value) as $key => $allItem)

                                        <input type="hidden" name="id" value="{{ $item->id}}">
                                        @if($key !== "total_price" && $key !== "cart_id"  && $key !== "unit_price"  && $key !== "option_width_fraction" && $key !== "option_height_fraction" && $key!== "measurement_price")
                                            <div class="col-sm-6 entryItems{{$item->id}}  customDisabled">

                                                @if($key === "option_color")
                                                    <p class="mb-1 d-flex align-items-center"><b class="w-50 fw-semibold">Colour:</b>
                                                    <select class="form-select form-select-sm bg-transparent input-color w-50  activeColor input{{$item->id}} "  data-id="{{ $item->id }}"  data-key="{{ $key }}" name="{{ $key }}">
                                                 
                                                            @foreach ($item->product->colors as $color)
                                                            <option value="{{ $color->id }}" {{$color->id == $allItem['option_color'] ? 'selected' : ''}}>{{ $color->color->name}}</option>
                                                            @endforeach
                                                    </select>
                                                     <p class="mb-1 d-flex align-items-center"><b class="w-50 fw-semibold">Vendor Colour:</b>
                                                        
                                                         <input type="text" class="form-control w-50 form-control-sm bg-transparent input-color {{ $canEdit }}  activeColor input{{$item->id}}"  data-id="{{ $item->id }}" data-key="{{ $key }}"  value="{{ $helpers->vendorColorName($allItem['option_color']) }}" readonly/>
                                                     </p>

                                                @elseif($key === "option_width")
                                                    <div class="mb-1 d-flex align-items-center"><b class="w-50 fw-semibold">Width <small>(Inches)</small>:</b>

                                                    <span calss="row gx-2 w-50">
                                                        <span class="col-auto">

                                                    <select class="form-select form-select-sm bg-transparent input-color {{ $canEdit }}   activeColor  input{{$item->id}}" style="width:75px"  data-id="{{ $item->id }}"  data-key="{{ $key }}" name="{{ $key }}">
                                                        @for ($i = 12; $i <= 130; $i++ )
                                                        <option value="{{ $i }}" {{$allItem['option_width'] == $i ? 'selected' : ''}}>{{ $i}} </option>
                                                        @endfor
                                                    </select>
                                                </span>

                                                    <span class="col-auto">

                                                    <select class="form-select form-select-sm bg-transparent input-color {{ $canEdit }}   activeColor input{{$item->id}}"  style="width:100px" data-id="{{ $item->id }}"  data-key="option_width_fraction" name="option_width_fraction">

                                                        {{-- @if (!empty($allOptions['option_width_fraction'])) --}}
                                                        <option {{ trim($allOptions['option_width_fraction']['option_width_fraction'] ?? '') == "0/0" ? 'selected' : ' '}}  value="0/0">0/0</option>
                                                        <option {{ trim($allOptions['option_width_fraction']['option_width_fraction']?? '') == "1/2" ? 'selected' : ' ' }} value="1/2">1/2</option>
                                                        <option {{ trim($allOptions['option_width_fraction']['option_width_fraction'] ?? '') == "1/4" ? 'selected' : ' '}} value="1/4">1/4</option>
                                                        <option {{ trim($allOptions['option_width_fraction']['option_width_fraction'] ?? '') == "1/8" ?'selected' : ' '}} value="1/8">1/8</option>
                                                        <option {{ trim($allOptions['option_width_fraction']['option_width_fraction'] ?? '') == "3/4" ? 'selected' : ' '}} value="3/4">3/4 </option>
                                                        <option {{ trim($allOptions['option_width_fraction']['option_width_fraction'] ?? '') == "3/8" ? 'selected' : ' '}} value="3/8">3/8</option>
                                                        <option {{  trim($allOptions['option_width_fraction']['option_width_fraction'] ?? '') == "5/8" ? 'selected' : ' ' }} value="5/8">5/8</option>
                                                        <option {{  trim($allOptions['option_width_fraction']['option_width_fraction'] ?? '') == "7/8" ? 'selected' : ' '}} value="7/8">7/8 </option>
                                                     
                                                    </select>
                                                </span>
                                                    </span>
                                                </div>

                                                @elseif($key === "option_height")
                                                    <p class="mb-1 d-flex align-items-center"><b class="w-50 fw-semibold">Height <small>(Inches)</small>:</b>
                                                        <small calss="d-flex">
                                                        <select class="form-select form-select-sm bg-transparent input-color {{ $canEdit }}  activeColor input{{$item->id}}"  style="width:75px !important" data-id="{{ $item->id }}"  data-key="{{ $key }}" name="{{ $key }}">
                                                            @for ($i = 18; $i <= 150; $i++ )
                                                            <option value="{{ $i }}" {{ $allItem['option_height'] == $i ? 'selected' : '' }}>{{ $i}} </option>
                                                            @endfor
                                                        </select>

                                                        <select class="form-select form-select-sm bg-transparent input-color {{ $canEdit }}   activeColor input{{$item->id}}"  style="width:100px !important"   data-id="{{ $item->id }}"  data-key="option_height_fraction" name="option_height_fraction">
                                                            <option {{trim($allOptions['option_height_fraction']['option_height_fraction'] ?? '') == "0/0" ? 'selected' :' ' }} value="0/0">0/0</option>
                                                            <option {{trim($allOptions['option_height_fraction']['option_height_fraction'] ?? '') == "1/2" ? 'selected' :' ' }} value="1/2">1/2</option>
                                                            <option {{trim($allOptions['option_height_fraction']['option_height_fraction']?? '') == "1/4"? 'selected' : ' ' }} value="1/4">1/4</option>
                                                            <option {{trim($allOptions['option_height_fraction']['option_height_fraction']??'') == "1/8" ? 'selected' :' '}} value="1/8">1/8</option>
                                                            <option {{trim($allOptions['option_height_fraction']['option_height_fraction']??'') == "3/8" ? 'selected' : ' '}} value="3/8">3/8</option>
                                                            <option {{ trim($allOptions['option_height_fraction']['option_height_fraction']??'') == "3/4" ? 'selected': ''}} value="3/4"> 3/4 </option>
                                                            <option {{ trim($allOptions['option_height_fraction']['option_height_fraction']??'') == "5/8" ? 'selected': ' '}} value="5/8">5/8</option>
                                                            <option {{ trim($allOptions['option_height_fraction']['option_height_fraction']??'') == "7/8" ? 'selected' : ' '}} value="7/8">7/8 </option>
                                                        </select>

                                                    </small> 
                                                </p>
                                               
                                                @else
                                                    <p class="mb-1 d-flex align-items-center"><b class="w-50 fw-semibold">{{ucwords(str_replace(['option_', '_'],["", " "], $key))}}:</b>
                                                    <input type="text" class="form-control w-50 form-control-sm bg-transparent input-color {{ $canEdit }}  activeColor input{{$item->id}}"  data-id="{{ $item->id }}" data-key="{{ $key }}"  value="{{ $item->optionName($allItem[$key], $key) }}" readonly/>

                                                    <!--for value change -->
                                                    <input type="hidden" class="form-control w-50 form-control-sm bg-transparent input-color" value="{{ $allItem[$key]}}" name="{{ $key }}"/>
                                                    
                                                </p>
                                                @endif
                                            </div>
                                        @endif
                                    @endforeach

                                </div>
                            </div>


                            <div class="col-lg-3">
                                <ul class="payment-history txt__sm">
                                    <li>
                                        <p class="mb-2 me-3 fw-semibold ">Qty</p>
                                        {{-- <p class="mb-2">
                                            <input type="number" class="form-control w-50 form-control-sm bg-transparent input-color {{ $canEdit }} {{ $disable }} activeColor input{{$item->id}}" data-id="{{ $item->id }}" data-key="quantity"
                                                value="{{ $item->quantity }}" name="quantity" readonly></p> --}}
                                                <p class="mb-2">
                                            <input type="number" class="form-control w-50 form-control-sm bg-transparent input-color {{ $canEdit }} {{ $disable }} entryItems{{$item->id}} input{{$item->id}}" data-id="{{ $item->id }}" data-key="quantity"
                                                value="{{ $item->quantity }}" name="quantity" readonly></p>
                                    </li>
                                    <li>
                                        <p class="mb-2 me-3 fw-semibold">Warranty</p>
                                        <p class="mb-2">7 Year Warranty</p>
                                    </li>

                                    <li>
                                        <p class="mb-2 me-3 fw-semibold">TOTAL</p>
                                        <p class="mb-2">$<span id="itemtotal{{ $item->id }}">{{ number_format($item->purchase_price,2) }}</span></p>
                                    </li>
                                </ul>
                            </div>

                           @if($order->order_status != 8)

                            <div class="col-lg-1">

                                <div class="mb-2">
                                    <button class="btn btn-primary entryEdit" id="entryEdit{{$item->id}}" data-id="{{$item->id}}"  data-bs-toggle="tooltip" data-container="body" title="Edit">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                            class="bi bi-pencil-fill" viewBox="0 0 16 16">
                                            <path
                                                d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z" />
                                        </svg>
                                    </button>
                                    <button class="btn btn-primary saveEntry entrySave" id="saveEntry{{$item->id}}" data-id="{{$item->id}}" type="submit" data-bs-toggle="tooltip" data-container="body" title="Edit">
                                        <img src="{{url('fonts/save.png')}}">
                                    </button>
                                </div>
                                <div class="mb-2 delete_entry" data-id="{{ $item->id }}" >
                                    <button type="button" class="btn btn-primary delete_item" data-bs-toggle="tooltip" data-container="body"
                                        id="delete_item{{$item->id}}" title="Delete">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                            class="bi bi-trash" viewBox="0 0 16 16">
                                            <path
                                                d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z" />
                                            <path fill-rule="evenodd"
                                                d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                            @endif
                            @if(!empty($item->customer_note))
                              <div class="col-lg-2">
                                <ul class="payment-history txt__sm">
                                    <li class="d-flex">
                                        <p class="mb-2 me-3">Note:</p>
                                        <p class="mb-2">{{ $item->customer_note }}</p>
                                    </li>
                                </ul>
                            </div>
                            @endif
                            @if(!empty($item->room_name ))
                            <div class="col-lg-2">
                                <ul class="payment-history txt__sm">
                              
                                    <li class="d-flex">
                                        <p class="mb-2 me-3 ">Room Name:</p>
                                        <p class="mb-2">{{ $item->room_name }}</p>
                                    </li>
                                </ul>
                            </div>
                            @endif


                        </div>

                    </div>
                </form>
            @endforeach

        </div>
    </div>

</section>




<script>
    $(document).ready( function($) {
        host = "{{ url('admin/note')}}";

        $("#vendor").on("change",function(e){
            e.preventDefault();
            var note = $('#vendor_note').val();
            var order_id = $('#vorder_id').val();
            var receiver = "vendor";
            var action = $('#vendor').val();
            $("#alert_message").text("Are you sure?");
            $("#exampleModaltwo").modal('show');
            $("#model-yes").on("click",function(x){

                $("#exampleModaltwo").modal('hide');

                if(note != ""){
                    $.ajax({
                        type: "POST",
                        url: host,
                        data: {note:note, order_id:order_id, receiver:receiver},
                        success: function( msg ) {
                            if(msg.status){
                                $(".vendor_note_list").append("<p class='txt__sm mb-0'>"+note+"</p><small>0 seconds ago </small><hr/>");
                                $("#vendor_note").val("");
                                $(".vendor_note_list").scrollTop($(".vendor_note_list")[0].scrollHeight);
                            }
                        }
                    });
                }
            });
       });

        $("#customer").on("change",function(e){
            e.preventDefault();
            var note = $('#customer_note').val();
            var order_id = $('#corder_id').val();
            var receiver = "customer";
            var action = $('#customer').val();
            $("#alert_message").text("Are you sure?");
            $("#exampleModaltwo").modal('show');
            $("#model-yes").on("click",function(x){

                $("#exampleModaltwo").modal('hide');
                if(note != ""){
                    $.ajax({
                        type: "POST",
                        url: host,
                        data: {note:note, order_id:order_id, receiver:receiver},
                        success: function( msg ) {
                            if(msg.status){
                                $(".customer_note_list").append("<p class='txt__sm mb-0'>"+note+"</p><small>0 seconds ago </small><hr/>");
                                $("#customer_note").val("");
                                $(".customer_note_list").scrollTop($(".customer_note_list")[0].scrollHeight);
                            }
                        }
                    });
                }
            });
       });

        var currentStatus = $('#order_status').val();
        var newStatus = '';
        var order_id = "{{ $order->id }}";
        $("#order_status").on("change", function(e){
            newStatus = $(this).val();
            $(this).val(currentStatus);
            $('#tracking-append-fild').empty();
            e.preventDefault();
            $("#alert_message").html(`Are you sure want to change the status?
            <div class="text-start pt-3">
                <label class="pb-2 mt-2 small">Tracking Number</label>
                <div class="row gx-2 mb-2 abc">
                    <div class="col-12">
                        <input type="text" class="form-control order_tracking_number" name="order_tracking_number[]"  value="">
                    </div>
                    <!-- <div class="col-3 d-flex text-end">
                        <button type="button" class="btn btn-sm btn-primary add-tracking-number">+</button>
                    </div> -->
                </div>
                <div id="tracking-append-fild"></div>
             </div>`);

             $(document).on('click', '.add-tracking-number', function (e) {
                 e.preventDefault();
                $('#tracking-append-fild').append(`
                <div class="row gx-2 remove mb-2 pe-2">
                    <div class="col-9">
                        <input type="text" class="form-control order_tracking_number" name="order_tracking_number[]" value="">
                    </div>
                    <div class="col-3 d-flex text-end">
                        <button type="button" class="btn btn-sm me-1 btn-primary remove-tracking-number btn-secondary">-</button>
                        <button type="button" class="btn btn-sm btn-primary add-tracking-number">+</button>
                    </div>
                </div>`);

                $("#tracking-append-fild").stop().animate({ scrollTop: $("#tracking-append-fild")[0].scrollHeight }, 1000);

             });

            $(document).on('click', '.remove-tracking-number', function (e) {
                $(this).parents('.remove').remove();
                e.preventDefault();
            });

            $("#exampleModaltwo").modal('show');
            
       });
        $(document).on("click", "#model-no",function(e){
            $('#order_status').val(currentStatus);
        });
        $(document).on("click", "#model-yes",function(e){
            var email_status = $("#email_status").is(":checked");
            var trackingNumber = $(document).find("input[name='order_tracking_number[]']").map(function(){
                return $(this).val();
            }).get();

            if(newStatus == 7 ){
                if(trackingNumber == '' ){
                    toastr.error("Please Enter The Tracking Number");
                    $("#exampleModaltwo").modal('show');
                }
            }

            $("#exampleModaltwo").modal('hide');
            axios.post('/admin/change-order-status',{
                'status': newStatus, 
                'order_id': order_id,
                'trackingNumber': trackingNumber,
                'is_email_active': email_status
            }).then((response)=>{
                if(response.data.status == true){
                    $("#order_status").val(newStatus);
                }
            })
        });


       deleteEntry = "{{ url('admin/delete-order-entry')}}";

        $(".delete_entry").on("click",function(e){
            e.preventDefault();
            var entry_id = $(this).data("id");
            var order_id = "{{ $order->id }}";

            item_count = $("#line_items").text();

            $("#alert_message").text("Are you sure want to delete the item?");
            $("#exampleModaltwo").modal('show');
            $("#model-yes").on("click",function(x){

                $("#exampleModaltwo").modal('hide');
                $.ajax({
                    type: "POST",
                    url: deleteEntry,
                    data: {order_id:order_id, entry_id:entry_id},
                    success: function( msg ) {
                        console.log(msg);
                        // $("#entry_id"+entry_id).css('display','none');
                        if(msg.status){
                            $("#entry_id"+entry_id).css('display','none');
                            item_count = item_count - 1;
                            $("#line_items").text(item_count);
                            // $(".customer_note_list").append("<p class='txt__sm mb-0'>"+note+"</p><small>0 seconds ago </small><hr/>");
                            // $("#customer_note").val("");
                            // $(".customer_note_list").scrollTop($(".customer_note_list")[0].scrollHeight);
                        }
                    }
                });
            });
       });


       // $(document).on("click", ".input-color", function (e) {
       //      var current = $(this);
       //      console.log(current);
       //      current.removeAttr('readonly').addClass('border_color');
       // });


        $(document).on('click', function (e) {
            if (!$(e.target).is('.table-input')) {
                var inputclick = $(".table-input");

                $.each(inputclick, function () {
                    var $this = $(this);
                    if ($this.hasClass('border_color')) {
                        $this.removeClass('border_color');
                        $this.attr('readonly', 'readonly');
                    }
                });
            }
        });

        $(".entryEdit").on("click",function(e){
            //console.log("edit entry click");
            e.preventDefault();
            // console.log("ok");
            var entry_id = $(this).data("id");
             console.log(entry_id);
            $("#entryEdit"+entry_id).css("display","none");
            $("#saveEntry"+entry_id).css("display","block");
            $(".entryItems"+entry_id).removeClass('customDisabled');
            $(".input"+entry_id).removeAttr("readonly");

            $(".input"+entry_id).removeClass('activeColor')
        });


        var updateUrl = "{{ url('admin/update-order-entry')}}";

        $(".saveEntry").on("click",function(e){
            e.preventDefault();

            var entry_id = $(this).data("id");

            order_id =  "{{ $order->id }}";

            var request = $.ajax({
                url: updateUrl,
                method: "POST",
                data: $('#form'+entry_id).serialize(),
            });
            request.done(function( res ) {
             
                // $this.val(newcont);
                $("#entryEdit"+entry_id).css("display","block");
                $("#saveEntry"+entry_id).css("display","none");

                $(".entryItems"+entry_id).addClass('customDisabled');
                $(".input"+entry_id).addClass('activeColor');
                $(".input"+entry_id).attr("readonly",'true');
                $("#itemtotal"+entry_id).text(res.item);
                $("#subtotal"+order_id).text(res.subTotal);
                $("#your_price").text(res.total);
                $("#discount").text(res.totalDiscount);
                toastr.success("Details Saved Successfully");
            });
            request.fail(function( jqXHR, textStatus ) {
              //  alert( "Request failed: " + textStatus );
            });



        });

    });

</script>
@endsection
