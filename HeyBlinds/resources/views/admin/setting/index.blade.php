@extends('layouts.Backend.admin.admin')
@section('content')
    <div class="container-fluid px-lg-5 px-md-4 pb-5 pt-lg-3">
        <div class="row pt-4">
            <div class="col-12">
                <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='white'/%3E%3C/svg%3E&#34;);"
                    aria-label="breadcrumb">
                    <ol class="breadcrumb mb-2">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Setting</li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="row pb-4">
            <div class="col-sm-6 text-white my-auto">
                <h3 class="mb-0 add-product-name">Account Setting</h3>
            </div>
            <div class="col-sm-6 pt-3 pt-lg-0 my-auto d-flex justify-content-sm-end">
                <!-- <button class="btn btn-light">New view</button> -->
                <a href="{{ route('admin.product.index') }}" class="btn btn-primary d-flex align-items-center ms-2">
                    <span class="">All Products</span>
                </a>
            </div>
        </div>
        <div class="bg-white rounded page-height mt-3 shadow position-relative pb-5">
            @if ($message = Session::get('success'))
                <div role="alert" class="alert alert-success alert-block alert-dismissible fade show">
                    {{-- <button type="button" class="close" data-dismiss="alert" aria-label="Close">×</button> --}}
                    <strong>{{ $message }}</strong>
                </div>
            @endif
            <div class="p-lg-4 p-3 pb-5">
                <div class="tab-pane fade active show" id="seo" role="tabpanel" aria-labelledby="seo-tab">
                    <div class="pt-5">
                        <form action="{{ route('admin.account.update') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            {{-- @foreach ($errors->all() as $error)
                        <p class="text-danger">{{ $error }}</p>
                    @endforeach --}}
                            <div class="row justify-content-center">
                                <div class="col-7 mt-3">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="email" name="email"
                                            value="{{ $admin_user->email }}" placeholder="Email">
                                        <label for="email">Email</label>
                                        @error('email')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-7 mt-3">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="current_password"
                                            name="current_password" placeholder="Current password "
                                            value="{{ old('current_password') }}">
                                        <label for="current_password">Current password </label>
                                        @error('current_password')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-7 mt-3">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="new_password" name="new_password"
                                            value="{{ old('new_password') }}" placeholder="New Password">
                                        <label for="new_password">New Password</span></label>
                                        @error('new_password')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-7 mt-3">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="new_confirm_password"
                                            name="new_confirm_password" value="{{ old('new_confirm_password') }}"
                                            placeholder="Confrom Password">
                                        <label for="new_confirm_password"> New Confirm Password </span></label>
                                        @error('new_confirm_password')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="px-4 pb-4 text-end tab-btn-position">
                                <button type="submit" class="btn btn-primary info-submit productBasicForm">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
