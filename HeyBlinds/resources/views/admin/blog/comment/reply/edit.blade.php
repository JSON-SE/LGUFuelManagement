@extends('layouts.Backend.admin.admin')
@section('content')
<div class="container-fluid px-lg-5 px-md-4 pb-5 pt-lg-3">
    <div class="row pt-4">
        <div class="col-12">
            <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='white'/%3E%3C/svg%3E&#34;);"aria-label="breadcrumb">
                <ol class="breadcrumb mb-2">
                    <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Edit Reply</li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="row pb-4">
        <div class="col-sm-6 text-white my-auto">
            <h3 class="mb-0">Edit Reply</h3>
        </div>
        <div class="col-sm-6 pt-3 pt-lg-0 my-auto d-flex justify-content-sm-end">
            <!-- <button class="btn btn-light">New view</button> -->
            <a href="{{route('admin.blog.index')}}" class="btn btn-primary d-flex align-items-center">
                <span class="">All Blogs</span>
            </a>
        </div>

    </div>
    @include('partial.message')
    <form action="{{ route('admin.reply.update',[$comment_id, $replay->id])}}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')        
        
        <div class="bg-white rounded page-height mt-3 shadow position-relative pb-5">
            <div class="p-lg-4 p-3 pb-5">
                <div class="tab-content">
                    <div class="pt-2">
                        <input type="hidden" name="comment_id" value="{{ $comment_id }}">
                        <div class="col-12">
                            <div class="form-floating">
                                <textarea class="form-control"
                                    style="height: 100px" data-placeholder="Leave a reply here"
                                    name="comment" id="floatingTextarea" required>{{ $replay->comment }}</textarea>
                                <label for="floatingTextarea">Reply<span class="text-primary">*</span></label>
                            </div>
                        </div>
                    </div>
                    <div class="px-4 pb-4 text-end tab-btn-position">
                        <a href="{{route('admin.blog.index')}}" class="btn btn-danger">Back</a>
                        <button class="btn btn-success save-data"  type="submit">Send</button>
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


