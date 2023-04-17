@extends('layouts.Backend.admin.admin')

@section('content')

<section id="body-content" class="">
    <div class="container-fluid px-lg-5 px-md-4 pb-5 pt-lg-3">
        <div class="row pt-4">
            <div class="col-12">
                <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='white'/%3E%3C/svg%3E&#34;);"
                    aria-label="breadcrumb">
                    <ol class="breadcrumb mb-2">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Sample Orders</li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="row pb-4">
            <div class="col-sm-6 text-white my-auto">

                <h3 class="mb-0">Sample Orders</h3>
            </div>


            <div class="col-sm-6 pt-3 pt-lg-0 my-auto d-flex justify-content-sm-end">

                <a href="{{ url('admin/export') }}" class="btn btn-primary d-flex align-items-center ms-2" id="export">
                    <span class="d-none d-md-block">Export Samples Orders</span>
                </a>

                <a href="{{ url('admin/export-samples-address') }}" class="btn btn-primary d-flex align-items-center ms-2" id="exportAddress">
                    <span class="d-none d-md-block">Export Address Labels</span>
                </a>

                <a href="{{ url('admin/export-samples-inventory') }}" class="btn btn-primary d-flex align-items-center ms-2" id="exportInventory">
                    <span class="d-none d-md-block">Export Samples Inventory Report</span>
                </a>
                <button class="d-none btn btn-primary d-flex align-items-center ms-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-plus" viewBox="0 0 16 16">
                        <path
                            d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z" />
                    </svg>
                    <span class="d-none d-md-block">Create new order</span>
                </button>
            </div>

        </div>

        <div class="bg-white rounded page-height mt-3 shadow position-relative">
            <div class="p-4">
                <form method="get" action="{{ url('admin/sample-order-search')}} " id="search_form">
                    <div class="row">
                        <div class="col-lg-2 col-md-2">
                            <div class="form-floating">
                                <select class="form-select" id="status_search" name="status_search"
                                    aria-label="Floating label select example" onChange="orderSearch()">
                                    <option selected value="0">All</option>
                                    @foreach ($orderStatus as $status)
                                    <option value="{{$status->id}}" {{ $statusId == $status->id ? 'selected' : ''}} >{{ $status->name}}</option>
                                    @endforeach
                                </select>
                                <label for="">Status</label>
                            </div>
                        </div>


                        <div class="col-lg-2 col-md-2">

                            <div class="form-floating">
                                <select class="form-select" id="date_search" name="date_search"
                                    aria-label="Floating label select example" onChange="orderSearch()">
                                    <option selected value="0">All</option>
                                    <option {{$sdate == 1 ? 'selected' : ''}} value="1">Today</option>
                                    <option {{$sdate == 3 ? 'selected' : '' }} value="3">Last 3 Days</option>
                                    <option {{$sdate == 7 ? 'selected' : '' }} value="7">Last 7 Days</option>
                                    <option {{$sdate == 30 ? 'selected' : ' '}} value="30">Last 30 Days</option>
                                </select>
                                <label for="">Date</label>

                            </div>

                        </div>



                        <div class="col-lg-3 col-md-3">
                            <div class="form-floating search-floating">
                                <input type="text" class="form-control" name="datetimes" id="date_input_search"
                                    placeholder="Select Date Range" autocomplete="off">
                                <label for="">Select Date Range</label>
                            </div>
                        </div>


                        <div class="col-lg-3 col-md-3">

                            <div class="form-floating search-floating">
                                <input type="search" class="form-control" name="text_search" id="text_search"
                                    placeholder="Search" value="{{ $search }}" autocomplete="off">
                                <label for="">Search</label>
                                
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-2">
                        <button type="submit" class="btn btn-primary">Search</button>
                        <a href="{{url('/sample-order-search')}}" class="btn btn-primary">Reset</a>
                        </div>
                    </div>
                </form>

                <div class="row">
                    <div class="col-lg-12">
                        <div class="mt-3">
                            <ul id="accordionOrder" class="order-management-list">
                                <li class="order-management-row">
                                    <div>#</div>
                                    <div>Order ID</div>
                                    <div>Created</div>
                                    <div>Name</div>
                                    <div>User</div>
                                    <div>Status</div>
                                    <div></div>
                                    <div></div>
                                    <div></div>
                                </li>


                                @foreach ($orders as $order)


                                @php
                                $days = $order->created_at->diffInDays(now());
                                $background = "";
                                if(($order->order_status == 1 && $days >= 1 ) || ( $order->order_status == 2 && $days >=
                                1 )){
                                $background = "background-color:yellow";
                                }
                                @endphp

                                <li style="{{ $background }}">
                                    <div>
                                        <div class="check-box">
                                            <input type="checkbox" id="order{{ $order->id }}"
                                                name="order{{ $order->id }}" value="order{{ $order->id }}">
                                            <label for="order{{ $order->id }}"></label>
                                        </div>
                                    </div>
                                    <div>{{ $order->sample_order_id }}</div>
                                    <div>{{ $order->created_at->diffForHumans() }}</div>
                                    <div class="d-flex justify-content-between">
                                        <span class="text-truncate w-50">{{ $order->first_name }}
                                        </span>
                                        <div class="order-status-icon">

                                            @if(count($order->orderEntries) > 2)
                                            <span><img src="{{ asset('admin/images/icon2.png') }}" /></span>
                                            @endif
                                            @if($order->delivery == "express")
                                            <span><img src="{{ asset('admin/images/icon4.png') }}" /></span>
                                            @endif
                                            @if( $order->first_name == "X12EDI" )
                                            <span><img src="{{ asset('admin/images/icon5.png') }}" /></span>
                                            @endif

                                        </div>
                                    </div>


                                    @if(true)
                                    <div>
                                        <h5 class="text-primary">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22"
                                                fill="currentColor" class="bi bi-person-check-fill" viewBox="0 0 16 16">
                                                <path fill-rule="evenodd"
                                                    d="M15.854 5.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 0 1 .708-.708L12.5 7.793l2.646-2.647a.5.5 0 0 1 .708 0z" />
                                                <path
                                                    d="M1 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z" />
                                            </svg>
                                        </h5>
                                    </div>
                                    @elseif(false)
                                    <div>
                                        <h5 class="text-success">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22"
                                                fill="currentColor" class="bi bi-person-check-fill" viewBox="0 0 16 16">
                                                <path fill-rule="evenodd"
                                                    d="M15.854 5.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 0 1 .708-.708L12.5 7.793l2.646-2.647a.5.5 0 0 1 .708 0z" />
                                                <path
                                                    d="M1 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z" />
                                            </svg>
                                        </h5>
                                    </div>

                                    @endif

                                    @if($order->order_status <= 5 ) <div>
                                        <button class="btn btn-sm status-pending-btn status-btn">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-clock-history" viewBox="0 0 16 16">
                                                <path
                                                    d="M8.515 1.019A7 7 0 0 0 8 1V0a8 8 0 0 1 .589.022l-.074.997zm2.004.45a7.003 7.003 0 0 0-.985-.299l.219-.976c.383.086.76.2 1.126.342l-.36.933zm1.37.71a7.01 7.01 0 0 0-.439-.27l.493-.87a8.025 8.025 0 0 1 .979.654l-.615.789a6.996 6.996 0 0 0-.418-.302zm1.834 1.79a6.99 6.99 0 0 0-.653-.796l.724-.69c.27.285.52.59.747.91l-.818.576zm.744 1.352a7.08 7.08 0 0 0-.214-.468l.893-.45a7.976 7.976 0 0 1 .45 1.088l-.95.313a7.023 7.023 0 0 0-.179-.483zm.53 2.507a6.991 6.991 0 0 0-.1-1.025l.985-.17c.067.386.106.778.116 1.17l-1 .025zm-.131 1.538c.033-.17.06-.339.081-.51l.993.123a7.957 7.957 0 0 1-.23 1.155l-.964-.267c.046-.165.086-.332.12-.501zm-.952 2.379c.184-.29.346-.594.486-.908l.914.405c-.16.36-.345.706-.555 1.038l-.845-.535zm-.964 1.205c.122-.122.239-.248.35-.378l.758.653a8.073 8.073 0 0 1-.401.432l-.707-.707z" />
                                                <path d="M8 1a7 7 0 1 0 4.95 11.95l.707.707A8.001 8.001 0 1 1 8 0v1z" />
                                                <path
                                                    d="M7.5 3a.5.5 0 0 1 .5.5v5.21l3.248 1.856a.5.5 0 0 1-.496.868l-3.5-2A.5.5 0 0 1 7 9V3.5a.5.5 0 0 1 .5-.5z" />
                                            </svg>
                                        </button>
                        </div>

                        @elseif($order->order_status == 8 )

                        <div>
                            <button class="btn btn-sm status-confirmed-btn status-btn">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-check-circle" viewBox="0 0 16 16">
                                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                    <path
                                        d="M10.97 4.97a.235.235 0 0 0-.02.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05z" />
                                </svg>
                            </button>
                        </div>

                        @else

                        <div>
                            <button class="btn btn-sm status-cancelled-btn">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-x-circle" viewBox="0 0 16 16">
                                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                    <path
                                        d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z" />
                                </svg>
                            </button>
                        </div>

                        @endif

                        <div>
                            <a href="{{ route('admin.samples.show',$order->id) }}" class="order-view-btn">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-eye-fill" viewBox="0 0 16 16">
                                    <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z" />
                                    <path
                                        d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z" />
                                </svg>
                            </a>
                        </div>

                        </li>

                        @endforeach

                        </ul>
                    </div>
                    <div class="my-4">
                        {{ $orders->links() }}
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>
@push('js')
<script>
    function orderSearch(){
        host = "{{ url('admin/sample-order-search')}}";
        var status_search = $('#status_search').val();
        var date_search = $('#date_search').val();

        $("#search_form").submit();
    }
