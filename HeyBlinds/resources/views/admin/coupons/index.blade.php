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
                        <li class="breadcrumb-item active" aria-current="page">All Coupons</li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="row pb-4">
            <div class="col-sm-6 text-white my-auto">
                <h3 class="mb-0">All Coupons</h3>
            </div>


            <div class="col-sm-6 pt-3 pt-lg-0 my-auto d-flex justify-content-sm-end">
                <!-- <button class="btn btn-light">New view</button> -->
                <a class="btn btn-primary d-flex align-items-center ms-2" href="{{ route('admin.coupons.create') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-plus" viewBox="0 0 16 16">
                        <path
                            d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z" />
                    </svg>
                    <span class="d-none d-md-block">Create new Coupon</span>
                </a>
            </div>

        </div>

        <div class="bg-white rounded page-height mt-3 shadow position-relative">

            @if(Session::has('message'))
            <p class="alert alert-info my-4">{{ Session::get('message') }}</p>
            @endif

            <div class="p-4">
                <div class="row">
                    <div class="col-lg-12">
                        <div id="productaccordion">
                            <table class="table table-responsive table-striped table-bordered text-center" id="coupon-table">
                                <thead class="text-white bg-secondary">
                                    <tr>
                                        <td>#</td>
                                        <td>Coupon Name</td>
                                        <td>Coupon Code</td>
                                        <td>Start Date</td>
                                        <td>End Date</td>
                                        <td>Amount</td>
                                        <td>Icon</td>
                                        <td>Status</td>
                                        <td>Action</td>
                                    </tr>
                                </thead>
                                
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@push('js')
<script>
        $(function() {
            $('#coupon-table').DataTable({
                processing: true,
                serverSide: true,
                searching: true,
                language: {
                    searchPlaceholder: "Coupon name or Code"
                },
                ordering : false,
                ajax: '/admin/coupons',
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex',searchable: false },
                    { data: 'name', name: 'name' },
                    { data: 'code', name: 'code' },
                    { data: 'start_date', name: 'start_date',searchable: false},
                    { data: 'end_date', name: 'end_date',searchable: false },
                    { data: 'amount', name: 'amount' },
                    { data: 'icon', name: 'icon' },
                    { data: 'is_active', name: 'is_active' },
                    { data: 'action', name: 'action' },
                ],
                
            });
        });
    </script>
    <script type="text/javascript">
     function deleteCoupon(id) {
            if (!confirm('Are you sure you want to delete this item')) return false;
            axios.delete(`/admin/coupons/${id}`).then((response)=>{
                if(response.data.status ===true){
                    $('#coupon-table').DataTable().ajax.reload();
                    toastr.success('Successfully deleted!');
                }
            })
            return true;
        }
    </script>

   @endpush              

@endsection
