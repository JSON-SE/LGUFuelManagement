@extends('layouts.Backend.admin.admin')
@section('style')
@endsection
@section('content')
    <form action="{{route('admin.product.option.update', $option->slug)}}" method="post" enctype="multipart/form-data">
        @csrf
        @method('put')
        <div class="container-fluid px-lg-5 px-md-4 pb-5 pt-lg-3">
            <div class="row pt-4">
                <div class="col-12">
                    <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='white'/%3E%3C/svg%3E&#34;);"
                         aria-label="breadcrumb">
                        <ol class="breadcrumb mb-2">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Edit Option</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <div class="row pb-4">
                <div class="col-sm-6 text-white my-auto">
                    <h3 class="mb-0">Edit: {{$option->name}}</h3>
                </div>
                <div class="col-sm-6 pt-3 pt-lg-0 my-auto d-flex justify-content-sm-end">
                    <a href="{{route('admin.product.option.index')}}" class="btn btn-primary d-flex align-items-center ms-2">
                        <span class="d-none d-md-block">All options</span>
                    </a>
                    <a href="{{route('admin.product.option.create')}}" class="btn btn-primary d-flex align-items-center ms-2">
                        <span class="d-none d-md-block">Add new option</span>
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
                                        <div class="col-lg-2">
                                            <label for="" class="pb-2">Option Name <span class="text-danger"> *</span></label>
                                            <input type="text" class="form-control" name="name" placeholder="Colour Name" value="{{!empty(old('name')) ? old('name') : $option->name}}">
                                        </div>
                                            <div class="col-lg-2">
                                                <label for="option_type" class="pb-2">Option Type <span class="text-danger">*</span></label>
                                                <select type="text" class="form-select" id="option_type" name="option_type">
                                                    <option value="">Option Type</option>
                                                    <option value="text" {{!empty($option->option_type) && $option->option_type === "text" ? "selected" : "" }}>Text Box</option>
                                                    <option value="number" {{!empty($option->option_type) && $option->option_type === "number" ? "selected" : "" }}>Number Box</option>
                                                    <option value="radio" {{!empty($option->option_type) && $option->option_type === "radio" ? "selected" : "" }}>Radio Box</option>
{{--                                                    <option value="checkbox" {{!empty($option->option_type) && $option->option_type === "checkbox" ? "selected" : "" }}>Check Box</option>--}}
                                                    <option value="width" {{!empty($option->option_type) && $option->option_type === "width" ? "selected" : "" }}>Width</option>
                                                    <option value="height" {{!empty($option->option_type) && $option->option_type === "height" ? "selected" : "" }}>Height</option>
                                                    <option value="quantity" {{!empty($option->option_type) && $option->option_type === "quantity" ? "selected" : "" }}>Quantity</option>
                                                    <option value="warranty" {{!empty($option->option_type) && $option->option_type === "warranty" ? "selected" : "" }}>Warranty</option>
                                                    {{-- <option value="warranty" {{!empty($option->option_type) && $option->option_type === "headrail" ? "selected" : "" }}>Headrail</option> --}}
                                                  
                                                </select>
                                            </div>
                                        <div class="col-lg-2">
                                            <label for="add-colour-name" class="pb-2">Group Name <span class="text-danger"> *</span>
                                                <div class="tooltip">
                                                    <span class="ps-2  text-primary" >
                                                         <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-question-circle-fill" viewBox="0 0 16 16">
                                                            <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.496 6.033h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286a.237.237 0 0 0 .241.247zm2.325 6.443c.61 0 1.029-.394 1.029-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94 0 .533.425.927 1.01.927z"></path>
                                                        </svg>
                                                    </span>
                                                    <span class="tooltiptext">Please Select From Dropdown List Or Type and hit enter to create new</span>
                                                </div>
                                            </label>
                                            <select class="form-control add-colour-name" id="add-colour-name" name="group_id">
                                                <option value="">Select Option Group</option>
                                                @foreach($optionGroup as $group)
                                                    <option value="{{$group->id}}" {{old('group_id') == $option->id || $group->id == $option->group_id ? "selected" : ""}}>{{$group->name}}</option>
                                                    @if(old('name') != $group->id))
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col-lg-2 ps-3 align-items-center my-auto">
                                            <div class="check-box d-inline-block mt-4 ">
                                                <input type="checkbox" id="alwaysIncluded" name="is_always_included"
                                                       value="1" {{!empty($option->is_always_included) && $option->is_always_included == 1 ? "checked" : (old('is_always_included') == 1 ? "checked" : "")}}>
                                                <label for="alwaysIncluded" class="ml-2">Always Included With Product</label>
                                            </div>
                                        </div>
                                        <div class="col-lg-1 align-items-center d-flex">
                                            <div class="check-box d-inline-block ms-4 ">
                                                <input type="checkbox" id="active" name="is_active"
                                                       value="1" {{!empty($option->is_active) && $option->is_active == 1 ? "checked" : (old('is_active') == 1 ? "checked" : "")}}>
                                                <label for="active">Active</label>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-md-3 col-sm-6 col-6 ">
                                            <div class="h-100 ">
                                                <label class="mb-2">Featured Image</label>
                                                <div class="d-flex">
                                                    <div class="fallback w-100">
                                                        <input name="image" class="form-control" type="file" value="{{old('image')}}" accept="image/*" accept="image/*" />
                                                    </div>
                                                    <a class="ms-2" href="{{$helper->getThumbnail($option->media_id)}}" target="_blank"><img class="img-fluid thumb" src="{{$helper->getThumbnail($option->media_id)}}" alt=""></a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 pt-3 option-price-heading-text">
                                            <h6>Add Price</h6>
                                        </div>
                                        <div id="option-price-check" class="col-12">
                                            @if(!empty($option->price->toArray()))
                                                @foreach($option->price as $key => $price)
                                                    <input type="hidden" name="option_price_id[]" value="{{$price->id}}">
                                                    <div class="row gx-2 option-price pb-3">
                                                        <div class="col-md-2">
                                                            <div class="form-floating">
                                                                <input type="number" class="form-control" value="{{$price->min_width}}"
                                                                       placeholder="Width" name="min_width[]" min="0">
                                                                <label for="">Min Width</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <div class="form-floating">
                                                                <input type="number" class="form-control" value="{{$price->max_width}}"
                                                                       placeholder="Width" name="max_width[]" min="0">
                                                                <label for="">Max Width</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <div class="form-floating">
                                                                <select class="form-select"
                                                                        aria-label="Floating label select example" name="price_type[]" >
                                                                    <option value="1" {{$price->type == 1 ? "selected" : ""}}>Dollar</option>
                                                                    <option value="2" {{$price->type == 2 ? "selected" : ""}}>Percentage</option>
                                                                </select>
                                                                <label for="">Price Type</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <div class="form-floating">
                                                                <input type="number" class="form-control" id="" value="{{$price->price}}"
                                                                       placeholder="Width" name="price[]" min="0">
                                                                <label for="">Price</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3 justify-content-end d-flex option-price-action">
                                                            <a href="javascript:void(0)"
                                                               class="btn btn-primary btn-sm pe-3 d-flex align-items-center add-option-price ms-auto">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                                     fill="currentColor" class="bi bi-plus" viewBox="0 0 16 16">
                                                                    <path
                                                                        d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z">
                                                                    </path>
                                                                </svg>
                                                                <span class="d-none d-md-block">Add more</span>
                                                            </a>
                                                            @if(!$loop->first)
                                                                <a class="btn remove-option-price btn-secondary btn-sm pe-3 d-flex align-items-center ms-auto" data-id="{{$price->id}}" data-type="price"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash ml-2" viewBox="0 0 16 16"><path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"></path><path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"></path></svg><span class="d-none d-md-block">Remove</span></a>
                                                            @endif
                                                        </div>
                                                    </div>
                                                @endforeach
                                            @else
                                                <div class="row gx-2 option-price pb-3">
                                                    <div class="col-md-2">
                                                        <div class="form-floating">
                                                            <input type="number" class="form-control"
                                                                   placeholder="Width" name="min_width[]" min="0">
                                                            <label for="">Min Width</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="form-floating">
                                                            <input type="number" class="form-control"
                                                                   placeholder="Width" name="max_width[]" min="0">
                                                            <label for="">Max Width</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="form-floating">
                                                            <select class="form-select"
                                                                    aria-label="Floating label select example" name="price_type[]" >
                                                                <option value="1" >Dollar</option>
                                                                <option value="2" >Percentage</option>
                                                            </select>
                                                            <label for="">Price Type</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="form-floating">
                                                            <input type="number" class="form-control" id=""
                                                                   placeholder="Width" name="price[]" min="0">
                                                            <label for="">Price</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3 justify-content-end d-flex option-price-action">
                                                            <a href="javascript:void(0)"
                                                               class="btn btn-primary btn-sm pe-3 d-flex align-items-center add-option-price ms-auto">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                                     fill="currentColor" class="bi bi-plus" viewBox="0 0 16 16">
                                                                    <path
                                                                        d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z">
                                                                    </path>
                                                                </svg>
                                                                <span class="d-none d-md-block">Add more</span>
                                                            </a>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>

                                        <div class="col-12 pt-3 option-price-heading-text">
                                            <h6>Sub Options</h6>
                                        </div>

                                        <div id="option-sub-option-check" class="col-12">
                                            @if(!empty($option->subOption->count() > 0))
                                                @foreach($option->subOption as $key => $subOption)
                                                    <input type="hidden" name="sub_option_id[]" value="{{$subOption->id}}">
                                                    <div class="row gx-2 option-price pb-3">
                                                        <div class="col-md-2">
                                                            <div class="form-floating">
                                                                <input type="text" class="form-control"
                                                                       placeholder="Sub Option name" name="sub_option_name[]" value="{{$subOption->sub_option_name}}">
                                                                <label for="">Sub Option Name</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-2">
                                                            <select class="form-control sub_group_id" name="sub_group_id[]">
                                                                <option value="">Select Sub Option Group</option>
                                                                @foreach($subOptions as $subOpts)
                                                                    <option value="{{$subOpts->sub_group_id}}" {{$subOpts->sub_group_id === $subOption->sub_group_id ? "selected" : ""}}>{{$subOpts->sub_group_id}}</option>
                                                                    @if(!empty(old('sub_group_id')))
                                                                        <option value="{{old('sub_group_id')}}">{{old('sub_group_id')}}</option>
                                                                    @endif
                                                                @endforeach
                                                            </select>

                                                        </div>
                                                        <div class="col-md-2">
                                                            <div class="form-floating">
                                                                <select type="text" class="form-select"  name="sub_option_type[]">
                                                                    <option value="">Sub Option Type</option>
                                                                    <option value="dropdown" {{$subOption->sub_option_type === "dropdown" ? "selected" : ""}}>Dropdown Box</option>
{{--                                                                    <option value="number" {{$subOption->sub_option_type === "number" ? "selected" : ""}}>Number Box</option>--}}
{{--                                                                    <option value="radio" {{$subOption->sub_option_type === "radio" ? "selected" : ""}}>Radio Box</option>--}}
{{--                                                                    <option value="checkbox" {{$subOption->sub_option_type === "checkbox" ? "selected" : ""}}>Check Box</option>--}}
                                                                </select>
                                                                <label for="">Sub Option Type</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-1">
                                                            <div class="form-floating">
                                                                <input type="number" class="form-control"
                                                                       placeholder="Width" name="sub_option_min_width[]" value="{{$subOption->sub_option_min_width}}" min="0">
                                                                <label for="">Min Width</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-1">
                                                            <div class="form-floating">
                                                                <input type="number" class="form-control"
                                                                       placeholder="Width" name="sub_option_min_height[]" value="{{$subOption->sub_option_min_height}}" min="0">
                                                                <label for="">Max Width</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-1">
                                                            <div class="form-floating">
                                                                <select class="form-select"
                                                                        aria-label="Floating label select example" name="sub_option_price_type[]" value="{{$subOption->sub_option_price_type}}">
                                                                    <option value="1">Dollar</option>
                                                                    <option value="2">Percentage</option>
                                                                </select>
                                                                <label for="">Price Type</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-1">
                                                            <div class="form-floating">
                                                                <input type="number" class="form-control"
                                                                       placeholder="Amount" name="sub_option_price[]" value="{{$subOption->sub_option_price}}" min="0">
                                                                <label for="">Price</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-2 justify-content-end d-flex option-price-action">
                                                            <a href="javascript:void(0)"
                                                               class="btn btn-primary btn-sm pe-3 d-flex align-items-center add-sub-option-price ms-auto">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                                     fill="currentColor" class="bi bi-plus" viewBox="0 0 16 16">
                                                                    <path
                                                                        d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z">
                                                                    </path>
                                                                </svg>
                                                                <span class="d-none d-md-block">Add more</span>
                                                            </a>
                                                            @if($subOption->is_free != 1 )
                                                                <a class="btn remove-option-price btn-secondary btn-sm pe-3 d-flex align-items-center ms-auto" data-type="sub-group" data-id="{{$subOption->id}}"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash ml-2" viewBox="0 0 16 16"><path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"></path><path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"></path></svg><span class="d-none d-md-block">Remove</span></a>
                                                            @endif
                                                        </div>

                                                    </div>
                                                @endforeach
                                            @else
                                                <div class="row gx-2 option-price pb-3">
                                                    <div class="col-md-2">
                                                        <div class="form-floating">
                                                            <input type="text" class="form-control"
                                                                   placeholder="Sub Option name" name="sub_option_name[]">
                                                            <label for="">Sub Option Name</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-2">
                                                        <select class="form-control add-colour-name sub_group_id" id="add-colour-name"  name="sub_group_id[]">
                                                            <option value="">Select Sub Option Group</option>
                                                            @foreach($subOptions as $subOption)
                                                                <option value="{{$subOption->sub_group_id}}">{{$subOption->sub_group_id}}</option>
                                                                @if(!empty(old('group_id')))
                                                                    <option value="{{old('sub_group_id')}}">{{old('sub_group_id')}}</option>
                                                                @endif
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="form-floating">
                                                            <select type="text" class="form-select"  name="sub_option_type[]">
                                                                <option value="">Sub Option Type</option>
                                                                <option value="dropdown">Dropdown Box</option>
                                                                <option value="number">Number Box</option>
                                                                <option value="radio">Radio Box</option>
                                                                <option value="checkbox">Check Box</option>
                                                            </select>
                                                            <label for="">Sub Option Type</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-1">
                                                        <div class="form-floating">
                                                            <input type="number" class="form-control"
                                                                   placeholder="Width" name="sub_option_min_width[]" min="0">
                                                            <label for="">Min Width</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-1">
                                                        <div class="form-floating">
                                                            <input type="number" class="form-control"
                                                                   placeholder="Width" name="sub_option_min_height[]" min="0">
                                                            <label for="">Max Width</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-1">
                                                        <div class="form-floating">
                                                            <select class="form-select"
                                                                    aria-label="Floating label select example" name="sub_option_price_type[]">
                                                                <option value="1">Dollar</option>
                                                                <option value="2">Percentage</option>
                                                            </select>
                                                            <label for="">Price Type</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-1">
                                                        <div class="form-floating">
                                                            <input type="number" class="form-control"
                                                                   placeholder="Width" name="sub_option_price[]" min="0">
                                                            <label for="">Price</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2 justify-content-end d-flex option-price-action">
                                                        <a href="javascript:void(0)"
                                                           class="btn btn-primary btn-sm pe-3 d-flex align-items-center add-sub-option-price ms-auto">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                                 fill="currentColor" class="bi bi-plus" viewBox="0 0 16 16">
                                                                <path
                                                                    d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z">
                                                                </path>
                                                            </svg>
                                                            <span class="d-none d-md-block">Add more</span>
                                                        </a>
                                                    </div>

                                                </div>
                                            @endif
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-6 col-6 ">
                                            <div class="h-100 ">
                                                <label class="mb-2">Tooltip Image</label>
                                               <div class="d-flex">
                                                   <div class="fallback w-100">
                                                       <input name="tooltip_media_id" class="form-control" type="file" value="{{old('tooltip_media_id')}}" accept="image/*" />
                                                   </div>
                                                   @if(!empty($option->tooltip_media_id))
                                                   <div class="text-center">
                                                        <div class="ms-2 media-view">
                                                            <img class="img-fluid thumb" src="{{$helper->getThumbnail($option->tooltip_media_id)}}" alt="">
                                                            <span class="media-remove" onclick="return removeMedia({{$option->tooltip_media_id}});">x</span>
                                                        </div>
                                                         <a href="{{$helper->getThumbnail($option->tooltip_media_id)}}"  target="_blank">View</a>
                                                    </div>

                                                   @endif
                                               </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-md-3 col-sm-6 col-6 ">
                                            <div class="h-100 ">
                                                <label class="mb-2">All Colors</label>
                                                <div class="fallback">
                                                    <select class="form-control option_color" name="option_color[]" multiple>
                                                        <option value="">Select Colors</option>
                                                        @foreach($Colors as $Color)
                                                            <option value="{{$Color->id}}" >{{$Color->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-12 col-md-6 col-sm-6 col-6 mt-3">
                                            <label>Option Info</label>
                                            <div class="mt-2 pe-4">
                                                <textarea name="content" id="content" cols="2" rows="5"  class="summernote">{{!empty(old('content')) ? old('content') : $option->content}}</textarea>
                                            </div>
                                        </div>
                                        <div>
                                            <button class="btn btn-primary mt-4 save-data">
                                                Update Option
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
@section('scripts')
    <script>
        jQuery(function ($) {
            $('.sub_group_id').select2({tags:true});
            $('.option_color').select2();
            $(document).on("click", "#optioncheck1", function () {
                if ($(this).is(':checked')) {
                    $("#option-price-check input, #option-price-check select").attr('disabled', 'disabled');
                    $("#option-price-check .add-option-price ").remove();
                }else{
                    $("#option-price-check input, #option-price-check select").removeAttr('disabled')
                    $(".option-price-action").first().append(`<a href="javascript:void(0)" class="btn btn-primary btn-sm pe-3 d-flex align-items-center add-option-price ms-auto" disabled="disabled"> <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus" viewBox="0 0 16 16"> <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"> </path> </svg> <span class="d-none d-md-block">Add more</span> </a>`);
                }
            })
            $(document).on("click", ".add-option-price", function () {
                $("#option-price-check").append(html())
            })

            $(document).on("click", ".add-sub-option-price", function () {
                $("#option-sub-option-check").append(subOption())
                $('.sub_group_id').select2({tags:true});
            })

                $(document).on('click', '.remove-option-price', function(){
                let $this = $(this);
                if($this.attr('data-id') !== ""){
                    console.log('working');
                    axios.delete("{{route('admin.product.option.price.remove')}}", {
                        data: {
                            id: $this.attr('data-id'),
                            type: $this.attr('data-type'),
                        }
                    }).then(function (response) {
                        console.log(response)
                        toastr.error('Removed!')
                        $this.parents('.row.option-price').remove();
                    }).catch(function (error) {
                        console.log(error)
                        let errors = error.response.data.errors;
                        $.each(errors, function (key, value) {
                            toastr.error(value)
                        })
                    });
                }else{
                    $(this).parents('.option-price').remove();
                }
            })
            $(document).on('click', '.save-data', function (e) {
                e.preventDefault();
                let $this = $(this);
                let form = $this.parents('form');
                var formData = new FormData(form[0]);
                $("#loader").show();
                axios({
                    method: 'post',
                    url: form.attr('action'),
                    data: formData,
                }).then(function (response) {
                    toastr.success('updated!')
                    $("#loader").hide();
                    window.location.assign("{{route('admin.product.option.index')}}");
                }).catch(function (error) {
                    console.log(error)
                    let errors = error.response.data.errors;
                    $.each(errors, function (key, value) {
                        toastr.error(value)
                    })
                    $("#loader").hide();
                });
            })
        })
        function html() {
            return `<div class="row gx-2 option-price pb-3"><div class="col-md-2"><div class="form-floating"><input type="number" name="min_width[]" class="form-control" placeholder="Width" min="0"><label for="">Min Width</label></div></div><div class="col-md-2"><div class="form-floating"><input type="number" name="max_width[]" class="form-control" placeholder="Width"><label for="">Max Width</label></div></div><div class="col-md-2"><div class="form-floating"><select class="form-select" name="price_type[]" aria-label="Floating label select example"><option value="1">Dollar</option><option value="2">Percentage</option></select><label for="">Price Type</label></div></div><div class="col-md-2"><div class="form-floating"><input type="number" name="price[]" class="form-control" id="" placeholder="Width" min="0"><label for="">Price</label></div></div><div class="col-md-3 d-flex option-price-action"><a href="javascript:void(0)" class="btn btn-primary btn-sm pe-3 d-flex align-items-center add-option-price ms-auto"> <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus" viewBox="0 0 16 16"> <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"> </path> </svg> <span class="d-none d-md-block">Add more</span> </a><a class="btn remove-option-price btn-secondary btn-sm pe-3 d-flex align-items-center ms-auto"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash ml-2" viewBox="0 0 16 16"><path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"></path><path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"></path></svg><span class="d-none d-md-block">Remove</span></a></div></div>`;
        }


        function subOption() {
            return `<div class="row gx-2 option-price pb-3"><div class="col-md-2"><div class="form-floating"> <input type="text" class="form-control" placeholder="Sub Option name" name="sub_option_name[]"> <label for="">Sub Option Name</label></div></div><div class="col-lg-2"> <select class="form-control sub_group_id" name="sub_group_id[]"><option value="">Select Sub Option Group</option> @foreach($subOptions as $subOption)<option value="{{$subOption->sub_group_id}}">{{$subOption->sub_group_id}}</option> @if(!empty(old('group_id')))<option value="{{old('sub_group_id')}}">{{old('sub_group_id')}}</option> @endif @endforeach </select></div><div class="col-md-2"><div class="form-floating"> <select type="text" class="form-select" name="sub_option_type[]"><option value="">Sub Option Type</option><option value="dropdown">Dropdown Box</option> </select> <label for="">Sub Option Type</label></div></div><div class="col-md-1"><div class="form-floating"> <input type="number" class="form-control" placeholder="Width" name="sub_option_min_width[]" min="0"> <label for="">Min Width</label></div></div><div class="col-md-1"><div class="form-floating"> <input type="number" class="form-control" placeholder="Width" min="0" name="sub_option_min_height[]"> <label for="">Max Width</label></div></div><div class="col-md-1"><div class="form-floating"> <select class="form-select" aria-label="Floating label select example" name="sub_option_price_type[]"><option value="1">Dollar</option><option value="2">Percentage</option> </select> <label for="">Price Type</label></div></div><div class="col-md-1"><div class="form-floating"> <input type="number" class="form-control" placeholder="Width" min="0" name="sub_option_price[]"> <label for="">Price</label></div></div><div class="col-md-2 justify-content-end d-flex option-price-action"> <a href="javascript:void(0)" class="btn btn-primary btn-sm pe-3 d-flex align-items-center add-sub-option-price ms-auto"> <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus" viewBox="0 0 16 16"> <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"> </path> </svg> <span class="d-none d-md-block">Add more</span> </a><a class="btn remove-option-price btn-secondary btn-sm pe-3 d-flex align-items-center ms-auto"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash ml-2" viewBox="0 0 16 16"><path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"></path><path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"></path></svg><span class="d-none d-md-block">Remove</span></a></div></div>`;
            
        }
    </script>
  
@endsection