</script>

<script type="text/javascript">
    $(function() {

      $('input[name="datetimes"]').daterangepicker({
          autoUpdateInput: false,
          locale: {
              cancelLabel: 'Clear'
          }
      });

      $('input[name="datetimes"]').on('apply.daterangepicker', function(ev, picker) {
          $(this).val(picker.startDate.format('DD-MM-YYYY') + ' / ' + picker.endDate.format('DD-MM-YYYY'));
      });

      $('input[name="datetimes"]').on('cancel.daterangepicker', function(ev, picker) {
          $(this).val('');
      });

    });

    $("#export").on("click",function(event){
        event.preventDefault();
        endDate = "";
        startDate = "";
        dateRange = $('input[name="datetimes"]').val();
        if(dateRange != ""){
            endDate = $('input[name="datetimes"]').data("daterangepicker").endDate.format('YYYY-MM-DD');
            startDate = $('input[name="datetimes"]').data("daterangepicker").startDate.format('YYYY-MM-DD');
        }

        status = $("#status_search").val();
        textSearch = $("#text_search").val();


        orderId = 0;

        url = "{{ url('admin/export') }}/"+orderId+"/"+status+"/"+startDate+"/"+endDate+"/"+textSearch ;

        window.location.href =  url;

        return false;

    });

    $("#exportAddress").on("click",function(event){
        event.preventDefault();
        endDate = "";
        startDate = "";
        dateRange = $('input[name="datetimes"]').val();
        if(dateRange != ""){
            endDate = $('input[name="datetimes"]').data("daterangepicker").endDate.format('YYYY-MM-DD');
            startDate = $('input[name="datetimes"]').data("daterangepicker").startDate.format('YYYY-MM-DD');
        }
        // alert(startDate);

        status = $("#status_search").val();
        textSearch = $("#text_search").val();

        orderId = 0;

        url = "{{ url('admin/export-samples-address') }}/"+orderId+"/"+status+"/"+startDate+"/"+endDate+"/"+textSearch ;

        window.location.href =  url;

        return false;

    });

    $("#exportInventory").on("click",function(event){
        event.preventDefault();
        endDate = "";
        startDate = "";
        dateRange = $('input[name="datetimes"]').val();
        if(dateRange != ""){
            endDate = $('input[name="datetimes"]').data("daterangepicker").endDate.format('YYYY-MM-DD');
            startDate = $('input[name="datetimes"]').data("daterangepicker").startDate.format('YYYY-MM-DD');
        }

        status = $("#status_search").val();
        textSearch = $("#text_search").val();


        orderId = 0;

        url = "{{ url('admin/export-samples-inventory') }}/"+orderId+"/"+status+"/"+startDate+"/"+endDate+"/"+textSearch ;

        window.location.href =  url;

        return false;

    });
</script>
@endpush
@endsection
