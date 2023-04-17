@extends('layouts.Backend.admin.admin')
@section('content')

<section id="body-content" class="">
    <div class="container-fluid px-lg-5 px-md-4 pb-5 pt-lg-3">
        <div class="row pt-4">
            <div class="col-12">
                <nav>
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
                <h3 class="mb-0">Sample Order ({{ $order->sample_order_id }})</h3>
            </div>

            <div class="col-sm-6 pt-3 pt-lg-0 my-auto d-flex justify-content-sm-end">

                {{-- <a href="{{ url('admin/export', $order->sample_order_id ) }}" class="btn btn-primary d-flex align-items-center ms-2">
                    <span class="d-none d-md-block">Export Samples Order</span>
                </a> --}}

                <a href="{{ route('admin.samples.index') }}" class="btn btn-primary d-flex align-items-center ms-2">
                   
                    <span class="d-none d-md-block">Sample Orders</span>
                </a>

            </div>
        </div>

        <div class="bg-white rounded page-height mt-3 shadow p-4">
            <div
                class="{{$helpers->changeColorForMoreOrder($order->sample_cart_external_id) == true  ? 'bg-primary' : 'bg-primary'}}  p-2 rounded mb-3 text-white d-flex flex-wrap align-items-center justify-content-between">
                <p class="mb-0">
                    Order status: {{ $status }} {{date("Y-m-d h.i A",strtotime($order->updated_at)) }}
                </p>
                <p class="mb-0">Order ID: {{ $order->sample_order_id }}</p>
            </div>

            <div class="row">
                <div class="col-md-4 mb-3">
                    <h5>Shipping information</h5>
                    <p class="mb-2"><input type="text" class="edit-input table-input"
                            value="{{ $address->first_name }} {{ $address->last_name }}" name="" readonly>
                    </p>
                    <p class="mb-2"><input type="text" class="edit-input table-input"
                            value=" {{ $address->street }}, {{ $address->area_code }}"
                            name="" readonly></p>
                    <p class="mb-2"><input type="text" class="edit-input table-input"
                            value="{{ $address->city }}, {{ $address->province }},"
                            name="" readonly></p>
                    <p class="mb-2"><input type="text" class="edit-input table-input"
                            value="{{ $address->postal_code }}"
                            name="" readonly></p>
                    <p class="mb-2">
                        <a href="#" class="d-inline"><input type="text" class="edit-input table-input"
                                value="{{ $address->email }}" name="" readonly></a>
                    </p>
                    <p class="mb-2"><a href="#" class="d-inline"><input type="text" class="edit-input table-input"
                                value="{{ $address->phone_number }}" name="" readonly></a></p>
                </div>
              
                <div class="col-md-4 mb-3">
                    <div>
                        <label class="pb-2 mt-2">Order Status</label>
                        <select class="form-select" aria-label="Default select example" id="order_status">
                            @foreach($orderStatus as $status)
                            <option value="{{ $status->id }}" {{$order->order_status == $status->id ?
                                "selected" : ''}}>{{ $status->name }}</option>
                            @endforeach
                        </select>
                        <input type="hidden" name="current" id="current" value="{{ $order->order_status }}" />
                    </div>

                    <div>
                        <label class="pb-2 mt-2">Shipping Date</label>
                        <input type="date" class="form-control" name="shipping_date" id="shipping_date" value="{{ $order->order_shipped }}" />
                    </div>

                </div>

                <div class="col-md-4 mb-3">
                    <div>
                        <label class="pb-2 mt-2">Shipping Method</label>
                        <select class="form-select" aria-label="Default select example" id="shipping_method">
                            <option value="1" {{$order->shipping_type == 1 ? 'selected' : '' }}>Courier</option>
                            <option value="0" {{$order->shipping_type == 0 ? 'selected' : ''}} >Regular Mail</option>
                        </select>
                        <input type="hidden" name="current_shipping" id="current_shipping" value="{{ $order->delivery }}" />
                    </div>

                    <div>
                        <label class="pb-2 mt-2">Tracking Number</label>
                        <input type="text" class="form-control" name="order_tracking_number" id="order_tracking_number" value="{{ $order->order_tracking_number }}" />
                    </div>

                </div>
            </div>
            <div class="row pt-2">
                <form>
                    <div class="row">
                        <div class="col-sm-6 mb-3">
                            <h5>Customer note</h5>
                            <div class="shadow-sm p-3 mb-3 rounded customer_note_list">
                                <h6 class="text-secondary">{{ $order->first_name }}</h6>
                                <hr class="my-2" />
                                @foreach ($order->notes->where('receiver','customer') as $cnote )
                                <p class="txt__sm mb-0">
                                    {{ $cnote->note }}
                                </p>
                                <small>
                                    {{ $cnote->created_at->DIFFfORhUMANS() }}
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
                                    {{ $cnote->created_at->DIFFfORhUMANS() }}
                                </small>
                                <hr>
                                @endforeach
                            </div>
                            <form method="post" action="">
                                <textarea class="form-control mb-3" rows="5" name="vendor_note" id="vendor_note"
                                    placeholder="Message"></textarea>
                                <input type="hidden" name="vorder_id" id="vorder_id" value="{{$order->id}}">
                                <select class="btn btn-primary" name="vendor" id="vendor">
                                    <option value="vendor">Select Action</option>
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

                <div class="col-sm-8 mb-3">
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
                </div>
            </div>

            @foreach ($order->orderEntries as $entry)

            <div class="bg-light rounded mb-4 p-4" id="entry_id{{$entry->id}}">

                <h5>
                    HB Product Name:  {{ $entry->product->name ?? "" }}
                </h5>
                <hr />
                <div class="row">
                    <div class="col-lg-4">
                        <ul class="payment-history txt__sm">
                            <li>
                                <p class="mb-2 me-3 fw-bold">HB Color #</p>
                                <p class="mb-2"><input type="text" class="edit-input table-input"
                                        value=" {{ $entry->color->color_id }}" name="" readonly></p>
                            </li>
                            <li>
                                <p class="mb-2 me-3 fw-bold">HB Color Name</p>
                                <p class="mb-2"><input type="text" class="edit-input table-input"
                                        value=" {{ $entry->color->name}}" name="" readonly></p>
                            </li>

                            <li>
                                <p class="mb-2 me-3 fw-bold">Vendor Color Name</p>
                                <p class="mb-2"><input type="text" class="edit-input table-input"
                                        value=" {{ $entry->color->vendor_color_name}}" name="" readonly></p>
                            </li>

                            <li>
                                <p class="mb-2 me-3 fw-bold">HB Location #</p>
                                <p class="mb-2"><input type="text" class="edit-input table-input"
                                        value=" {{ $entry->color->id}}" name="" readonly></p>
                            </li>

                            {{-- <li>
                                <p class="mb-2 me-3 fw-bold">Width</p>
                                <p class="mb-2"><input type="text" class="edit-input table-input"
                                        value=" {{ $entry->width }}" name="" readonly></p>
                            </li> --}}
                            {{-- <li>
                                <p class="mb-2 me-3 fw-bold">Height</p>
                                <p class="mb-2"><input type="text" class="edit-input table-input"
                                        value=" {{ $entry->height }}" name="" readonly></p>
                            </li>
                            <li>
                                <p class="mb-2 me-3 fw-bold">Mount Type</p>
                                <p class="mb-2"><input type="text" class="edit-input table-input"
                                        value=" {{ $entry->mount_type }}" name="" readonly></p>
                            </li>

                            <li>
                                <p class="mb-2 me-3 fw-bold">Room name</p>
                                <p class="mb-2"><input type="text" class="edit-input table-input"
                                        value=" {{ $entry->room }}" name="" readonly></p>
                            </li> --}}

                        </ul>
                    </div>

                    {{-- <div class="col-lg-4">
                        <ul class="payment-history txt__sm">

                            <li>
                                <p class="mb-2 me-3 fw-bold">Easy Lift Systems</p>
                                <p class="mb-2"><input type="text" class="edit-input table-input"
                                        value=" {{ $entry->lift }}" name="" readonly></p>
                            </li>
                            <li>
                                <p class="mb-2 me-3 fw-bold">Headrail Options</p>
                                <p class="mb-2"><input type="text" class="edit-input table-input"
                                        value=" {{ $entry->headrail }}" name="" readonly></p>
                            </li>
                            <li>
                                <p class="mb-2 me-3 fw-bold">Valance</p>
                                <p class="mb-2"><input type="text" class="edit-input table-input"
                                        value=" {{ $entry->valance }}" name="" readonly></p>
                            </li>
                            <li>
                                <p class="mb-2 me-3 fw-bold">Bottom Trim</p>
                                <p class="mb-2"><input type="text" class="edit-input table-input"
                                        value=" {{ $entry->bottom_trim }}" name="" readonly></p>
                            </li>
                        </ul>
                    </div> --}}
                    {{-- <div class="col-lg-3">
                        <ul class="payment-history txt__sm">
                            <li>
                                <p class="mb-2 me-3 fw-bold">Qty</p>
                                <p class="mb-2"><input type="number" class="edit-input table-input"
                                        value="{{ $entry->quantity }}" name="" readonly></p>
                            </li>
                            <li>
                                <p class="mb-2 me-3 fw-bold">Tax</p>
                                <p class="mb-2"> </p>
                            </li>
                            <li>
                                <p class="mb-2 me-3 fw-bold">Warranty</p>
                                <p class="mb-2"> {{ $entry->warranty }}</p>
                            </li>

                            <li>
                                <p class="mb-2 me-3 fw-bold">TOTAL</p>
                                <p class="mb-2"> ${{ number_format($entry->price,2) }}</p>
                            </li>
                        </ul>
                    </div> --}}

                    {{-- <div class="col-lg-1">

                        <div class="mb-2">
                            <button class="btn btn-primary" data-bs-toggle="tooltip" data-container="body" title="Edit">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-pencil-fill" viewBox="0 0 16 16">
                                    <path
                                        d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z" />
                                </svg>
                            </button>
                        </div>
                        <div class="mb-2 delete_entry" data-id="{{ $entry->id }}" >
                            <button class="btn btn-primary delete_item" data-bs-toggle="tooltip" data-container="body"
                                id="delete_item{{$order->id}}" title="Delete">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-trash" viewBox="0 0 16 16">
                                    <path
                                        d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z" />
                                    <path fill-rule="evenodd"
                                        d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" />
                                </svg>
                            </button>
                        </div>

                    </div> --}}

                    {{-- <div>
                        <ul class="">
                            <li class="d-flex">
                                <p class="mb-2 me-3 fw-bold">Note</p>
                                <p class="mb-2">{{ $entry->note }}</p>
                            </li>
                        </ul>
                    </div> --}}

                </div>

            </div>

            @endforeach

        </div>
    </div>




