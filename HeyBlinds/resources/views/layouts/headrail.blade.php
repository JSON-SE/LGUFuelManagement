<div class="accordion-item mt-3">
    <div class="accordion-header" id="headingTwo">
        <button class="accordion-button fw-semibold accordion-button-collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
            Select Your Options
            <span class="d-flex align-items-center justify-content-center">
                <img src="{{ asset('images/tick.png')}}" alt="">
            </span>
        </button>

    </div>
    <div id="collapseTwo" class="accordion-collapse collapse show border-0" aria-labelledby="headingTwo" data-bs-parent="#accordionPremium">
        <div class="accordion-body">
            <div class="row align-items-center">
                
                <div class="col-12">
                    Abc
                     
                </div>
                
                <div class="col-md-5">
                    <h6 class="accodin-heading"> Headrail
                        <span class="position-relative ms-1 mousuhover-out">
                            <span class="text-primary tooltip-hover question-icon ">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-question-circle-fill" viewBox="0 0 16 16">
                                    <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.496 6.033h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286a.237.237 0 0 0 .241.247zm2.325 6.443c.61 0 1.029-.394 1.029-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94 0 .533.425.927 1.01.927z">
                                    </path>
                                </svg>
                            </span>
                            <div class="tooltip shadow">
                                <div class="tooltip-arrow"></div>
                                <span class="close-tooltip btn-close btn"></span>
                                <div class="tooltip-inner">
                                    <div class="row g-2">
                                        <div class="col-12">
                                            Most customers prefer to mount their blinds inside the window frame. It gives a neater, more tailored look,
                                            without covering any details of the window or the surrounding decorative moulding.
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </span>
                    </h6>

                </div>

                <div class="col-md-12 mt-1 mt-md-0">
                    <div class="d-flex flex-wrap">

                        <div class="sample-side-box border m-2 lift-choose-box">
                            <div class="rounded  p-2">
                                <div class="radio m-0 check-position">
                                    <input id="headrail-option-1" value="0" name="headrail-option" type="radio"/>

                                    <label for="headrail-option-1" class="radio-label">
                                        <div class="sample-features-img rounded">
                                            <img class="rounded" src="{{ asset('images/head-rail-image-1.png')}}" alt="" />
                                        </div>
                                        <div class="mt-2 mb-0 position-relative">
                                            <span class="h6 fw-bold">Standard</span>
                                         </div>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="sample-side-box border m-2 lift-choose-box">
                            
                            <div class="rounded p-2">
                                <div class="radio m-0 check-position">
                                    <input id="headrail-option-2" value="1" name="headrail-option" type="radio"/>

                                    <label for="headrail-option-2" class="radio-label">
                                        <div class="sample-features-img rounded">
                                            <img class="rounded" src="{{ asset('images/head-rail-image-2.png')}}" alt="" />
                                        </div>
                                        <div class="mt-2 mb-0 position-relative">
                                            <span class="h6 fw-bold">2 Shades on 1 Headrail</span>
                                         </div>
                                    </label>
                                </div>
                            </div>
                            
                        </div>

                    </div>
                        

                </div>



                    {{-- <div class="form-floating">
                        <select class="form-select" id="premium-floating-headrail" aria-label="Floating label" name="headrail_price">
                            <option value="0">Standard</option>
                            @if(!empty($cartItem))
                            <option value="1" {{$cartItem->isHeadrailActive() == true ? 'selected' : ''}}>2 Shades on 1 Headrail</option>
                            @else
                            <option value="1">2 Shades on 1 Headrail</option>
                            @endif

                        </select>
                        <label for="premium">Click to Choose Headrail</label>
                        <span class="headrail-price bg-primary text-white rounded position-absolute top-50 end-0 me-5 translate-middle-y py-1 px-2">+ ${{$product->headrail_price ?? 0}}</span>
                    </div> --}}
                </div>
            

            <div id="premium-floating-headrail-option" class="cart-box p-4 rounded mt-3">
                <p class="mb-1">Split Headrail Options *(<b>2 on 1 Headrail: Minimum width: 48 inches</b>)</p>
                <hr class="my-0"/>
                <div class="row py-3">
                    <div class="col-lg-6 pe-lg-4">
                        <div class="row g-2 align-items-end">
                            <div class="col-12 fw-semibold  font-secondary">Left Shades</div>

                            <div class="col-md-auto">
                                <h5 class="border-start border-primary border-4 px-2 label-aria-text">Width:</h5>
                            </div>

                            <div class="col">
                                <div class="form-floating width-select-fild">
                                    <select class="form-select bg-transparent" name="headrail_filter_width" id="headrail_filter_width" aria-label="Floating label select example">
                                        @for($h = $splitWidth[0]; $h < $splitWidth[1]+1; $h++ )
                                            <option value="{{$h}}">{{$h}}</option>
                                        @endfor
                                    </select>
                                    <label for="floatingSelectGrid">Inches</label>
                                </div>
                            </div>

                            <div class="col">
                                <div class="form-floating width-select-fild">
                                    <select class="form-select bg-transparent" name="headrail_width_fraction_val" id="headrail_width_fraction_val" aria-label="Floating label ">
                                        <option value="">0/0</option>
                                        <option value="1/8">1/8</option>
                                        <option value="1/4">1/4</option>
                                        <option value="3/8">3/8</option>
                                        <option value="1/2">1/2</option>
                                        <option value="5/8">5/8</option>
                                        <option value="3/4">3/4 </option>
                                        <option value="7/8">7/8 </option>
                                    </select>
                                    <label for="floatingSelectGrid">Fractions</label>
                                </div>
                            </div>

                        </div>

                        <div class="row g-2 align-items-end mt-2">
                            <div class="col-md-auto">
                                <h5 class="border-start border-primary border-4 px-2 label-aria-text">Lift Position:</h5>
                            </div>
                            <div class="col">
                                <div class="form-floating width-select-fild">
                                    <select class="form-select bg-transparent" name="headrail_left_lift_position" id="headrail_left_lift_position" aria-label="Floating label select">
                                        <option value="Left" selected>Left</option>
                                    </select>
                                    <label for="floatingSelectGrid">Position</label>
                                </div>
                            </div>


                        </div>

                    </div>
                    <div class="d-block d-lg-none"><hr /></div>
                    <div class="col-lg-6 ps-lg-4 mt-lg-0">
                        <div class="row g-2 align-items-end">
                            <div class="col-12 fw-semibold font-secondary">Right shades</div>

                            <div class="col-md-auto">
                                <h5 class="border-start border-primary border-4 px-2 label-aria-text">Width:</h5>
                            </div>

                            <div class="col">
                                <div class="form-floating width-select-fild">
                                    <select class="form-select bg-transparent" name="headrail_filter_right_width" id="headrail_filter_right_width" aria-label="Floating label">
                                        @for($h = $splitWidth[0]; $h < $splitWidth[1]+1; $h++ )
                                            <option value="{{$h}}" >{{$h}}</option>
                                        @endfor

                                    </select>
                                    <label for="floatingSelectGrid">Inches</label>
                                </div>
                            </div>

                            <div class="col">
                                <div class="form-floating width-select-fild">
                                    <select class="form-select bg-transparent" id="headrail_filter_right_fraction" name="headrail_filter_right_fraction" aria-label="Floating label">
                                        <option value="">0/0</option>
                                        <option value="1/8">1/8</option>
                                        <option value="1/4">1/4</option>
                                        <option value="3/8">3/8</option>
                                        <option value="1/2">1/2</option>
                                        <option value="5/8">5/8</option>
                                        <option value="3/4">3/4 </option>
                                        <option value="7/8">7/8 </option>
                                    </select>
                                    <label for="floatingSelectGrid">Fractions</label>
                                </div>
                            </div>
                        </div>

                        <div class="row g-2 align-items-end mt-2">
                            <div class="col-md-auto">
                                <h5 class="border-start border-primary border-4 px-2 label-aria-text">Lift Position:</h5>
                            </div>

                            <div class="col">
                                <div class="form-floating width-select-fild">
                                    <select class="form-select bg-transparent" name="headrail_right_lift_postion" id="headrail_right_lift_postion" aria-label="Floating label ">
                                        <option value="Right" selected>Right</option>
                                    </select>
                                    <label for="floatingSelectGrid">Position</label>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@push('js')
