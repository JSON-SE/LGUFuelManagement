@extends('layouts.Backend.admin.admin')
@section('content')
    <section id="body-content" class="">
    <div class=" container-fluid px-lg-5 px-md-4 pb-5 pt-lg-3">
        <div class="row pt-4">
            <div class="col-12">
                <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='white'/%3E%3C/svg%3E&#34;);"
                    aria-label="breadcrumb">
                    <ol class="breadcrumb mb-2">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                        {{-- <li class="breadcrumb-item active" aria-current="page">Order Management</li> --}}
                        <li class="breadcrumb-item active" aria-current="page">Action</li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="row pb-4">
            <div class="col-sm-6 text-white my-auto">

                <h3 class="mb-0">Actions Report</h3>
            </div>
        </div>
        <div class="row justify-content-end">
            <div class="col-md-3 col-lg-3">
                <button type="button" class="btn btn-primary h-100 px-4" id="save-cart-width-email">Saved carts with emails</button>
            </div>
            <div class="col-md-4 col-lg-3">

                <form action="/admin/abandoned/cart-export" method="GET">
                    @csrf
                    <div class="form-floating search-floating">
                        <input type="text" class="form-control" name="date_range" id="date_range"
                            placeholder="Select Date Range" autocomplete="off">
                        <label for="">Select Date Range (DD-MM-YYYY)</label>
                    </div>
            </div>
            <div class="col-md-auto">
                <button type="submit" class="btn btn-primary h-100 px-4" id="download">Actions Report</button>
            </div>
            </form>
        </div>

        <div class="bg-white rounded page-height mt-3 shadow">
            <div class="p-lg-4 p-3">
                <div class="row gx-3 pb-2">
                </div>

                <div class="table-responsive mt-2">
                    <table class="table table-striped w-100" id="abandoned-table">
                        <thead class="text-white bg-secondary">
                            <tr>
                                <th>Cart #</th>
                                <th>Order Samples ?</th>
                                <th>Provience</th>
                                <th>Customer Name</th>
                                <th>Customer Email</th>
                                <th>Customer Phone</th>
                                <th>Purchase Amount</th>
                                <th>Created Date</th>
                                <th>Checkout Url</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>

                    </table>
                </div>

            </div>
        </div>
        </div>
    </section>

    @push('js')

        <script>
            jQuery(document).ready(function() {
                fetch_abandoned_data();
               var saved_email =  'saved_email';
                function fetch_abandoned_data(date_range = '',saved_email='') {
                    $('#abandoned-table').DataTable({
                        processing: true,
                        serverSide: true,
                        ordering: false,
                        ajax: {
                            method: 'post',
                            url: '/admin/action',
                            data: {
                                date_range: date_range,
                                saved_email: saved_email
                            }
                        },
                        columns: [{
                                data: 'cart.cart_id',
                                name: 'cart.cart_id'
                            },
                            {
                                data: 'is_order_sample',
                                name: 'is_order_sample'
                            },
                            {
                                data: 'shipping_province',
                                name: 'shipping_province'
                            },
                            {
                                data: 'name',
                                name: 'name'
                            },
                            {
                                data: 'shipping_email',
                                name: 'shipping_email'
                            },
                            {
                                data: 'shipping_phone_number',
                                name: 'shipping_phone_number'
                            },
                            {
                                data: 'cart_amount',
                                name: 'cart_amount'
                            },
                            {
                                data: 'created_at',
                                name: 'created_at'
                            },
                            {
                                data: 'action',
                                name: 'action'
                            },
                        ]
                    });
                }

                $('#date_range').daterangepicker({
                    autoUpdateInput: false,
                    //opens: 'right',
                    applyOnMenuSelect: true,
                    locale: {
                        cancelLabel: 'Clear'
                    }

                });
                $('#date_range').on('change', function() {
                    $('#abandoned-table').DataTable().destroy();
                    fetch_abandoned_data();
                })

                $('#date_range').on('change apply.daterangepicker', function(ev, picker) {
                    $(this).val(picker.startDate.format('DD-MM-YYYY') + ' / ' + picker.endDate.format(
                        'DD-MM-YYYY'));
                    var date_range = $(this).val();
                    if (date_range) {
                        $('#abandoned-table').DataTable().destroy();
                        fetch_abandoned_data(date_range);
                    }
                });

                $('#date_range').on('cancel.daterangepicker', function(ev, picker) {
                    $(this).val('');
                    var date_range = '';
                    $('#abandoned-table').DataTable().destroy();
                    fetch_abandoned_data(date_range = '',saved_email='');
                });
                $('#save-cart-width-email').on('click',function(e){
                    saved_email =  'saved_email';
                   $('#abandoned-table').DataTable().destroy();
                    fetch_abandoned_data(date_range = '',saved_email);
                });
            });
        </script>

    @endpush
@endsection
