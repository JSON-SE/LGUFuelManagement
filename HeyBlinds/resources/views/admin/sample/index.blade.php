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
                    <li class="breadcrumb-item active" aria-current="page">All Sample Orders</li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="row pb-4">
        <div class="col-lg-3 text-white my-auto">
            <h3 class="mb-0">All Sample Orders</h3>
        </div>


        <div class="col-lg-9 pt-3 pt-lg-0 my-auto">
            <form method="GET" action="{{ url('admin/sample-order-export')}}" id="order-smaple-export" >
                @csrf
                <div class="row gx-2 justify-content-lg-end">
                    <div class="col-lg-2 col-md-2">
                        <div class="form-floating">
                            <select class="form-select" id="status_search" name="status_search" aria-label="Floating label select">
                                <option selected value="0">All</option>
                                @foreach ($orderStatus as $status)
                                <option value="{{ $status->id }}">{{ $status->name }}</option>
                                @endforeach
                            </select>
                            <label for="">Status</label>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-2">
                        <div class="form-floating">
                            <select class="form-select" id="day_range" name="day_range" aria-label="Floating label select">
                                <option selected value="0">All</option>
                                <option value="1">Today</option>
                                <option value="3">Last 3 Days</option>
                                <option value="7">Last 7 Days</option>
                                <option value="30">Last 30 Days</option>
                            </select>
                            <label for="">Day</label>

                        </div>
                    </div>
                    <div class="col-lg-2 col-md-2">
                        <div class="form-floating search-floating">
                            <input type="text" class="form-control" name="date_range" id="date_range"
                            placeholder="Select Date Range" autocomplete="off">
                            <label for="">Select Date Range</label>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <button type="reset" class="btn btn-primary  ms-2" id="rest-search">
                            <span class="d-none d-md-block">Reset Search</span>
                        </button>
                         <button type="submit" name="export_report" value="order_report" class="btn btn-primary ms-2" id="export">
                            <span class="d-none d-md-block">Order Report</span>
                        </button>
                        <button type="submit" name="export_report" value="address_label"  class="btn btn-primary  ms-2" id="exportAddress">
                            <span class="d-none d-md-block">Address Labels</span>
                        </button>
                        <button type="submit" name="export_report" value="inventory_report"  class="btn btn-primary  ms-2" id="exportInventory">
                            <span class="d-none d-md-block">Inventory Report</span>
                        </button>
                    </div>

                    {{-- <div class="col-lg-2 col-md-2">
                       
                    </div>
                    <div class="col-lg-2 col-md-2">
                         
                    </div>
                    <div class="col-lg-2 col-md-2">
                        
                    </div> --}}
                </div>
            </form>
        </div>
    </div>

<div class="bg-white rounded page-height mt-3 shadow position-relative">
    <div class="p-4">
        <div class="row">
            <div class="col-lg-12">
                <div class="table-responsive mt-2">
                    <table class="table w-100" id="sample-order-table">
                        <thead class="text-white bg-secondary">
                            <tr>
                                <th>#</th>
                                <th>Order ID</th>
                                <th>Created Date</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone Number</th>
                                <th>User</th>
                                <th></th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>

                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
</section>

@push('js')

<script>
   $(document).ready(function(){
        var status_search = $('#status_search').val();
        var day_range = $('#day_range').val();
        var date_range = $('#date_range').val();
        orderSearch(status_search,date_range,day_range);
        function orderSearch(status_search = '',day_range = '',date_range = ''){
            $('#sample-order-table').DataTable({
                processing: true,
                serverSide: true,
                ordering : false,
                searching :true,
                ajax: {
                    method:'POST',
                    url: '/admin/samples-order-info',
                    data:{
                        'status_search' : status_search,
                        'day_range': day_range,
                        'date_range': date_range,
                    }
                },
                columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex' },
                { data: 'order_id', name: 'order_id' },
                { data: 'created_at', name: 'created_at' },
                { data: 'name', name: 'name' },
                { data: 'email', name: 'email' },
                { data: 'phone_number', name: 'phone_number' },
                { data: 'icon', name: 'icon' },
                { data: 'user', name: 'user' },
                { data: 'status', name: 'status' },
                { data: 'action', name: 'action' },
                ],
                'columnDefs': [
                {
                        "targets": 6, // your case first column
                        "className": "text-end",
                    },
                    {
                        "targets": 5, // your case first column
                        "className": "text-start",
                    },
                    ],
                });
        }
        $('#status_search').on('change',function(){
            status_search = $(this).val();
            $('#sample-order-table').DataTable().destroy();
            orderSearch(status_search,day_range,date_range);
        })
        $('#day_range').on('change',function(e){
            e.preventDefault();
            day_range = $(this).val();
            $('#sample-order-table').DataTable().destroy();
            orderSearch(status_search,day_range,date_range);
        })
        $('#date_range').on('change',function(e){
         e.preventDefault();
         date_range = $(this).val();
         $('#sample-order-table').DataTable().destroy();
         orderSearch(status_search,day_range,date_range);
     })

        $('#date_range').daterangepicker({
            autoUpdateInput: false,
            locale: {
                cancelLabel: 'Clear'
            }
        });

        $('#date_range').on('change apply.daterangepicker', function(ev, picker) {
            $(this).val(picker.startDate.format('DD-MM-YYYY') + ' / ' + picker.endDate.format('DD-MM-YYYY'));
            date_range = $(this).val();
            if(date_range){
                $('#sample-order-table').DataTable().destroy();
                orderSearch(status_search,day_range,date_range);
            }
        });

        $('#date_range').on('cancel.daterangepicker', function(ev, picker) {
            $('#date_range').val('');
            date_range = '';
            $('#sample-order-table').DataTable().destroy();
            orderSearch();
        });
        $('#rest-search').on('click',function(e){
            $('#sample-order-table').DataTable().destroy();
            orderSearch();
        })
        $("#order-smaple-export").on("keypress", function (event) {
            var keyPressed = event.keyCode || event.which;
            if (keyPressed === 13) {
                event.preventDefault();
                return false;
                
            }
        });
    });
</script>
@endpush
@endsection



