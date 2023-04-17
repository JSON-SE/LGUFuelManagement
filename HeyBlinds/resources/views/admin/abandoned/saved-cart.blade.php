@extends('layouts.Backend.admin.admin')

@section('content')
    <section id="body-content" class="">
        <div class="container-fluid px-lg-5 px-md-4 pb-5 pt-lg-3">

            <div class="row pt-4">
                <div class="col-12">
                    <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='white'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
                        <ol class="breadcrumb mb-2">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Cart</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <div class="row justify-content-end">
            <div class="col-md-4 col-lg-3">
                <form action="/admin/save-cart/cart-export" method="GET">
                    @csrf
                        <div class="form-floating search-floating">
                            <input type="text" class="form-control" required name="date_range" id="date_range"
                            placeholder="Select Date Range"  autocomplete="off">
                            <label for="">Select Date Range (DD-MM-YYYY)</label>
                        </div>
                    </div>
                    <div class="col-md-auto">
                        <button type="submit" class="btn btn-primary h-100 px-4" id="download" href="{{url('/admin/abandoned/cart-export')}}">Export</button>
                    </div>
                </form>
            </div>
        </div>

            <div class="bg-white rounded page-height mt-3 shadow">
                <div class="p-lg-4 p-3">
                    <div class="table-responsive mt-2">
                        <table class="table table-striped w-100" id="save-table">
                            <thead class="text-white bg-secondary">
                            <tr>
                                <th>Cart #</th>
                                <th>Customer Name</th>
                                <th>Customer Email</th>
                                <th>Phone Number</th>
                                <th>Purchase Amount</th>
                                <th>Reason</th>
                                <th>Created Date</th>
                                <th>Checkout Url</th>
                            </tr>
                            </thead>
                            <tbody >
                            
                            </tbody>

                        </table>
                        <div class="justify-content-center">
                           {{--  {{ $carts->links() }} --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @push('js')
    <script>
        jQuery(document).ready(function () {
            fetch_save_cart_data();
            function fetch_save_cart_data(date_range = ''){
            $('#save-table').DataTable({
                processing: true,
                serverSide: true,
                ordering : false,
                ajax: {
                    method : 'post',
                    url : '/admin/saved-cart',
                    data: {
                        date_range: date_range,
                    },
                },
                
                columns: [
                { data: 'cart_id', name: 'cart_id' },
                { data: 'name', name: 'name' },
                { data: 'email', name: 'email' },
                { data: 'phone_number', name: 'phone_number' },
                { data: 'cart_amount', name: 'cart_amount' },
                { data: 'reson', name: 'reson' },
                { data: 'created_at', name: 'created_at'},
                 { data: 'action', name: 'action' },
                ]
            });
        }

            $('#date_range').daterangepicker({
                autoUpdateInput: false,
                locale: {
                    cancelLabel: 'Clear'
                }
            });
            $('#date_range').on('change',function(){
                $('#save-table').DataTable().destroy();
                fetch_save_cart_data();
            })

            $('#date_range').on('apply.daterangepicker', function(ev, picker) {
                $(this).val(picker.startDate.format('DD-MM-YYYY') + ' / ' + picker.endDate.format('DD-MM-YYYY'));
                var date_range = $(this).val();
                if(date_range){
                    $('#save-table').DataTable().destroy();
                    fetch_save_cart_data(date_range);
                }
            });


            $('#date_range').on('cancel.daterangepicker', function(ev, picker) {
                $(this).val('');
                $('#save-table').DataTable().destroy();
                fetch_save_cart_data();
            });

        });
    </script>
@endpush

@endsection
