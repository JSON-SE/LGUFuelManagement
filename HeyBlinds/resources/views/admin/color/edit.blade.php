@extends('layouts.Backend.admin.admin')
@section('content')
    <form action="{{ route('admin.color.update', $color->slug) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('put')
        <div class="container-fluid px-lg-5 px-md-4 pb-5 pt-lg-3">
            <div class="row pt-4">
                <div class="col-12">
                    <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='white'/%3E%3C/svg%3E&#34;);"
                        aria-label="breadcrumb">
                        <ol class="breadcrumb mb-2">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Edit Colour</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <div class="row pb-4">
                <div class="col-sm-6 text-white my-auto">
                    <h3 class="mb-0">Edit: {{ $color->name }}</h3>
                </div>
                <div class="col-sm-6 pt-3 pt-lg-0 my-auto d-flex justify-content-sm-end">
                    <a href="{{ route('admin.color.index') }}" class="btn btn-primary d-flex align-items-center ms-2">
                        <span class="d-none d-md-block">All Colours</span>
                    </a>
                    <a href="{{ route('admin.color.index') }}" class="btn btn-primary d-flex align-items-center ms-2">
                        <span class="d-none d-md-block">Add New</span>
                    </a>

                </div>
            </div>

            <div class="bg-white rounded page-height mt-3 shadow">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="p-4">
                    <div class="pt-2 justify-content-center">
                        <div class="color-records pb-3">
                            <div class="row">
                                <div class="col-lg-12 col-xl-12">
                                    <div class="row gx-2">
                                        <div class="col-12">
                                            <h5>Edit Colour</h5>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="form-floating mt-3">
                                                <input type="text" class="form-control" name="vendor_color_name"
                                                    id="vendor_color_name" placeholder="vendor Colour Name *"
                                                    value="{{ $color->vendor_color_name }}">
                                                <label for="vendor_color_name">Vendor Colour Name <span
                                                        class="text-danger">*</span></label>
                                            </div>
                                        </div>
                                        <div class="col-lg-2">

                                            <div class="form-floating mt-3">
                                                <input type="text" class="form-control" name="vendor_color_id"
                                                    id="vendor_color_id" placeholder="Vendor Color ID *"
                                                    value="{{ $color->vendor_color_id }}">
                                                <label for="vendor_color_id">Vendor Colour ID <span
                                                        class="text-danger">*</span></label>
                                            </div>
                                        </div>

                                        <div class="col-lg-3">
                                            <div class="form-floating mt-3">
                                                <input type="text" class="form-control" name="name" id="name"
                                                    placeholder="Our Colour Name *" value="{{ $color->name }}">
                                                <label for="name">Our Colour Name <span
                                                        class="text-danger">*</span></label>
                                            </div>
                                        </div>
                                        <div class="col-lg-2 text-center">
                                            <div class="check-box d-inline-block pt-4 ">
                                                <input type="checkbox" id="out_of_stock" name="out_of_stock"
                                                    {{ !empty($color->out_of_stock) && $color->out_of_stock == 1 ? 'checked' : '' }}
                                                    value="1">
                                                <label for="out_of_stock">Out Of Stock</label>
                                            </div>
                                        </div>
                                        <div class="col-lg-2">

                                            <div class="form-floating mt-3">
                                                <input type="text" class="form-control" name="color_id" id="color_id"
                                                    placeholder="Our Colour Id *" value="{{ $color->color_id }}">
                                                <label for="color_id">Our Colour Id <span
                                                        class="text-danger">*</span></label>
                                            </div>
                                        </div>

                                        <div class="col-lg-2 mt-3">
                                            <label for="group_name" class="pb-2">Colour Group Name <span
                                                    class="text-danger">*</span></label>
                                            <select class="form-control add-colour-name" id="group_name"
                                                name="color_group_id">
                                                <option value="">Select Color Group</option>
                                                @foreach ($allGroups as $group)
                                                    <option value="{{ $group->id }}"
                                                        {{ $group->id == $color->color_group_id ? 'Selected' : '' }}>
                                                        {{ $group->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col-lg-1 ps-3 mt-4">
                                            <div class="check-box d-inline-block pt-4">
                                                <input type="checkbox" id="enable-check" name="is_enable" value="1"
                                                    {{ !empty($color->color_group_id) && $color->is_enable == 1 ? 'checked' : '' }}>
                                                <label for="enable-check">Enable</label>
                                            </div>
                                        </div>
                                        {{-- <div class="col-lg-1 ps-3 mt-3">
                                            <label for="enable-check-quantity" class="pb-2">Quantity <span
                                                    class="text-danger">*</span></label>
                                            <input type="text"  id="enable-check-quantity"
                                                class="form-control" name="quantity" value="{{$color->quantity}}">
                                        </div> --}}
                                        <div class="col-lg-2 ps-3 mt-3">
                                            @php
                                                $quantity = ($color->quantity - $color->remaining_quantity) > 0 ? $color->quantity - $color->remaining_quantity : 0;
                                            @endphp
                                            <label for="enable-check-quantity" class="pb-2">Remaining Quantity<span
                                                    class="text-danger">*</span></label>
                                            <input type="text" id="enable-check-quantity"
                                                class="form-control"  name="quantity" value="{{$quantity}}">
                                        </div>
                                        <div class="col-lg-2 col-md-2 col-sm-6 col-6 mt-3">
                                            <label class="mb-2 form-label">Colour Image</label>
                                            <div class="d-flex">
                                                <div id="myId" class="fallback w-100">
                                                    <input type="file" name="image" class="form-control" accept="image/*">
                                                </div>
                                                <img class="h-50 thumb ms-3"
                                                    src="{{ $helpers->getThumbnail($color->color_image_id) }}" alt="">
                                            </div>
                                        </div>

                                        <div class="col-lg-3 col-md-3 col-sm-6 col-6 mt-3">
                                            <label class="mb-2 form-label">Featured Image</label>
                                            <div class="d-flex">
                                                <div class="fallback w-100">
                                                    <input class="form-control" type="file" name="feature"
                                                        accept="image/*">
                                                </div>
                                                <img class="h-50 thumb ms-3"
                                                    src="{{ $helpers->getThumbnail($color->feature_image_id) }}" alt="">
                                            </div>
                                        </div>
                                        <div class="col-lg-2 col-md-2 col-sm-6 col-6 mt-3">
                                            {{-- <label class="mb-2 form-label">Disclaimer </label> --}}
                                            <div class="check-box d-inline-block pt-4 ">
                                                <input type="checkbox" id="disclaimer" name="disclaimer"
                                                    {{ !empty($color->disclaimer) && $color->disclaimer == 1 ? 'checked' : '' }}
                                                    value="1">
                                                <label for="disclaimer">Disclaimer</label>
                                            </div>
                                        </div>


                                        <div class="col-lg-1 col-md-3 col-sm-6 col-6 d-flex align-items-end my-auto pt-3">
                                            <button
                                                class="btn btn-primary btn-sm pe-3 d-flex align-items-center add-more-color ms-auto">
                                                <span class="d-none d-md-block save-data">Update</span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
