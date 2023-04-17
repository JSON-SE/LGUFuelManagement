@extends('layouts.Backend.admin.admin')
@section('content')
<div class="container-fluid px-lg-5 px-md-4 pb-5 pt-lg-3">
    <div class="row pt-4">
        <div class="col-12">
            <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='white'/%3E%3C/svg%3E&#34;);"
                 aria-label="breadcrumb">
                <ol class="breadcrumb mb-2">
                    <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Super Sub-categories</li>
                   
                </ol>
            </nav>
        </div>
    </div>
    <div class="row pb-4">
        <div class="col-sm-6 text-white my-auto">
            <h3 class="mb-0">All Super Sub-categories</h3>
        </div>
        <div class="col-sm-6 pt-3 pt-lg-0 my-auto d-flex justify-content-sm-end">
            <!-- <button class="btn btn-light">New view</button> -->
            <a href="{{route('admin.super-subcategory.create')}}" class="btn btn-primary d-flex align-items-center">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                     class="bi bi-plus" viewBox="0 0 16 16">
                    <path
                        d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z" />
                </svg>
                <span class="d-none d-md-block">Create new super sub-category</span>
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
                    <div class="table-responsive">
                    <table id="productaccordion" class="table table-hover ">
                        <thead class="text-white bg-secondary">
                            <tr >
                                <th>#</th>
                                <th>Super Sub-category Name</th>
                                <th>Slug</th>
                                <th>Category</th>
                                <th >Count</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                       
                        <tbody id="sortable" class="product-option-list ui-sortable sortable">
                             @if($supSubcategories->count() > 0)
                            @foreach($supSubcategories as $key => $supSubcategory)
                                <tr class=" ui-state-default ui-sortable-handle" id="item-{{$supSubcategory->id}}">
                                <td>
                                    {{$key+1}}
                                </td>
                                <td>
                                    <div class="fw-bold">{{$supSubcategory->name ?? ''}}</div>
                                </td>
                                <td>{{$supSubcategory->slug ?? ''}}</td>
                                <td>{{$supSubcategory->category->name ?? ''}}</td>
                                <td>0</td>
                                    <td>
                                        <form class="d-flex" action="{{route('admin.super-subcategory.destroy', $supSubcategory->id)}}" method="post">
                                            @csrf
                                            @method('DELETE')
                                          {{--   <a href="{{route('frontend.super-subcategory', $supSubcategory->slug)}}" class="btn btn-sm text-primary" target="_blank">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" class="bi bi-pencil-square" >
                                                    <path d="M15 12c0 1.654-1.346 3-3 3s-3-1.346-3-3 1.346-3 3-3 3 1.346 3 3zm9-.449s-4.252 8.449-11.985 8.449c-7.18 0-12.015-8.449-12.015-8.449s4.446-7.551 12.015-7.551c7.694 0 11.985 7.551 11.985 7.551zm-7 .449c0-2.757-2.243-5-5-5s-5 2.243-5 5 2.243 5 5 5 5-2.243 5-5z"/></svg>
                                            </a> --}}
                                            <a href="{{route('admin.super-subcategory.edit', $supSubcategory->slug ?? '')}}" class="btn btn-sm text-primary">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                                    <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456l-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"></path>
                                                    <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"></path>
                                                </svg>
                                            </a>
                                            <button type="submit" class="btn btn-sm " onclick="return confirm('Are you sure you want to delete this item?');">
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
                              @else
                              <tr>
                                 <td colspan="5" align="tex-center">
                                    <div class="fw-bold"> Super category noy found yet.</div>
                                </td>
                            </tr>
                       
                        @endif
                        </tbody>
                      

                    </table>
                </div>
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
                            "t" : "categories",
                        },
                        type: 'POST',
                        url: '{{route('global.sort')}}'
                    });
                }
            });
            $('#productaccordion').DataTable({
            processing: true,
            searching :true,
            ordering : false,
            });
        })
    </script>
@endsection

