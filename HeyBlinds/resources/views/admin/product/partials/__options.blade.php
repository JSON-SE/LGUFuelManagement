<div class="pt-3">
    <form action="{{route('admin.main.product.option.store', $productID)}}" enctype="multipart/form-data" data-from="option">
        @csrf
        <div id="productaccordion">
            <ul class="product-option-list">
                <li class="heading-list row">
                    <div class="col-lg-1">#</div>
                    <div class="col-lg-4">Option Name</div>
                    <div class="col-lg-3">Option Group Name</div>
                    <div class="col-lg-1">  Min </div>
                    <div class="col-lg-1">  Max  </div>
                    <div class="col-lg-1 text-center mx-auto">Show</div>
                    <div class="col-lg-1">Rules</div>
                </li>
            </ul>

            @foreach($groupHeadings as $key=>$groupHeading)
                <ul id="" class="product-option-list sortable">
                    <div class="card mb-3">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-lg-10"><h5 class="card-title">{{$groupHeading->group_heading}}</h5></div>
                                <div class="col-lg-1 text-center"><input type="checkbox" class="group-based-check-all"></div>
                            </div>
                        </div>
                        <div class="card-body">
                            @foreach($Options as $optionKey => $option)
                                @if(!empty($option->group) && $option->group->group_heading === $groupHeading->group_heading)
                                    <div id="item-{{$option->id}}" class="mb-3 border-bottom">
                                        <li class="accordion-item ui-state-default row ">
                                            <input type="hidden" name="h_option_id[]" value="{{$option->id}}">
                                            <div class="fw-bold col-lg-1" >
                                                {{$optionKey+1}}
                                            </div>
                                            <div class="col-lg-4">
                                                <h6>{{$option->name}}</h6>
                                            </div>
                                            <div class="col-lg-3">
                                                <h6>{{!empty($option->group->name) ? $option->group->name : "No Option Group Found"}}</h6>
                                            </div>
                                            @if (!empty($option->getMinMax($product->id, $option->id)))
                                                @php
                                                    $width = $option->getMinMax($product->id, $option->id);
                                                    $splitWidth = explode('-', $width['width']);
                                                @endphp
                                            @endif
                                            <div class="col-lg-1">
                                                <input type="text" name="option_min_width[]" class="form-control" value="{{!empty($splitWidth[0]) && $width['id'] === $option->id ? $splitWidth[0] : ""}}">
                                            </div>
                                            <div class="col-lg-1">
                                                <input type="text" name="option_max_width[]" class="form-control"  value="{{!empty( $splitWidth[1]) && $width['id'] === $option->id ? $splitWidth[1] : ""}}">
                                            </div>
                                            <div class="col-lg-1 text-center mx-auto">
                                                <input type="checkbox" class="product-option-is-active-checkbox" name="is_active[]" value="1"
                                                    {{ $helpers->isOptionSelected($productID, $option->id) == true ? "checked" : "" }}
                                                />
                                            </div>
                                            <div class="col-lg-1 text-center mx-auto">
                                                <a href="javascript:void(0)" onclick="addRules('{{$option->id}}', this)" class="btn btn-primary text-center btn-sm pe-3 d-flex align-items-center add-rules ms-auto">
                                                    <span class="d-none d-md-block text-white">Add Rules</span>
                                                </a>
                                            </div>
                                            <ul id="productaccordion{{$optionKey}}" class="mt-4 productaccordion">
                                                @if(!empty($option->getRules($product->id, $option->id)))
                                                    <li class="mb-4">
                                                        @foreach($option->getRules($product->id, $option->id) as $optionRule)
                                                            @if($optionRule->product_id === $product->id)
                                                                <div>
                                                                    <div class="rules-row {{$loop->last ? "remove" : ""}} pb-3 ">
                                                                        <input type="hidden" value="{{$optionRule->id}}" name="product_option_rules_id[]">
                                                                        <hr />
                                                                        <input type="hidden" value="{{$option->id}}" name="product_option_id[]">
                                                                        <div class="row gx-2">
                                                                            <div class="col-md-2">
                                                                                <label class="pb-2">Operator</label>
                                                                                <select class="form-select" name="option_operator[]" aria-label="Default select example bg-transparent">
                                                                                    <option selected value="">Open this menu</option>
                                                                                    <option value="disabled" {{$optionRule->operator == "disabled" ? "selected" : ""}}>Disabled</option>
                                                                                    {{--                                                                                    <option value="enabled" {{$optionRule->operator == "enabled" ? "selected" : ""}}>Enabled</option>--}}
                                                                                </select>
                                                                            </div>
                                                                            <div class="col-md-3">
                                                                                <label for="" class="pb-2">List Option/Group Option</label>
                                                                                <select class="form-select bg-transparent" name="option_list[]">
                                                                                    <option value="">Select</option>
                                                                                    @foreach($Options as $option)
                                                                                        <option value="option:{{$option->id}}" {{"option:$option->id" == $optionRule->type .":" . $optionRule->type_id ? "selected" : ""}}>{{$option->name}} (Option)</option>
                                                                                    @endforeach
                                                                                    {{--                                                            @foreach($optionGroups as $optionGroup)--}}
                                                                                    {{--                                                                <option value="group:{{$optionGroup->id}}" {{"group:$option->id" == $optionRule->type .":" . $optionRule->type_id ? "selected" : ""}}>{{$optionGroup->name}} (Group)</option>--}}
                                                                                    {{--                                                            @endforeach--}}
                                                                                </select>
                                                                            </div>
                                                                            {{--                                                                            <div class="col-md-2">--}}
                                                                            {{--                                                                                <label for="" class="pb-2">Min Width</label>--}}
                                                                            {{--                                                                                <input type="text" name="option_rule_min_width[]" class="form-control" placeholder="Enter min width" value="{{$optionRule->min_width}}" />--}}
                                                                            {{--                                                                            </div>--}}
                                                                            {{--                                                                            <div class="col-md-2">--}}
                                                                            {{--                                                                                <label for="" class="pb-2">Max Width</label>--}}
                                                                            {{--                                                                                <input type="text" name="option_rule_max_width[]" class="form-control" placeholder="Enter max width"  value="{{$optionRule->max_width}}"/>--}}
                                                                            {{--                                                                            </div>--}}
                                                                            <div class="col-md-2 mt-auto">
                                                                                <button class="btn remove-option-rules-price btn-secondary btn-sm pe-3 d-flex align-items-center ms-auto" data-id="{{$optionRule->id}}">
                                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                                                                        <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                                                                        <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                                                                                    </svg>
                                                                                    <span class="d-none d-md-block ps-2">Remove</span>
                                                                                </button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @endif
                                                        @endforeach
                                                    </li>
                                                @else

                                                @endif
                                                <div class="option_rules_dynamic"></div>
                                            </ul>
                                        </li>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </ul>
            @endforeach
        </div>
        <div class="px-4 pb-4 text-end tab-btn-position">

            {{--            <button type="submit"  class="btn btn-secondary info-submit productBasicForm" name="draft" data-type="draft">Save Draft</button>--}}
            <button type="submit" class="btn btn-primary info-submit productBasicForm" name="save" data-type="save">Save</button>
        </div>
    </form>
</div>
