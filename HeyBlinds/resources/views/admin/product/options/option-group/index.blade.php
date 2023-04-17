@extends('layouts.Backend.admin.admin')
@section('content')
    <div class="container-fluid px-lg-5 px-md-4 pb-5 pt-lg-3">
        <div class="row pt-4">
            <div class="col-12">
                <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='white'/%3E%3C/svg%3E&#34;);"
                     aria-label="breadcrumb">
                    <ol class="breadcrumb mb-2">
                        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">All Option Groups</li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="row pb-4">
            <div class="col-sm-6 text-white my-auto">

                <h3 class="mb-0">Option Groups</h3>
            </div>
            <div class="col-sm-6 pt-3 pt-lg-0 my-auto d-flex justify-content-sm-end">
                <!-- <button class="btn btn-light">New view</button> -->
                <a href="{{route('admin.product.option.group.create')}}" class="btn btn-primary d-flex align-items-center ms-2">
                    <span class="d-none d-md-block">Add Option Group</span>
                </a>
            </div>
        </div>
        <div class="bg-white rounded page-height mt-3 shadow">
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            <div class="p-4">
                <div class="table-responsive mt-2">
                    <table class="table colourtable">
                        <thead class="text-white bg-secondary">
                        <tr>
                            <th scope="col py-2">#</th>
                            <th scope="col py-2">Group Name</th>
                            <th scope="col py-2">Group Heading</th>
                            <th scope="col py-2">Group Image</th>
                            <th scope="col py-2">Status</th>
                            <th scope="col py-2">Action</th>
                        </tr>
                        </thead>
                        <tbody class="sortable">
                        @if(!empty($optionGroups))
                            @foreach($optionGroups as $key => $group)
                                <tr class="colour-row align-middle {{$group->is_enabled != 1 ? "bg-light-danger" : ""}}" id="item-{{$group->id}}">
                                    <th scope="row">{{$key+1}}</th>
                                    <td>{{!empty($group->name) ? $group->name : ""}}</td>
                                    <td>{{!empty($group->group_heading) ? $group->group_heading : ""}}</td>
                                    <td><div class="table-colour-imge"><img src="{{!empty($group->media_id) ? $helpers->getThumbnail($group->media_id) : asset('images/thumbnail/no-image.jpg') }}" alt=""/> </div></td>
                                    <td>{{!empty($group->is_enabled) && $group->is_enabled == 1 ? "Active" : "Inactive"}}</td>
                                    <td>
                                        <form action="{{ route('admin.product.option.group.destroy', $group->id)}}" method="post">
                                            <a href="{{route('admin.product.option.group.edit', $group->slug)}}" class="btn btn-sm text-primary">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                                    <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456l-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                                    <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                                                </svg>
                                            </a>
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-sm " onclick="return confirm('Are you sure you want to delete this item?');">
                                                <div class="text-secondary">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                                        <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"></path>
                                                        <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"></path>
                                                    </svg>
                                                </div>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        jQuery(function($) {
            $( ".sortable" ).sortable({
                stop: function (event, ui) {
                    var data = $(this).sortable('serialize');
                    console.log(data);
                    $.ajax({
                        data: {
                            "data" : data,
                            "where" : "id",
                            "t" : "option_groups",
                        },
                        type: 'POST',
                        url: '{{route('global.sort')}}'
                    });
                }
            });

        })
    </script>
@endsection
