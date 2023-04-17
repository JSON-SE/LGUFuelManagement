@extends('layouts.Backend.admin.admin')

@section('content')
<section id="body-content" class="">
    <div class="container-fluid px-lg-5 px-md-4 pb-5 pt-lg-3">
        <div class="row pt-4">
            <div class="col-12">
                <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='white'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
                    <ol class="breadcrumb mb-2">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">All Blogs</li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="row pb-4">
            <div class="col-sm-6 text-white my-auto">
                <h3 class="mb-0">Blogs</h3>
            </div>
        
        <div class="col-sm-6 pt-3 pt-lg-0 my-auto d-flex justify-content-sm-end">
            <!-- <button class="btn btn-light">New view</button> -->
            <a href="{{route('admin.blog.create')}}" class="btn btn-primary d-flex align-items-center">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                     class="bi bi-plus" viewBox="0 0 16 16">
                    <path
                        d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z" />
                </svg>
                <span class="d-none d-md-block">Create new blog</span>
            </a>
        </div>
        </div>
        <div class="bg-white rounded page-height mt-3 shadow">
            
            <div class="p-lg-4 p-3">
                @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
            @endif

                <div class="table-responsive mt-2">
                    <table class="table table-striped w-100" id="blog-table">
                        <thead class="text-white bg-secondary">
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Image</th>
                                <th>Created Date</th>
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
            $('#blog-table').DataTable({
                processing: true,
                serverSide: true,
                ordering : false,
                ajax: {
                    method : "GET",
                    url: '/admin/blog',
                },
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex',searchable:false },
                    { data: 'name', name: 'name' },
                    { data: 'image', name: 'image' },
                    { data: 'created_at', name: 'created_at' },
                    { data: 'status', name: 'status' },
                    { data: 'action', name: 'action' },
                ]
        });

    });
</script>
<script type="text/javascript">
    function checkedUnchecked(id){
        axios.post(`/admin/blog/status/${id}`)  
    }
    function deleteBlog(id) {
        if (!confirm('Are you sure you want to delete this item')) return false;
            axios.delete(`/admin/blog/${id}`).then((response)=>{
                if(response.data.status ===true){
                    $('#blog-table').DataTable().ajax.reload();
                    toastr.success('Successfully deleted!');
                }
            })
            return true;
        }
</script>
@endpush
@endsection
