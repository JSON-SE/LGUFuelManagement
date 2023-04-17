@extends('layouts.Backend.admin.admin')
@section('content')
    <div class="container-fluid px-lg-5 px-md-4 pb-5 pt-lg-3">
        <div class="row pt-4">
            <div class="col-12">
                <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='white'/%3E%3C/svg%3E&#34;);"
                     aria-label="breadcrumb">
                    <ol class="breadcrumb mb-2">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">All Colour Groups</li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="row pb-4">
            <div class="col-sm-6 text-white my-auto">

                <h3 class="mb-0">All Colour Groups</h3>
            </div>
        </div>
        <div class="bg-white rounded page-height mt-3 shadow">
            <div class="p-4">
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                <form action="{{route('admin.color.group.store')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="pt-2 justify-content-center">
                        <div class="color-records pb-3">
                            <div class="row">
                                <div class="col-lg-12 col-xl-12">
                                    <div class="row gx-2">
                                        <div class="col-12"><h5>Add a New Colour Group</h5></div>
                                        <div class="col-lg-5  col-sm-6">
                                            <div class="form-floating mt-3">
                                                <input type="text" class="form-control" id="name" name="name"
                                                       placeholder="Colour Colour Name *">
                                                <label for="name">Colour Group Name <span class="text-primary">*</span></label>
                                            </div>
                                        </div>
                                        <div class="col-lg-4  col-sm-6 col-6">
                                            <div class="input-group mt-3">
                                                <input type="file" id="image" name="image" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-lg-2 ps-3 mt-4">
                                            <div class="check-box d-inline-block ">
                                                <input type="checkbox" id="is_enabled" name="is_enabled"
                                                       value="1" checked>
                                                <label for="is_enabled">Enable</label>
                                            </div>
                                        </div>
                                        <div class="col-lg-1 col-md-3 col-sm-6 col-6 mt-3">
                                            <button class="btn h-100 btn-primary btn-sm pe-3 d-flex align-items-center add-more-color ms-auto">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                                     class="bi bi-plus" viewBox="0 0 16 16">
                                                    <path
                                                        d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z" />
                                                </svg>
                                                <span class="d-none d-md-block save-data">Save</span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>

                <div class="table-responsive mt-2">
                    <table class="table colourtable">
                        <thead class="text-white bg-secondary">
                        <tr>
                            <th scope="col py-2">#</th>
                            <th scope="col py-2">Group Name</th>
                            <th scope="col py-2">Group Image</th>
                            <th scope="col py-2">Color Count</th>
                            <th scope="col py-2">Status</th>
                            <th scope="col py-2">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(!empty($colorGroups))
                            @foreach($colorGroups as $key => $group)
                                <tr class="colour-row align-middle {{$group->is_enabled != 1 ? "bg-light-danger" : ""}}">
                                    <th scope="row">{{$key+1}}</th>
                                    <td>{{$group->name}}</td>
                                    <td class="text-center"><div class="table-colour-imge"><img class="img-fluid thumb" src="{{$helpers->getThumbnail($group->media_id)}}" alt=""/> </div></td>
                                    <td>{{count($group->colors)}}</td>
                                    <td>{{$group->is_enabled == 1 ? "Active" : "Inactive"}}</td>
                                    <td>
                                        <form action="{{ route('admin.color.group.destroy', $group->id)}}" method="post">
                                        <a href="{{route('admin.color.group.edit', $group->slug)}}" class="btn btn-sm text-primary">
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
        axios.defaults.withCredentials = true;
        function html(data) {
            var html = "";
            if (data != undefined && data != null && data != ""){
                $count = $(".colourtable tbody tr");
                html =`<tr class="colour-row align-middle">
                            <th scope="row">${$count.length+1}</th>
                            <td>${data.name}</td>
                            <td><div class="table-colour-imge"><img src="${data.image != undefined ? data.image : '/images/thumbnail/no-image.jpg'}" alt=""/> </div></td>
                            <td>0</td>
                           <td>${data.is_enabled == 1 ? 'Active' : "Inactive"}</td>
                            <td>
                                <form action="${location.href}/${data.id}" method="post">
                                <a href="${location.href}/edit/${data.slug}" class="btn btn-sm text-primary">
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
                        </tr>`;
            }
            return html;
        }

        $(document).ready(function () {
            $(document).on('click', '.save-data', function (e) {
                e.preventDefault();
                $("#loader").show();
                let $this = $(this);
                let form = $this.parents('form');
                var formData = new FormData(form[0]);
                axios({
                    method: 'post',
                    url: form.attr('action'),
                    data: formData,
                }).then(function (response) {
                    $("#loader").hide();
                    form[0].reset();
                    $(".colourtable tbody").append(html(response.data));

                }).catch(function (error) {
                    $("#loader").hide();
                    let errors = error.response.data.errors;
                    $.each(errors, function (key, value) {
                        toastr.error(value)
                    })
                });
            })
        })
    </script>
@endsection
