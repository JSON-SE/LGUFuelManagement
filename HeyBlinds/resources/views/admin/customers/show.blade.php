@extends('layouts.Backend.admin.admin')

@section('content')
<section class="" id="body-content">
    <div class="container-fluid px-lg-5 px-md-4 pb-5 pt-lg-3">
        <div class="row pt-4">
            <div class="col-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-2">
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.dashboard') }}">
                                Home
                            </a>
                        </li>
                        <li aria-current="page" class="breadcrumb-item active">
                            Order details
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="row pb-4">
            <div class="col-sm-6 text-white my-auto">
                <h3 class="mb-0">
                    Order Details #12333
                </h3>
            </div>
        </div>
        <div class="bg-white rounded page-height mt-3 shadow p-4">
            <div class="bg-primary p-2 rounded mb-3 text-white d-flex flex-wrap align-items-center justify-content-between">
                <p class="mb-0">
                    Order status: Active
                </p>
                <p class="mb-0">
                    Order ID: #q23e
                </p>
            </div>
            <div class="row">
                <div class="col-md-4 mb-3">
                    <h5>
                        Shipping information
                    </h5>
                    <p class="mb-2">
                        <input class="edit-input table-input" name="" readonly="" type="text" value=""/>
                    </p>
                    <p class="mb-2">
                        <input class="edit-input table-input" name="" readonly="" type="text" value=""/>
                    </p>
                    <p class="mb-2">
                        <input class="edit-input table-input" name="" readonly="" type="text" value=""/>
                    </p>
                    <p class="mb-2">
                        <input class="edit-input table-input" name="" readonly="" type="text"/>
                    </p>
                    <p class="mb-2">
                        <a href="#">
                            <input class="edit-input table-input" name="" readonly="" type="text"/>
                        </a>
                    </p>
                    <p class="mb-2">
                        <a href="#">
                            <input class="edit-input table-input" name="" readonly="" type="text"/>
                        </a>
                    </p>
                </div>
                <div class="col-md-4 mb-3">
                    <h5>
                        Billing information
                    </h5>
                    <p class="mb-2">
                        <input class="edit-input table-input" name="" readonly="" type="text"/>
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
