@extends('layouts.Backend.admin.admin')
@section('content')
    <div class="container-fluid px-lg-5 px-md-4 pb-5 pt-lg-3">

        <form action="{{route('admin.product.option.group.update', $group->slug)}}" method="post" enctype="multipart/form-data">
            @csrf
            @method('put')
            <div class="row pt-4">
                <div class="col-12">
                    <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='white'/%3E%3C/svg%3E&#34;);"
                         aria-label="breadcrumb">
                        <ol class="breadcrumb mb-2">
                            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Edit Option Group</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <div class="row pb-4">
                <div class="col-sm-6 text-white my-auto">

                    <h3 class="mb-0">Edit: {{$group->name}}</h3>
                </div>
                <div class="col-sm-6 pt-3 pt-lg-0 my-auto d-flex justify-content-sm-end">
                    <a href="{{route('admin.product.option.group.index')}}" class="btn btn-primary d-flex align-items-center ms-2">
                        <span class="d-none d-md-block">All Option Groups</span>
                    </a>
                    <a href="{{route('admin.product.option.group.create')}}" class="btn btn-primary d-flex align-items-center ms-2">
                        <span class="d-none d-md-block">Add Option Group</span>
                    </a>

                </div>
            </div>
            <div class="bg-white rounded page-height mt-3 shadow position-relative pb-5">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="p-4 pt-3">
                    <div class="justify-content-center">
                        <div class="color-records pb-3">
                            <div class="row">
                                <div class="col-lg-12 col-xl-12">
                                    <div class="row gx-2">
                                        <div class="col-lg-3 ">
                                            <label for="group_name" class="pb-2">Group Name<span class="text-danger">*</span></label>
                                            <input type="text" name="name" class="form-control" id="group_name" value="{{!empty(old('name')) ? old('name') : $group->name}}"
                                                   placeholder="Enter option group name">
                                        </div>
                                        <div class="col-lg-3 ">
                                            <label for="group_heading" class="pb-2">Group Heading<span class="text-danger">*</span></label>
                                            <select type="text" name="group_heading" class="form-control" id="group_heading">
                                                <option value="" >Enter Group Heading</option>
                                                @foreach($groupNames as $groupName)
                                                    <option value="{{$groupName->group_heading}}" {{$group->group_heading === $groupName->group_heading ? "selected" : ""}} >{{$groupName->group_heading}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-lg-3 col-md-2 col-sm-6 col-6 ">
                                            <div class="row">
                                                <div class="col-lg-10">
                                                    <div class="h-100 pb-4">
                                                        <label class="mb-2">Featured Image</label>
                                                        <div class="fallback">
                                                            <input name="image" class="form-control" type="file" value="{{old('image')}}" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-2 my-auto">
                                                    <img class="img-fluid thumb" src="{{asset($helper->getThumbnail($group->media_id))}}" alt="">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-1 my-auto">
                                            <div class="check-box ms-4">
                                                <input type="checkbox" id="is_enable" name="is_enabled"
                                                       value="1" {{!empty(old('is_enabled')) && old('is_enabled') == 1 ||  !empty($group->is_enabled) && $group->is_enabled ? "checked": (old('is_enabled') == 0 ? "" : "checked")}}>
                                                <label for="is_enable">Enable</label>
                                            </div>
                                        </div>
                                        <div class="col-lg-2 my-auto">
                                            <div class="check-box ms-4">
                                                <input type="checkbox" id="show_group_name" name="show_group_name"
                                                       value="1" {{!empty(old('show_group_name')) && old('show_group_name') == 1 ||  !empty($group->show_group_name) && $group->show_group_name ? "checked": (old('show_group_name') == 0 ? "" : "checked")}} >
                                                <label for="show_group_name">Show Group Name</label>
                                            </div>
                                        </div>
                                        <div class="col-lg-12 col-md-6 col-sm-6 col-6 mt-3">
                                            <label for="body-content">Group Info</label>
                                            <div class="mt-2 pe-4">
                                                <textarea name="content" id="body-content" cols="2" rows="2" class="summernote">{{!empty(old('content')) ? old('content') : $group->content}}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row justify-content-end">
                                        <div class="col-lg-12 ">
                                            <button class="btn btn-primary mt-4">
                                                Update Options Group
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    </section>
@endsection
@section('scripts')
    <script>
        jQuery(function ($) {
            $("#group_heading").select2({
                tags: true,
            });
        })
    </script>
@endsection
