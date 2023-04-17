@extends('layouts.Backend.admin.admin')
@section('content')
    <form action="{{route('admin.color.group.update', $group->slug)}}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="container-fluid px-lg-5 px-md-4 pb-5 pt-lg-3">
            <div class="row pt-4">
                <div class="col-12">
                    <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='white'/%3E%3C/svg%3E&#34;);"
                         aria-label="breadcrumb">
                        <ol class="breadcrumb mb-2">
                            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Edit Colour Group</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <div class="row pb-4">
                <div class="col-sm-6 text-white my-auto">

                    <h3 class="mb-0">Edit: {{$group->name}}</h3>
                </div>
                <div class="col-sm-6 pt-3 pt-lg-0 my-auto d-flex justify-content-sm-end">
                    <a href="{{route('admin.color.group.index')}}" class="btn btn-primary d-flex align-items-center ms-2">
                        <span class="d-none d-md-block">Add new Group</span>
                    </a>

                </div>
            </div>
            <div class="bg-white rounded page-height mt-3 shadow">
                <div class="p-4">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="pt-2 justify-content-center">
                        <div class="color-records pb-3">
                            <div class="row">
                                <div class="col-lg-12 col-xl-12">
                                    <div class="row gx-2">
                                        <!-- <div class="col-12"><h5>Edit {{$group->name}}</h5></div> -->
                                        <div class="col-lg-5">

                                            <div class="form-floating mt-3">
                                                <input type="text" class="form-control" id="name" name="name"
                                                       placeholder="Colour Group Name *" value="{{$group->name}}">
                                                <label for="name">Colour Group Name <span class="text-primary">*</span></label>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-3 col-sm-6 col-6">
                                            <div class="row">
                                                <div class="col-lg-10">
                                                <div class="upload-group input-group mt-3">
                                                    <label class="input-group-text">Group Image</label>
                                                    <input class="file-name form-control" type="text" placeholder="Browse" readonly="" >
                                                    <input type="file" id="image" name="image">
                                                    <label class="upload-btn" for="image">
                                                    </label>
                                                </div>
                                                </div>
                                                <div class="col-lg-2 my-auto">
                                                <img class="img-fluid " src="{{!empty($group->media_id) ? $helpers->getThumbnail($group->media_id) : asset('images/thumbnail/no-image.jpg') }}" alt=""/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-2 ps-3 mt-4">
                                            <div class="check-box d-inline-block ">
                                                <input type="checkbox" id="is_enabled" name="is_enabled"
                                                       value="1" {{!empty($group->is_enabled) && $group->is_enabled == 1 ? "checked" : ""}} >
                                                <label for="is_enabled">Enable</label>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                           <div class="row justify-content-end">
                               <div class="col-lg-2 col-md-3 col-sm-6 col-6 mt-3 ">
                                   <button class="btn h-100 btn-success btn-sm pe-3 d-flex align-items-center add-more-color ms-auto">
                                       <!-- <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                            class="bi bi-plus " viewBox="0 0 16 16">
                                           <path
                                               d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z" />
                                       </svg> -->
                                       <span class="d-none d-md-block save-data">Save</span>
                                   </button>
                               </div>
                               <div class="col-lg-1 col-md-3 col-sm-6 col-6 mt-3 ">
                                   <a href="{{route('admin.color.group.index')}}" class="btn  btn-primary btn-sm pe-3">
                                       <span class="d-none d-md-block save-data">Back</span>
                                   </a>
                               </div>
                           </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
