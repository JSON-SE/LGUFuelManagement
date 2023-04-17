@extends('layouts.Backend.admin.admin')

@section('content')
<section class="" id="body-content">
    <div class="container-fluid px-lg-5 px-md-4 pb-5 pt-lg-3">
        <div class="row pt-4">
            <div class="col-12">
                <nav aria-label="breadcrumb" style="--bs-breadcrumb-divider: url(&quot;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='white'/%3E%3C/svg%3E&quot;);">
                    <ol class="breadcrumb mb-2">
                        <li class="breadcrumb-item">
                            <a href="#">
                                Home
                            </a>
                        </li>
                        <li aria-current="page" class="breadcrumb-item active">
                           All Users
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="row pb-4">
            <div class="col-sm-6 text-white my-auto">
                <h3 class="mb-0">
                All Users
                </h3>
            </div>
        </div>
        @if (Session::has('message'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {!! Session::get('message') !!}
        </div>
        @endif
        <div class="bg-white rounded page-height mt-3 shadow">
            <div class="p-lg-4 p-3">
                <div class="table-responsive mt-2">
                    <table class="table table-striped w-100" id="customer-table">
                        <thead class="text-white bg-secondary">
                            <tr>
                                <th>
                                    #
                                </th>
                                <th>
                                    User Name
                                </th>
                                <th>
                                    Email
                                </th>
                                 <th>
                                    Phone Number
                                </th>
                                <th>
                                    # Of Order
                                </th>
                                <th>
                                    # Saved Cart
                                </th>
                                <th>
                                    Guest
                                </th>
                                <th>
                                    Registered Date
                                </th>
                                <th>
                                    Action
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                          
                        </tbody>
                    </table>
                    <div class="justify-content-center">
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@push('js')
<script type="text/javascript">
     $(document).ready(function () {
            $('#customer-table').DataTable({
                processing: true,
                serverSide: true,
                "ordering": false,
                "columnDefs": [
                    { "orderable": false, "targets": -1 }
                ],
                ajax: '/admin/customers',
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex', searchable:false },
                    { data: 'full_name', name: 'full_name' },
                    { data: 'email', name: 'email' },
                    { data: 'phone_number', name: 'phone_number' },
                    { data: 'order_count', name: 'order_count',searchable:false },
                    { data: 'cart_count', name: 'cart_count' , searchable:false},
                    { data: 'is_guest', name: 'is_guest' },
                    { data: 'created_at', name: 'created_at' },
                    { data: 'action', name: 'action' },
                ]
            });
    })
</script>
@endpush
@endsection
