<div class="pt-2 justify-content-center">
    <div class="color-records border-bottom pb-3">
        <div class="row align-items-end">
{{--            <div class="col-lg-3 mt-3">--}}
{{--                <label class="pb-2">Select Group <span class="text-danger">*</span></label>--}}
{{--                <select class="form-control add-colour-name" id="colorGroups" name="color_group_id">--}}
{{--                    <option value="">Colors Group</option>--}}
{{--                    @if(!empty($colorGroups->toArray()))--}}
{{--                        @foreach($colorGroups as $colorGroup)--}}
{{--                            <option value="{{$colorGroup->id}}">{{$colorGroup->name}}</option>--}}
{{--                        @endforeach--}}
{{--                    @endif--}}
{{--                </select>--}}
{{--            </div>--}}

            <div class="col-lg-6 mt-3">
                <label for="color_id" class="pb-2">Select Colour <span class="text-danger">*</span></label>
                    <select id="color_id" class="form-control" name="color_id" multiple>
                        @if(!empty($colors->toArray()))
                            @foreach($colors as $color)
                                <option value="{{$color->id}}">{{$color->name}} - ({{$color->color_id}})</option>
                            @endforeach
                        @endif
                    </select>
            </div>
            <div class="col-md-2">
                <label for="" class="pb-2">Additional Cost (%)</label>
                <input type="number" class="form-control" value="0" name="amount_percentage">
            </div>
            <div class="col-lg-2 mt-3">
                <button class="btn btn-primary btn-sm d-flex align-items-center add-more-color">
                    <span class="d-none d-md-block">Save and new</span>
                </button>
            </div>
        </div>
    </div>
    <div class="table-responsive mt-2">
        <table class="table colourtable" id="productColorTable">
            <thead class="text-white bg-secondary">
            <tr>
                <th scope="col py-2">#</th>
                <th scope="col py-2">Vendor Colour Name</th>
                <th scope="col py-2">Vendor Colour ID</th>
                <th scope="col py-2">HB Colour Name</th>
                <th scope="col py-2">HB Colour ID</th>
                <th scope="col py-2">HB Colour Image</th>
                <th scope="col py-2">HB Colour Group</th>
                <th scope="col py-2">HB Featured Image</th>
                <th scope="col py-2">Additional Cost (%)</th>
                <th scope="col py-2">Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($productColors as $productColorKey => $productColor)
                <tr class="colour-row ui-state-default align-middle" data-id="{{$productColor['id']}}">
                    <td>{{$productColorKey+1}}</td>
                    <td>{{$productColor['vendor_name']}}</td>
                    <td>{{$productColor['vendor_color_id']}}</td>
                    <td>{{$productColor['name']}}</td>
                    <td>{{$productColor['color_id']}}</td>
                    <td><img class="img-fluid thumb" src="{{$productColor['color_image_id']}}" alt=""></td>
                    <td>{{$productColor['color_group_name']}}</td>
                    <td><img class="img-fluid thumb" src="{{$productColor['feature_image_id']}}" alt=""></td>
                    <td class="text-center "><input type="number" class="border-0 bg-white edit-color-percentage" data-id="{{$productColor['id']}}" value="{{!empty($productColor['amount_percentage']) ? $productColor['amount_percentage'] : 0}}" disabled></td>
                    <td>
                        <button class="btn btn-sm remove-colour-row" data-id="{{$productColor['main_color_id']}}">
                            <div class="text-secondary">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                    <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"></path>
                                    <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"></path>
                                </svg>
                            </div>
                        </button>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
