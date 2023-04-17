@extends('layouts.Backend.admin.admin')
@section('content')
<div class="container-fluid px-lg-5 px-md-4 pb-5 pt-lg-3">
    <div class="row pt-4">
        <div class="col-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-2">
                    <li class="breadcrumb-item">
                        <a href="{{route('admin.dashboard')}}">
                            Home
                        </a>
                    </li>
                    <li aria-current="page" class="breadcrumb-item active">
                        Edit customer
                    </li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="row pb-4">
        <div class="col-sm-6 text-white my-auto">
            <h3 class="mb-0">
                Edit: {{$user->full_name}}
            </h3>
        </div>
        <div class="col-sm-6 pt-3 pt-lg-0 my-auto d-flex justify-content-sm-end">
            <!-- <button class="btn btn-light">New view</button> -->
            <a class="btn btn-primary d-flex align-items-center" href="{{route('admin.customers.index')}}">
                <span class="">
                    All Customer
                </span>
            </a>
        </div>
    </div>
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li class="mt-1">
                {{ $error }}
            </li>
            @endforeach
        </ul>
    </div>
    @endif
    <form action="{{route('admin.customers.update',$user->id)}}" enctype="multipart/form-data" method="post">
        @method('PUT')
        @csrf
        <div class="bg-white rounded page-height mt-3 shadow position-relative pb-5">
            <div class="p-lg-4 p-3 pb-5">
                <ul class="nav nav-tabs product-management-tab" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button aria-controls="basic" aria-selected="true" class="nav-link active" data-bs-target="#basic" data-bs-toggle="tab" id="basic-tab" role="tab" type="button">
                            Customer Basic
                            Information
                        </button>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div aria-labelledby="basic-tab" class="tab-pane fade show active" id="basic" role="tabpanel">
                        <div class="pt-2">
                            <div class="row gx-2">
                                <div class="row">
                                    <div class="col-lg-6 mt-3">
                                        <div class="form-floating">
                                            <input class="form-control" id="first_name" name="first_name" placeholder="Fist Name" type="text" value="{{$user->first_name}}"/>
                                            <label for="name">
                                                First Name
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 mt-3">
                                        <div class="form-floating">
                                            <input class="form-control" id="last_name" name="last_name" placeholder="Last Name" type="text" value="{{$user->last_name}}"/>
                                            <label for="name">
                                                Last Name
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6 mt-3">
                                        <div class="form-floating">
                                            <input class="form-control" id="email" name="email" placeholder="Email" type="text" value="{{$user->email}}" autocomplete="off" />
                                            <label for="name">
                                                Email
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 mt-3">
                                        <div class="form-floating">
                                            <input class="form-control phone_number" id="phone_number" maxlength="16" name="phone_number" placeholder="Phone number" type="text" value="{{$user->profile->phone_number ?? ''}}"/>
                                            <label for="name">
                                                Phone Number
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 mt-3">
                                        <div class="form-floating">
                                            <input class="form-control " id="password"  name="password" placeholder="Password" type="text" value="{{$user->profile->passwod ?? ''}}"/>
                                            <label for="name">
                                                Password
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-2 text-center">
                                        <div class="check-box d-inline-block pt-4 ">
                                            <input type="checkbox" id="email_verified_at" name="email_verified_at" {{!empty($user->email_verified_at) ? "checked": ""}} value="1">
                                            <label for="email_verified_at">Verify Account</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="px-4 pb-4 text-end tab-btn-position">
                                <a class="btn btn-danger" href="{{route('admin.customers.index')}}">
                                    Back
                                </a>
                                <button class="btn btn-success save-data" data-url="{{route('admin.category.store')}}" type="submit">
                                    Update
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection
@section('scripts')

@endsection
