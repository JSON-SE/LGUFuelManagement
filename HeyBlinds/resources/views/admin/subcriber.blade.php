@extends('layouts.Backend.admin.admin')

@section('content')
<section id="body-content" class="">
    <div class="container-fluid px-lg-5 px-md-4 pb-5 pt-lg-3">
        <div class="row pt-4">
            <div class="col-12">
                <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='white'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
                    <ol class="breadcrumb mb-2">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Subscriber</li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="row pb-4">
            <div class="col-sm-6 text-white my-auto">
                <h3 class="mb-0">All Subcribers</h3>
            </div>
        </div>
         <div class="col-md-12 text-md-end">
                <a  class="btn btn-primary h-100 px-4" id="download" href="{{url('/admin/subcariber/subcariber-export')}}">Export</a>
        </div>

        <div class="bg-white rounded page-height mt-3 shadow">
            <div class="p-lg-4 p-3">
                <div class="row gx-3 pb-2">
        
                </div>

                <div class="table-responsive mt-2">
                    <table class="table table-striped w-100" id="subcriber-table">
                        <thead class="text-white bg-secondary">
                            <tr>
                                <th> #</th>
                                <th>Customer Email</th>
                                <th>Created Date</th>
                            </tr>
                        </thead>
                        <tbody >
                         
                        </tbody>

                    </table>
                </div>

            </div>
        </div>
    </div>
</section>

@push('js')

<script>
    $(document).ready(function () {
            $('#subcriber-table').DataTable({
                processing: true,
                serverSide: true,
                ordering : false,
                ajax: '/admin/subcriber',

                columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex' },
                { data: 'email', name: 'email' },
                { data: 'created_at', name: 'created_at' },
                ]
        });

        $('#date_range').daterangepicker({
            autoUpdateInput: false,
            locale: {
                cancelLabel: 'Clear'
            }
        });

        $('#date_range').on('apply.daterangepicker', function(ev, picker) {
            $(this).val(picker.startDate.format('MM/DD/YYYY') + ' - ' + picker.endDate.format('MM/DD/YYYY'));
        });

        $('#date_range').on('cancel.daterangepicker', function(ev, picker) {
            $(this).val('');
        });

    });
</script>
@endpush
@endsection
