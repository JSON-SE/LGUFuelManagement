@extends('layouts.Backend.admin.admin')

@section('content')
<section id="body-content" class="">
    <div class="container-fluid px-lg-5 px-md-4 pb-5 pt-lg-3">
        <div class="row pt-4">
            <div class="col-12">
                <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='white'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
                    <ol class="breadcrumb mb-2">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Comments Reply</li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="row pb-4">
            <div class="col-sm-6 text-white my-auto">
                <h3 class="mb-0">Comments Reply</h3>
            </div>
        
        {{-- <div class="col-sm-6 pt-3 pt-lg-0 my-auto d-flex justify-content-sm-end">
            <!-- <button class="btn btn-light">New view</button> -->
            <a href="{{route('admin.blog.index')}}" class="btn btn-primary d-flex align-items-center">
                
                <span class="d-none d-md-block">All Blog</span>
            </a>
        </div> --}}
        </div>
        <div class="bg-white rounded page-height mt-3 shadow">
            <div class="p-lg-4 p-3">
                <div class="row gx-3 pb-2">
    
                </div>

                <div class="table-responsive mt-2">
                    <table class="table table-striped w-100" id="reply-table">
                        <thead class="text-white bg-secondary">
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Comments</th>
                                <th>Live</th>
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
        var comment_id = '{{$comment->id}}';
            $('#reply-table').DataTable({

                processing: true,
                serverSide: true,
                ordering : false,
                ajax: `/admin/comment/${comment_id}/reply`,
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex',searchable:false },
                    { data: 'name', name: 'name' },
                    { data: 'email', name: 'email' },
                    { data: 'comment', name: 'comment' },                 
                    { data: 'status', name: 'status' },
                    { data: 'action', name: 'action' },
                ]
        });

    });
</script>
<script type="text/javascript">
    function checkedUnchecked(id){
        axios.post(`/admin/blog/comment/reply/status/${id}`)  
    }
</script> 

@endpush
@endsection
