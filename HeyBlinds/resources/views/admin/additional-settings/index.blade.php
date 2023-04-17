@extends('layouts.Backend.admin.admin')
@section('content')
    <div class="container-fluid px-lg-5 px-md-4 pb-5 pt-lg-3">
        <div class="row pt-4">
            <div class="col-12">
                <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='white'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
                    <ol class="breadcrumb mb-2">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Library</li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="row pb-4">
            <div class="col-sm-12 text-white my-auto">
                <h3 class="mb-0">Additional Settings</h3>
            </div>
        </div>

        <div class="bg-white rounded page-height mt-3 shadow position-relative pb-5">
            <div class="p-lg-4 p-3 pb-5">
                <div class="d-flex align-items-start ">
                    <div class="nav flex-column nav-pills me-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                        <button class="nav-link active" id="v-pills-home-tab" data-bs-toggle="pill" data-bs-target="#v-pills-home" type="button" role="tab" aria-controls="v-pills-home" aria-selected="true">Product Settings</button>
                        <button class="nav-link" id="v-pills-settings-tab" data-bs-toggle="pill" data-bs-target="#v-pills-settings" type="button" role="tab" aria-controls="v-pills-settings" aria-selected="false">Settings</button>
                    </div>
                    <div class="tab-content" id="v-pills-tabContent">
                        <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
                            <form action="{{route("admin.product.additional.settings.store")}}" method="post">
                                <div class="w-100">
                                <div class="row">
                                    <div class="col-md-5 my-auto">
                                        <label id="delivery_time_tooltip">Delivery Time ToolTip</label>
                                    </div>
                                    <div class="col-md-7">
                                        <div class="mt-2">
                                            <textarea cols="2" id="delivery_time_tooltip" name="delivery_time_tooltip" class="summernote">{{old('delivery_time_tooltip') ?? $helpers->getSettings('delivery_time_tooltip') ?? "" }}</textarea>
                                        </div>
                                    </div>
                                </div>
                                    <div class="text-end mt-4">
                                        <button value="Submit" class="btn btn-primary"> Submit </button>
                                    </div>
                            </div>
                            </form>
                        </div>
                        <div class="tab-pane fade" id="v-pills-settings" role="tabpanel" aria-labelledby="v-pills-settings-tab">
                            Other Settings
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
