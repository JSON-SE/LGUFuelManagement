<form action="{{route('admin.main.product.shipping.store', $productID)}}" method="post" enctype="multipart/form-data">
    <div class="pt-3">
    <div class="row">
        <div class="col-lg-12">
            <div>
                <label>Excerpt</label>
                <div class="mt-2">
                    <textarea name="content" class="summernote">{{!empty($productShipping->content) ? $productShipping->content : ""}}</textarea>
                </div>
            </div>
            <div class="mt-3">
                <label>Free Shipping On Everything</label>
                <div class="table-responsive mt-2">
                    <table class="table shippingtable">
                        <thead class="text-white bg-secondary">
                        <tr>
                            <th scope="col py-2">#</th>
                            <th scope="col py-2">Freight Surcharge Chart</th>
                            <th scope="col py-2">HeyBlinds.com</th>
                            <th scope="col py-2">Other Online Blinds Retailers</th>
                            <th scope="col py-2"> Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php
                            $freight_surcharge = !empty($productShipping->freight_surcharge) ? json_decode($productShipping->freight_surcharge) : "";
                            $heyblind_cost = !empty($productShipping->heyblind_cost) ? json_decode($productShipping->heyblind_cost) : "";
                            $other_online_blind_cost = !empty($productShipping->other_online_blind_cost) ? json_decode($productShipping->other_online_blind_cost) : "";
                        @endphp
                        @if(!empty($freight_surcharge))
                        @for($i = 0; $i < count($freight_surcharge); $i++)
                        <tr class="shipping-row">
                            <th scope="row">1</th>
                            <td><input type="text" class="form-control border-0 bg-light" value="{{$freight_surcharge[$i]}}" name="freight_surcharge[]" /></td>
                            <td><input type="text" class="form-control border-0 bg-light" value="{{$heyblind_cost[$i]}}" name="heyblind_cost[]"/></td>
                            <td><input type="text" class="form-control border-0 bg-light" value="{{$other_online_blind_cost[$i]}}" name="other_online_blind_cost[]"/></td>
                            <td>
                                <button class="btn btn-sm text-primary add-shipping-row">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-square-fill" viewBox="0 0 16 16">
                                        <path d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2zm6.5 4.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3a.5.5 0 0 1 1 0z"/>
                                    </svg>
                                </button>
                                <button class="btn btn-sm  remove-shipping-row ">
                                    <div class="text-secondary">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                            <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                            <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                                        </svg>
                                    </div>
                                </button>
                            </td>
                        </tr>
                        @endfor
                        @else
                            <tr class="shipping-row">
                                <th scope="row">1</th>
                                <td><input type="text" class="form-control border-0 bg-light" name="freight_surcharge[]" /></td>
                                <td><input type="text" class="form-control border-0 bg-light"  name="heyblind_cost[]"/></td>
                                <td><input type="text" class="form-control border-0 bg-light"  name="other_online_blind_cost[]"/></td>
                                <td>
                                    <button class="btn btn-sm text-primary add-shipping-row">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-square-fill" viewBox="0 0 16 16">
                                            <path d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2zm6.5 4.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3a.5.5 0 0 1 1 0z"/>
                                        </svg>
                                    </button>
                                    <button class="btn btn-sm  remove-shipping-row ">
                                        <div class="text-secondary">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                                <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                                <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                                            </svg>
                                        </div>
                                    </button>
                                </td>
                            </tr>
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="px-4 pb-4 text-end tab-btn-position">
{{--        <button class="btn btn-secondary info-submit " data-type="draft">Save Draft</button>--}}
        <button type="submit" class="btn btn-primary info-submit productBasicForm">Submit</button>
    </div>
</div>
</form>
