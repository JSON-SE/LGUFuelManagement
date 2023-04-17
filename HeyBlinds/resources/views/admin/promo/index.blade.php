@extends('layouts.Backend.admin.admin')
@section('content')
    <div class="container-fluid px-lg-5 px-md-4 pb-5 pt-lg-3">
        <div class="row pt-4">
            <div class="col-12">
                <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='white'/%3E%3C/svg%3E&#34;);"
                     aria-label="breadcrumb">
                    <ol class="breadcrumb mb-2">
                        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">All Promos</li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="row pb-4">
            <div class="col-sm-6 text-white my-auto">
                <h3 class="mb-0">All Promos</h3>
            </div>
            <div class="col-sm-6 pt-3 pt-lg-0 my-auto">
                <div class="row justify-content-end">

                   
                    <!-- <button class="btn btn-light">New view</button> -->
                    <div class="col-lg-3 col-md-4">
                        <a href="{{route('admin.promo.create')}}" class="btn btn-primary text-center h-100 d-flex align-items-center justify-content-center">
                            <span class="d-none d-md-block">Create new Promo</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="bg-white rounded page-height mt-3 shadow position-relative">
           @include('partial.message')
           
            <div class="p-lg-4 p-3">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="table-responsive mt-2">
                            <table id="promo-table" class="table table-hover  w-100">
                                <thead class="text-white bg-secondary">
                                <tr >
                                    <th>#</th>
                                    <th>Promo Name</th>
                                    <th>Start Date</th>
                                    <th>End Date</th>
                                    <th>Promo Type</th>
                                    <th>Value</th>
                                    <th>Extra Value</th>
                                    <th>Banner</th>
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
    </div>
@push('js')

<script>
    $(function () {
        var day_range = $('#date_range_promo').val();;
        promoSearch(day_range);
        function promoSearch(date_range = ''){
            $('#promo-table').DataTable({
                processing: true,
                serverSide: true,
                language: {
                    searchPlaceholder: "Promo name"
                },
                ordering : false,
                ajax: {
                    url: '/admin/promo',
                    method: "GET",
                    data:{
                        'date_range' : date_range
                    }
                },
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex',searchable:false},
                    { data: 'name', name: 'name', bSortable: false },
                    { data: 'start_date', name: 'start_date',ordering : true},
                    { data: 'end_date', name: 'end_date' },
                    { data: 'discount_type', name: 'discount_type',bSortable: false },
                    { data: 'amount', name: 'amount',bSortable: false },
                    { data: 'extra_amount', name: 'extra_amount', bSortable: false },
                    { data: 'banner_is', name: 'banner_is', bSortable: false },
                    { data: 'action', name: 'action', bSortable: false },
                ],
            });
        }

        // Date range picker
        $('#date_range_promo').dateRangePicker({
            inline: true,
            format: 'MM-DD-YYYY',
            container: '#ccc',
            alwaysOpen: false,
            showTopbar: true,
            });

    });

</script>
<script type="text/javascript">
     function deletePromo(id) {
            if (!confirm('Are you sure you want to delete this item')) return false;
            axios.delete(`/admin/promo/${id}`).then((response)=>{
                if(response.data.status ===true){
                    $('#promo-table').DataTable().ajax.reload();
                    toastr.success('Successfully deleted!');
                }
            })
            return true;
        }
</script>
@endpush
@endsection