</section>


<script>
    $( document ).ready( function( $ ) {

        host = "{{ url('admin/sample-note')}}";

        $("#vendor").on("change",function(e){
            // debugger

            e.stopImmediatePropagation();
            // e.preventDefault();
            var note = $('#vendor_note').val();
            var order_id = $('#vorder_id').val();
            var receiver = "vendor";
            var action = $('#vendor').val();
            console.log(note);
            // console.log(order_id);
            // console.log(action);
            // return false;
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
                                $('#vendor_note').val("");
                            }
                        }
                    });

                }
            });

       });

        $("#customer").on("change",function(e){
            e.preventDefault();
            var note = "";
            var note = $('#customer_note').val();
            var order_id = $('#corder_id').val();
            var receiver = "customer";
            var action = $('#customer').val();
            // console.log(note);
            // console.log(order_id);
            // console.log(action);
            // return false;
               // return false;
            $("#alert_message").text("Are you sure?");
            $("#exampleModaltwo").modal('show');
            $("#model-yes").on("click",function(x){

                $("#exampleModaltwo").modal('hide');

                console.log(note);

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


       statusChange = "{{ url('admin/change-sample-order-status')}}";

        $("#order_status").on("change",function(e){
            e.preventDefault();
            var status = $('#order_status').val();
            var order_id = "{{ $order->id }}";
            var current = $('#current').val();
            $("#alert_message").text("Are you sure want to change the status?");
            $("#exampleModaltwo").modal('show');
            $("#model-no").on("click",function(){
                $("#order_status").val(current).change();
                // $("#order_status option[value="+status+"]").attr('selected',true);
                // $(`#order_status option[value='${status}']`).prop('selected', true).change();
                // $(this).val(current);
            });

            $("#model-yes").on("click",function(x){

                $("#exampleModaltwo").modal('hide');
                $.ajax({
                    type: "POST",
                    url: statusChange,
                    data: {status:status, order_id:order_id},
                    success: function( msg ) {
                        if(msg.status){
                            console.log(msg);
                            // $(".customer_note_list").append("<p class='txt__sm mb-0'>"+note+"</p><small>0 seconds ago </small><hr/>");
                            // $("#customer_note").val("");
                            // $(".customer_note_list").scrollTop($(".customer_note_list")[0].scrollHeight);
                        }
                    }
                });
            });
       });


       deleteEntry = "{{ url('admin/delete-order-entry')}}";

        $(".delete_entry").on("click",function(e){
            e.preventDefault();

            // alert("ok");
            // return false;
            // var id = $(this).data("id");
            // alert(id);
            // return false;

            var entry_id = $(this).data("id");
            var order_id = "{{ $order->id }}";

            item_count = $("#line_items").text();
            // item_count = item_count - 1;
            // $("#line_items").text(item_count);
            // alert(item_count);
            // return false;


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


       shippingChange = "{{ url('admin/change-sample-order-shipping-method')}}";

        $("#shipping_method").on("change",function(e){
            e.preventDefault();
            var shipping = $('#shipping_method').val();
            var order_id = "{{ $order->id }}";
            var current = $('#current_shipping').val();
            $("#alert_message").text("Are you sure want to change the Shipping Method?");
            $("#exampleModaltwo").modal('show');
            $("#model-no").on("click",function(){
                $("#shipping_method").val(current).change();
                // $("#shipping_method option[value="+status+"]").attr('selected',true);
                // $(`#shipping_method option[value='${status}']`).prop('selected', true).change();
                // $(this).val(current);
            });

            $("#model-yes").on("click",function(x){
                $("#exampleModaltwo").modal('hide');
                $.ajax({
                    type: "POST",
                    url: shippingChange,
                    data: {shipping:shipping, order_id:order_id},
                    success: function( msg ) {
                        console.log(msg);
                        if(msg.status){
                            console.log(msg);
                        }
                    }
                });
            });
        });


       shippingDateChange = "{{ url('admin/change-sample-order-shipping-date')}}";

        $("#shipping_date").on("change",function(e){
            e.preventDefault();
            var shippingDate = $('#shipping_date').val();
            var order_id = "{{ $order->id }}";
            var current = $('#current_shipping').val();
            $("#alert_message").text("Are you sure want to change the shippingDate Method?");
            $("#exampleModaltwo").modal('show');
            $("#model-no").on("click",function(){
                $("#shipping_date").val(current).change();
            });

            $("#model-yes").on("click",function(x){
                $("#exampleModaltwo").modal('hide');
                $.ajax({
                    type: "POST",
                    url: shippingDateChange,
                    data: {shippingDate:shippingDate, order_id:order_id},
                    success: function( msg ) {
                        console.log(msg);
                        if(msg.status){
                            console.log(msg);
                        }
                    }
                });
            });
        });


       shippingOrderTracking = "{{ url('admin/change-sample-order-shipping-tracking')}}";

        $("#order_tracking_number").on("change",function(e){
            e.preventDefault();
            var trackingNumber = $('#order_tracking_number').val();
            var order_id = "{{ $order->id }}";
            var current = $('#current_shipping').val();
            $("#alert_message").text("Are you sure want to change the trackingNumber Method?");
            $("#exampleModaltwo").modal('show');

            // $("#model-no").on("click",function(){
            //     $("#order_tracking_number").val(current).change();
            // });

            $("#model-yes").on("click",function(x){
                $("#exampleModaltwo").modal('hide');
                $.ajax({
                    type: "POST",
                    url: shippingOrderTracking,
                    data: {trackingNumber:trackingNumber, order_id:order_id},
                    success: function( msg ) {
                        console.log(msg);
                        if(msg.status){
                            console.log(msg);
                        }
                    }
                });
            });
        });

    });
</script>
@endsection
