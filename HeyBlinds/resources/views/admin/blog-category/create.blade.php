@extends('layouts.Backend.admin.admin')
@section('content')
<div class="container-fluid px-lg-5 px-md-4 pb-5 pt-lg-3">
    <div class="row pt-4">
        <div class="col-12">
            <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='white'/%3E%3C/svg%3E&#34;);"aria-label="breadcrumb">
                <ol class="breadcrumb mb-2">
                    <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Add Category</li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="row pb-4">
        <div class="col-sm-6 text-white my-auto">
            <h3 class="mb-0">Create Category</h3>
        </div>
        <div class="col-sm-6 pt-3 pt-lg-0 my-auto d-flex justify-content-sm-end">
            <!-- <button class="btn btn-light">New view</button> -->
            <a href="{{route('admin.blog-category.index')}}" class="btn btn-primary d-flex align-items-center">
                <span class="">All Categories</span>
            </a>
        </div>

    </div>
    
    <form action="{{route('admin.blog-category.store')}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="bg-white rounded page-height mt-3 shadow position-relative pb-5">
            <div class="p-lg-4 p-3 pb-5">
                @include('partial.message')
                <div class="tab-content">
                    <div class="pt-2">
                        <div class="row gx-2">
                            <div class="col-lg-6 mb-3">
                                <div class="">
                                    <label for="name">Category Name<span class="text-primary">*</span></label>
                                    <input type="text" class="form-control" id="name" name="name" placeholder="Category Name" value="{{old('name')}}">
                                    
                                </div>
                            </div>
                            
                            <div class="col-lg-3 mb-3">
                                <div class="">
                                    <label for="status">Status<span class="text-primary">*</span></label>
                                    <select class="form-select form-control" name="status" id="status">\
                                        <option value="">Select Status</option>
                                        <option value=1>Active</option>
                                        <option value=0>Inactive</option>
                                      </select>
                                </div>
                            </div>
                            
                        
                        </div>
                    </div>
                    <div class="px-4 pb-4 text-end tab-btn-position">
                        <a href="{{route('admin.blog-category.index')}}" class="btn btn-danger">Back</a>
                        <button class="btn btn-success save-data"  type="submit">Submit</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@push('js')
<script type="text/javascript">
</script>
@endpush

@endsection


