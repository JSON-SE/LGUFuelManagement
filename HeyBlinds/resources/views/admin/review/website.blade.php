@extends('layouts.Backend.admin.admin')

@section('content')
<section id="body-content" class="">
    <div class="container-fluid px-lg-5 px-md-4 pb-5 pt-lg-3">
        <div class="row pt-4">
            <div class="col-12">
                <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='white'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
                    <ol class="breadcrumb mb-2">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Site Review</li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="row pb-4">
            <div class="col-sm-6 text-white my-auto">

                <h3 class="mb-0">All Website Reviews</h3>
            </div>
        </div>
         {{-- <div class="col-md-12 text-md-end">
                <a  class="btn btn-primary h-100 px-4" id="download" href="{{url('/admin/subcariber/subcariber-export')}}">Export</a>
            </div> --}}

            <div class="bg-white rounded page-height mt-3 shadow">
                <div class="p-lg-4 p-3">
                    <div class="row gx-3 pb-2">
                        @include('partial.message')
                    </div>

                    <div class="table-responsive mt-2">
                        <table class="table table-striped w-100" id="website-review-table">
                            <thead class="text-white bg-secondary">
                                <tr>
                                    <th> # </th>
                                    <th>Review Date</th>
                                    <th>Rating</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>City</th> 
                                    <th>Province</th>
                                     <th>Title Review</th>
                                    <th>Review</th>
                                    <th>Suggestions</th>
                                    <th>Live </th>
                                    <th>HP </th>
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
    </section>

    @push('js')
    <script>
        $(function () {
            $('#website-review-table').DataTable({
                processing: true,
                serverSide: true,
                ordering : false,
                "iDisplayLength": 100,
                ajax: {
                    method : "POST",
                    url: '/admin/review-of-website',
                },
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex',searchable:false },
                    { data: 'created_at', name: 'created_at' },
                    { data: 'rating_point', name: 'rating_point' },
                    { data: 'name', name: 'name' },
                    { data: 'email', name: 'email' },
                    { data: 'city', name: 'city' },
                    { data: 'province', name: 'province' },
                    { data: 'title_review', name: 'title_review' },
                    { data: 'review', name: 'review' },
                    { data: 'customer_suggestion', name: 'customer_suggestion',searchable:false },
                    { data: 'status', name: 'status' },
                    { data: 'hp_status', name: 'hp_status' },
                    {data: 'action', name: 'action'}
                ],
                'columnDefs': [
                {
                    "targets": 8, // your case first column
                    "className": "text-start",
                    "width": "35%"
                },
           ],
            })
        });
    </script>
    <script type="text/javascript">
       function checkedUnchecked (review_id) {
           const checked = $("#review_status").is(":checked");  
           axios.post(`/admin/review/status-active`,{
                review_id: review_id,
                is_active : checked
           }).then((response) => {
           }).catch((errors) =>{

           })
        }
        function checkedUncheckedForHomePage(review_id){
            const checked = $("#show_home_page").is(":checked");  
           axios.post(`/admin/review/show-home-page`,{
                review_id: review_id,
                is_active : checked
           }).then((response) => {
           }).catch((errors) =>{

           })
        }
        function reviewDelete(id){
            if (!confirm('Are you sure you want to delete this item')) return false;
            axios.delete(`/admin/review/delete/${id}`).then((response)=>{
                if(response.data.status ===true){
                    $('#website-review-table').DataTable().ajax.reload();
                }
            })
            return true;
        }
    </script>
    @endpush
    @endsection