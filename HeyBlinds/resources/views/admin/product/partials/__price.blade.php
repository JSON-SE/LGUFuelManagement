<form action="" enctype="multipart/form-data">
    @csrf
    <div class="pt-2">
        <div class="row pt-2">
            <div class="col-12">
                <label>Please upload documents only in 'CSV' format.</label>
            </div>
            <div class="col-md-4 col-6 mt-2">
                <div class="fileUpload btn btn-orange d-flex align-items-center">
                    <img src="{{asset('images/demo-file.svg')}}" class="icon">
                    <p class="upl ps-2 small mb-0" id="upload">Upload your price document</p>
                    <input type="file" class="upload up" id="upExcelFile" onchange="readURL(this);" />
                </div>
            </div>
            <div class="col-md-4 col-6 mt-2">
                <button class="btn btn-primary h-100 px-4" id="uploadPriceSheet">Upload</button>
            </div>
        </div>
        <div class="mt-3 pb-2">
            <div class="table-responsive scrollbar">
                <table class="table table-striped pricetable">
                    <thead class="text-white">
                    <tr>
                        <th style="width: 5%">
                            Width
                            <span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                     height="16" fill="currentColor"
                                     class="bi bi-arrow-right-short" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd"
                                          d="M4 8a.5.5 0 0 1 .5-.5h5.793L8.146 5.354a.5.5 0 1 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.293 8.5H4.5A.5.5 0 0 1 4 8z" />
                                </svg>
                            </span>
                            <br>
                            Height
                            <span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                     height="16" fill="currentColor"
                                     class="bi bi-arrow-down-short" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd"
                                          d="M8 4a.5.5 0 0 1 .5.5v5.793l2.146-2.147a.5.5 0 0 1 .708.708l-3 3a.5.5 0 0 1-.708 0l-3-3a.5.5 0 1 1 .708-.708L7.5 10.293V4.5A.5.5 0 0 1 8 4z" />
                                </svg>
                            </span>
                        </th>
                        @foreach($uniqueWidths as $uniqueWidth)
                            <th class="text-center">
                                <div class="d-flex align-items-center justify-content-center">
                                    <span class="inner"><input class="table-input" type="number" data-value="{{trim($uniqueWidth->width)}}" data-type="width" value="{{trim($uniqueWidth->width)}}" readonly/> </span>
                                </div>
                            </th>
                        @endforeach
                    </tr>
                    </thead>
                    <tbody class="text-center">
                    @foreach($outer_array as $priceKey => $price)
                        <tr class="price-row">
                            <td>
                                <div
                                    class="d-flex align-items-center justify-content-center text-white">
                                    <span class="inner"><input class="table-input" type="number" data-type="height"  data-value="{{trim($priceKey)}}" value="{{trim($priceKey)}}" readonly/> </span>
                                </div>
                            </td>
                            @foreach($price as $key => $p)
                                <td><span class="inner"><input class="table-input" type="number" value="{{trim($p['price'])}}" data-id="{{trim($p['id'])}}" readonly/> </span></td>
                            @endforeach
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-between mt-3">
                <div class="">
                    <a href="javascript:void(0)"
                       class="btn advanced-settings btn-secondary d-flex align-items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                             fill="currentColor" class="bi bi-gear" viewBox="0 0 16 16">
                            <path
                                d="M8 4.754a3.246 3.246 0 1 0 0 6.492 3.246 3.246 0 0 0 0-6.492zM5.754 8a2.246 2.246 0 1 1 4.492 0 2.246 2.246 0 0 1-4.492 0z" />
                            <path
                                d="M9.796 1.343c-.527-1.79-3.065-1.79-3.592 0l-.094.319a.873.873 0 0 1-1.255.52l-.292-.16c-1.64-.892-3.433.902-2.54 2.541l.159.292a.873.873 0 0 1-.52 1.255l-.319.094c-1.79.527-1.79 3.065 0 3.592l.319.094a.873.873 0 0 1 .52 1.255l-.16.292c-.892 1.64.901 3.434 2.541 2.54l.292-.159a.873.873 0 0 1 1.255.52l.094.319c.527 1.79 3.065 1.79 3.592 0l.094-.319a.873.873 0 0 1 1.255-.52l.292.16c1.64.893 3.434-.902 2.54-2.541l-.159-.292a.873.873 0 0 1 .52-1.255l.319-.094c1.79-.527 1.79-3.065 0-3.592l-.319-.094a.873.873 0 0 1-.52-1.255l.16-.292c.893-1.64-.902-3.433-2.541-2.54l-.292.159a.873.873 0 0 1-1.255-.52l-.094-.319zm-2.633.283c.246-.835 1.428-.835 1.674 0l.094.319a1.873 1.873 0 0 0 2.693 1.115l.291-.16c.764-.415 1.6.42 1.184 1.185l-.159.292a1.873 1.873 0 0 0 1.116 2.692l.318.094c.835.246.835 1.428 0 1.674l-.319.094a1.873 1.873 0 0 0-1.115 2.693l.16.291c.415.764-.42 1.6-1.185 1.184l-.291-.159a1.873 1.873 0 0 0-2.693 1.116l-.094.318c-.246.835-1.428.835-1.674 0l-.094-.319a1.873 1.873 0 0 0-2.692-1.115l-.292.16c-.764.415-1.6-.42-1.184-1.185l.159-.291A1.873 1.873 0 0 0 1.945 8.93l-.319-.094c-.835-.246-.835-1.428 0-1.674l.319-.094A1.873 1.873 0 0 0 3.06 4.377l-.16-.292c-.415-.764.42-1.6 1.185-1.184l.292.159a1.873 1.873 0 0 0 2.692-1.115l.094-.319z" />
                        </svg>
                        <span class="d-none d-md-block ps-1">Advanced Settings</span>
                    </a>
                </div>
            </div>
        </div>
        <hr />
        <div class="advanced-settings-setion">
            <div class="row ">
                <div class="col-lg-2 mt-3">
                    <h6 class="pb-2">Edit Price By</h6>
                    <div class="radio-box my-1 pb-2">
                        <input type="radio" id="test1" name="radio-group" checked>
                        <label for="test1">Percentage</label>
                    </div>
                    <div class="radio-box mt-2">
                        <input type="radio" id="test2" name="radio-group">
                        <label for="test2">Fixed</label>
                    </div>
                </div>
                <div class="col-lg-2 mt-3">
                    <h6 class="pb-2">Apply To</h6>
                    <div class="radio-box my-1 pb-2">
                        <input type="radio" id="test3" name="radio-group1" checked>
                        <label for="test3">Whole table</label>
                    </div>
                    <div class="radio-box mt-2">
                        <input type="radio" id="test4" name="radio-group1">
                        <label for="test4">Selection</label>
                    </div>
                </div>
                <div class="col-lg-2 mt-3">
                    <div class="quantity">
                        <div class="form-floating">
                            <input type="text" class="form-control count pe-5" type="text"
                                   id="1" value="1" min="1" max="100" placeholder="Enter Value">
                            <label for="">Enter Value</label>
                            <button type="button" id="add" class="add">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                     fill="currentColor" class="bi bi-caret-up-fill"
                                     viewBox="0 0 16 16">
                                    <path
                                        d="M7.247 4.86l-4.796 5.481c-.566.647-.106 1.659.753 1.659h9.592a1 1 0 0 0 .753-1.659l-4.796-5.48a1 1 0 0 0-1.506 0z">
                                    </path>
                                </svg>
                            </button>
                            <button type="button" id="sub" class="sub">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                     fill="currentColor" class="bi bi-caret-down-fill"
                                     viewBox="0 0 16 16">
                                    <path
                                        d="M7.247 11.14L2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z">
                                    </path>
                                </svg>
                            </button>
                        </div>

                    </div>

                    <div class="form-floating mt-2">
                        <input type="text" class="form-control" type="text"
                               placeholder="Enter Value">
                        <label for="">Supplier Discount</label>

                    </div>

                </div>

                <div class="col-lg-3 mt-3">
                    <div class="form-floating">
                        <input type="text" class="form-control" type="text"
                               placeholder="Enter Value">
                        <label for="">Domestic Markup</label>
                    </div>


                    <div class="form-floating mt-2">
                        <input type="text" class="form-control" type="text"
                               placeholder="Enter Value">
                        <label for="">Contract Markup</label>
                    </div>


                </div>

                <div class="col-lg-3 mt-3">
                    <div class="form-floating">
                        <input type="text" class="form-control" type="text"
                               placeholder="Enter Value">
                        <label for="">Trede Markup</label>

                    </div>
                    <div class="form-floating mt-2">
                        <input type="text" class="form-control" type="text"
                               placeholder="Enter Value">
                        <label for="">Ecommerce Markup</label>
                    </div>
                </div>
                <div class="col-lg-2 mt-3">
                    <div class="check-box">
                        <input type="checkbox" id="order1" name="order1" value="order1">
                        <label for="order1">Hide price on order</label>
                    </div>
                </div>
                <div class="col-lg-3 mt-3">
                    <div class="check-box">
                        <input type="checkbox" id="order1" name="order1" value="order1">
                        <label for="order1">Prices inclusive of val</label>
                    </div>
                </div>
            </div>
            <div class="px-4 pb-4 text-end tab-btn-position">
                {{-- <button class="btn btn-secondary info-submit " data-type="draft">Save Draft</button>--}}
                <button type="submit" class="btn btn-primary info-submit productBasicForm">Submit</button>
            </div>
        </div>
    </div>
</form>
