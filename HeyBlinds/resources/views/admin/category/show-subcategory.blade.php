@extends('layouts.Backend.admin.admin')
@section('content')
<div class="container-fluid px-lg-5 px-md-4 pb-5 pt-lg-3">
    <div class="row pt-4">
        <div class="col-12">
            <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='white'/%3E%3C/svg%3E&#34;);"
                 aria-label="breadcrumb">
                <ol class="breadcrumb mb-2">
                    <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Sub-Categories</li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="row pb-4">
        <div class="col-sm-6 text-white my-auto">
            <h3 class="mb-0">Sub-Categories</h3>
        </div>
        <div class="col-sm-6 pt-3 pt-lg-0 my-auto d-flex justify-content-sm-end">

            <a href="{{route('admin.sub.category.create')}}" class="btn btn-primary d-flex align-items-center">
                <span class="">Create new Sub-Category</span>
            </a>
        </div>
    </div>
    <div class="bg-white rounded page-height mt-3 shadow position-relative">
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <div class="p-lg-4 p-3">
            <div class="row">
                <div class="col-lg-12">
                    <table id="productaccordion" class="table table-striped table-hover">
                        <thead class="product-option-list text-white bg-secondary">
                            <tr class="heading-list">
                                <th>#</th>
                                <th>Sub-Category Name</th>
                                <th>Parent Category Name</th>
                                <th>Super Sub-category Name</th>
                                <th>Slug</th>
                                <th>Count</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="sortable" class="product-option-list ui-sortable sortable">
                            @foreach($categories as $key => $category)
                                <tr class=" ui-state-default ui-sortable-handle" id="item-{{$category->id}}">
                                <td>
                                    {{$key+1}}
                                </td>
                                <td>
                                    <div class="fw-bold">{{$category->name}}</div>
                                </td>
                                <td>{{$category->category->name ?? ""}}</td>

                                <td>{{$category->superSubcategory->name ?? '--'}}</td>
                                <td>{{$category->slug}}</td>

                                <td>{{count($category->product)}}</td>
                                    <td>
                                        <form action="{{route('admin.sub.category.destroy', $category->id)}}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <a href="{{route('admin.sub.category.edit', $category->slug)}}" class="btn btn-sm text-primary">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                                    <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456l-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"></path>
                                                    <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"></path>
                                                </svg>
                                            </a>
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
                        </tbody>
                    </table>
                </div>
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
                            "t" : "sub_categories",
                        },
                        type: 'POST',
                        url: '{{route('global.sort')}}'
                    });
                }
            });

        })
    </script>
@endsection