<script type="text/javascript">
    $(function() {
        var headrailVal = $("#premium-floating-headrail").val();
            if( headrailVal == 1){
                $("#premium-floating-headrail-option").slideDown();
                //$("#premium-floating-headrail-option").css('display','block');
                $('.headrail-price').fadeIn();
            }else{
                $("#premium-floating-headrail-option").slideUp();
               // $("#premium-floating-headrail-option").css('display','none');
                $('.headrail-price').fadeOut();
            }
        var option_width =$('[name=option_width]').val();
        const value =  option_width/2;
        $('#headrail_filter_width').val(parseInt(value));
        $('#headrail_filter_right_width').val(parseInt(value));

        var option_width_fraction = $('[name=option_width_fraction]').val();
        $('#headrail_width_fraction_val').val(option_width_fraction);
        var option_height_fraction = $('[name=option_height_fraction]').val();
        $('#headrail_filter_right_fraction').val(option_height_fraction);

         //    if(isFloat(value) == true){
        //         $('#headrail_width_fraction_val').val('1/2');
        //         $('#headrail_filter_right_fraction').val('1/2');
        //    }
        //    else{
        //         $('#headrail_width_fraction_val').val('0/0');
        //         $('#headrail_filter_right_fraction').val('0/0');
        //    }
    })
    function isFloat(x) { return !!(x % 1); }
    $('[name=option_width]').on('change',function(e){
        e.preventDefault();
        const value =  $(this).val()/2;
       $('#headrail_filter_width').val(parseInt(value));
       $('#headrail_filter_right_width').val(parseInt(value));
       // if(isFloat(value) == true){
       //      $('#headrail_width_fraction_val').val('1/2');
       //      $('#headrail_filter_right_fraction').val('1/2');
       // }
       // else{
       //      $('#headrail_width_fraction_val').val('0/0');
       //      $('#headrail_filter_right_fraction').val('0/0');
       // }
    });
    $('[name=option_width_fraction]').on('change',function(e){
        var fraction_value = $(this).val();
        $('#headrail_width_fraction_val').val(fraction_value);
    })
     $('[name=option_height_fraction]').on('change',function(e){
        var fraction_value = $(this).val();
        $('#headrail_filter_right_fraction').val(fraction_value);
     })

        $('.headrail-price').fadeOut();
        $("#premium-floating-headrail").on('change', function () {
            var headrailVal = $("#premium-floating-headrail").val();
            if( headrailVal == 1){
                $("#premium-floating-headrail-option").slideDown();
                $('.headrail-price').fadeIn();
            }else{
                $("#premium-floating-headrail-option").slideUp();
                $('.headrail-price').fadeOut();
            }
        });





        $(document).ready(function() {
            $("input[name='headrail-option']").click(function() {
                if($(this).val() == 1) {
                    $("#premium-floating-headrail-option").slideDown();           
                }
                else {
                    $("#premium-floating-headrail-option").slideUp();   
                }
            });
        });
</script>

@endpush