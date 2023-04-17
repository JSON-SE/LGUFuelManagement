<div class="accordion-item mt-3">
    <div class="accordion-header" id="headingTwo">
        <button class="accordion-button fw-semibold accordion-button-collapsed" type="button" data-bs-toggle="collapse"
            data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
            Select Your Options
            <span class="d-flex align-items-center justify-content-center">
                <img src="{{ asset('images/tick.png') }}" alt="">
            </span>
        </button>

    </div>
    <div id="collapseTwo" class="accordion-collapse collapse show border-0" aria-labelledby="headingTwo"
        data-bs-parent="#accordionPremium">

        <div class="accordion-body">

            <div class="row align-items-center">
                <div class="col-12">
                    <div id="heardrailerror" class="d-flex justify-content-end">

                    </div>

                </div>
                <div class="col-md-5">
                    <h6 class="accodin-heading"> Headrail
                        <span class="position-relative ms-1 mousuhover-out">
                            <span class="text-primary tooltip-hover question-icon ">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-question-circle-fill" viewBox="0 0 16 16">
                                    <path
                                        d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.496 6.033h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286a.237.237 0 0 0 .241.247zm2.325 6.443c.61 0 1.029-.394 1.029-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94 0 .533.425.927 1.01.927z">
                                    </path>
                                </svg>
                            </span>
                            <div class="tooltip shadow">
                                <div class="tooltip-arrow"></div>
                                <span class="close-tooltip btn-close btn"></span>
                                <div class="tooltip-inner">
                                    <div class="row g-2">
                                        <div class="col-12">
                                            {{ $headrailOption->headrail_toltip ?? 'The headrail is what holds together all of the components that operate your blind or shade.' }}
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
                                    <input id="headrail-option-1" value="0" name="headrail_option" type="radio"
                                        {{ $isEditProduct == true && isset($optionValue['headrail_option']) && $optionValue['headrail_option'] == 0 ? 'checked' : '' }}
                                        checked />

                                    <label for="headrail-option-1" class="radio-label">
                                        <div class="sample-features-img rounded">
                                            <img class="rounded"
                                                src="{{ asset('images/headrail/headrail1.png') }}" alt="" />
                                        </div>
                                        <div class="mt-2 mb-0 position-relative">
                                            <span class="h6 fw-bold">Standard </span>
                                        </div>
                                    </label>
                                </div>
                            </div>
                        </div>
                        @if (!empty($headrails->min('min_width')) && !empty($headrails->max('max_width')) && isset($headrailOption->headrail_status) && $headrailOption->headrail_status == 1)
                            <div class="sample-side-box border m-2 lift-choose-box">
                                <div class="rounded p-2">
                                    <div class="radio m-0 check-position">
                                        <input id="headrail-option-2" value="1" name="headrail_option" type="radio"
                                            {{ $isEditProduct == true && $optionValue['headrail_option'] == 1 ? 'checked' : '' }} />

                                        <label for="headrail-option-2" class="radio-label">
                                            <div class="sample-features-img rounded">
                                                <img class="rounded"
                                                    src="{{ asset('images/headrail/headrail2.png') }}" alt="" />
                                            </div>
                                            <div class="mt-2 mb-0 position-relative">
                                                <span class="h6 fw-bold">2 on 1
                                                    <span class="position-relative ms-1 mousuhover-out">
                                                        <span class="text-primary tooltip-hover question-icon ">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                                height="16" fill="currentColor"
                                                                class="bi bi-question-circle-fill" viewBox="0 0 16 16">
                                                                <path
                                                                    d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.496 6.033h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286a.237.237 0 0 0 .241.247zm2.325 6.443c.61 0 1.029-.394 1.029-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94 0 .533.425.927 1.01.927z">
                                                                </path>
                                                            </svg>
                                                        </span>
                                                        <div class="tooltip shadow">
                                                            <div class="tooltip-arrow"></div>
                                                            <span class="close-tooltip btn-close btn"></span>
                                                            <div class="tooltip-inner">

                                                                <div class="row g-2">
                                                                    <div class="col-12">
                                                                        @if (!empty($headrailOption->tooltip_description))
                                                                            <p>
                                                                                {{ $headrailOption->tooltip_description ?? '' }}
                                                                            </p>
                                                                        @else
                                                                            <p class="mb-0 hr-min-lenth">Minimum width
                                                                                must
                                                                                be {{ $headrails->min('min_width') }}
                                                                                inches.</p>
                                                                            <p class="mb-0 hr-min-lenth">Maximum width
                                                                                must
                                                                                not exceed
                                                                                {{ $headrails->max('max_width') }}
                                                                                inches.
                                                                            </p>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </span>
                                                </span>
                                            </div>
                                        </label>
                                    </div>
                                </div>

                            </div>
                        @endif
                    </div>

                </div>

            </div>


            <div id="premium-floating-headrail-option" class="cart-box p-4 rounded mt-3 headrail-arrow">
                <p class="mb-2"><b>Please select the width of each of your panels.</b></p>
                <hr class="my-0" />
                <div class="row py-3">
                    <div class="col-lg-6 pe-lg-4">
                        <div class="row g-2 align-items-end">
                            <div class="col-12 fw-semibold  font-secondary">Left Side</div>

                            <div class="col-md-auto">
                                <h5 class="border-start border-primary border-4 px-2 label-aria-text">Width:</h5>
                            </div>

                            <div class="col">
                                <div class="form-floating width-select-fild">
                                    <select class="form-select bg-transparent" name="headrail_left_filter_width"
                                        id="headrail_left_filter_width" aria-label="Floating label">
                                        {{-- @for ($h = $headrails->min('min_width') ?? 48; $h < $headrails->min('min_width') ?? 48; $h++) --}}
                                        @for ($h = 1; $h < 100; $h++)
                                            <option value="{{ $h }}">{{ $h }}</option>
                                        @endfor
                                    </select>
                                    <label for="floatingSelectGrid">Inches</label>
                                </div>
                            </div>

                            <div class="col">
                                <div class="form-floating width-select-fild">
                                    <select class="form-select bg-transparent" name="headrail_width_fraction_val"
                                        id="headrail_width_fraction_val" aria-label="Floating label ">
                                        <option value="0/0">0/0</option>
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
                        @if (!empty($headrailOption->left_status))
                            <div class="row g-2 align-items-end mt-2" {{-- {{$headrailOption->status ?? 0 == 1 ? '' : 'd-none'}}" --}}>
                                <div class="col-md-auto">
                                    <h5 class="border-start border-primary border-4 px-2 label-aria-text">Lift Position:
                                    </h5>
                                </div>
                                <div class="col">
                                    <div class="form-floating width-select-fild">
                                        <select class="form-select bg-transparent" name="headrail_left_lift_position"
                                            id="headrail_left_lift_position" aria-label="Floating label">
                                            @if ($headrailOption->left_status == 1)
                                                <option value="Left" selected>Left</option>
                                            @elseif($headrailOption->left_status == 2)
                                                <option value="Right" selected>Right</option>
                                            @elseif($headrailOption->left_status == 3)
                                                <option value="Left" selected>Left</option>
                                                <option value="Right">Right</option>
                                            @endif
                                        </select>
                                        <label for="floatingSelectGrid">Position</label>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                    <div class="d-block d-lg-none">
                        <hr />
                    </div>
                    <div class="col-lg-6 ps-lg-4 mt-lg-0">
                        <div class="row g-2 align-items-end">
                            <div class="col-12 fw-semibold font-secondary">Right Side</div>

                            <div class="col-md-auto">
                                <h5 class="border-start border-primary border-4 px-2 label-aria-text">Width:</h5>
                            </div>

                            <div class="col">
                                <div class="form-floating width-select-fild">
                                    <select class="form-select bg-transparent" name="headrail_filter_right_width"
                                        id="headrail_filter_right_width" aria-label="Floating label">
                                        @for ($h = 1; $h < 100 + 1; $h++)
                                            <option value="{{ $h }}">{{ $h }}</option>
                                        @endfor

                                    </select>
                                    <label for="floatingSelectGrid">Inches </label>
                                </div>
                            </div>

                            <div class="col">
                                <div class="form-floating width-select-fild">
                                    <select class="form-select bg-transparent" id="headrail_filter_right_fraction"
                                        name="headrail_filter_right_fraction" aria-label="Floating label">
                                        <option value="0/0">0/0</option>
                                        <option value="1/8">1/8</option>
                                        <option value="1/4">1/4</option>
                                        <option value="3/8">3/8</option>
                                        <option value="1/2">1/2</option>
                                        <option value="5/8">5/8</option>
                                        <option value="3/4">3/4 </option>
                                        <option value="7/8">7/8 </option>
                                    </select>
                                    <label for="floatingSelectGrid">Fraction </label>
                                </div>
                            </div>
                        </div>

                        @if (!empty($headrailOption->right_status))
                            <div class="row g-2 align-items-end mt-2 {{-- {{$headrailOption->status ?? 0  == 1 ? '' : 'd-none'}} --}}">
                                <div class="col-md-auto">
                                    <h5 class="border-start border-primary border-4 px-2 label-aria-text">Lift Position:
                                    </h5>
                                </div>


                                <div class="col">
                                    <div class="form-floating width-select-fild">
                                        <select class="form-select bg-transparent" name="headrail_right_lift_postion"
                                            id="headrail_right_lift_postion" aria-label="Floating label ">
                                            @if ($headrailOption->right_status == 1)
                                                <option value="Left" selected>Left</option>
                                            @elseif($headrailOption->right_status == 2)
                                                <option value="Right" selected>Right</option>
                                            @elseif($headrailOption->right_status == 3)
                                                <option value="Right" selected>Right</option>
                                                <option value="Left">Left</option>

                                            @endif
                                        </select>
                                        <label for="floatingSelectGrid">Position</label>
                                    </div>
                                </div>


                            </div>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@push('js')
    <script type="text/javascript">
        document.addEventListener('DOMContentLoaded', () => {
            $('#headrail-option-2').attr("disabled", 'disabled');
            var headrailVal = $('[name=headrail_option]:checked').val();
            if (headrailVal == 1) {
                $("#premium-floating-headrail-option").slideDown();
            } else {
                $("#premium-floating-headrail-option").slideUp();
            }

            // Headrail Min and Max Width
            const headrail_min_width = "{{ $headrails->min('min_width') }}";
            const headrail_max_width = "{{ $headrails->max('max_width') }}";


            // DOM Elements
            const globalWidthElem = document.querySelector('select[name="option_width"]');
            const globalWidthFractionElem = document.querySelector('select[name="option_width_fraction"]');
            const headrailStandardElem = document.querySelector('#headrail-option-1');
            const headrailTwoOnOneElem = document.querySelector('#headrail-option-2');
            const leftSideWidthElem = document.querySelector('#headrail_left_filter_width');
            const rightSideWidthElem = document.querySelector('#headrail_filter_right_width');
            const leftSideFractionElem = document.querySelector('#headrail_width_fraction_val');
            const rightSideFractionElem = document.querySelector('#headrail_filter_right_fraction');

            function headrailWidthCalculator() {
                const globalWidthValNum = parseInt(globalWidthElem.value);
                const globalWidthFractionVal = globalWidthFractionElem.value;
                const globalWidthFractionValNum = isNaN(quotient(globalWidthFractionVal)) ? 0 : quotient(
                    globalWidthFractionVal);
                if (globalWidthValNum + globalWidthFractionValNum < parseInt(headrail_min_width) ||
                    globalWidthValNum + globalWidthFractionValNum > parseInt(headrail_max_width)) {
                    $('#headrail-option-2').attr("disabled", 'disabled');
                    $('#headrail-option-2').prop('checked', false);
                    $("#premium-floating-headrail-option").slideUp();
                } else {
                    $('#headrail-option-2').removeAttr('disabled');
                    const globalWidthValNumRemainder = globalWidthValNum % 2;

                    if (globalWidthValNumRemainder === 0 && globalWidthFractionValNum === 0) {
                        leftSideWidthElem.value = `${globalWidthValNum / 2}`;
                        rightSideWidthElem.value = `${globalWidthValNum / 2}`;
                        leftSideFractionElem.value = '0/0';
                        rightSideFractionElem.value = '0/0';
                    } else if (globalWidthValNumRemainder === 1 && globalWidthFractionValNum === 0) {
                        leftSideWidthElem.value = `${parseInt(globalWidthValNum / 2)}`;
                        rightSideWidthElem.value = `${parseInt(globalWidthValNum / 2)}`;
                        leftSideFractionElem.value = '1/2';
                        rightSideFractionElem.value = '1/2';
                    } else if (globalWidthValNumRemainder === 0 && globalWidthFractionValNum !== 0) {
                        leftSideWidthElem.value = `${globalWidthValNum / 2}`;
                        rightSideWidthElem.value = `${globalWidthValNum / 2}`;
                        if (globalWidthFractionVal === '1/4') {
                            leftSideFractionElem.value = '1/8';
                            rightSideFractionElem.value = '1/8';
                        } else if (globalWidthFractionVal === '5/8') {
                            leftSideFractionElem.value = '3/8';
                            rightSideFractionElem.value = '1/4';
                        } else if (globalWidthFractionVal === '7/8') {
                            leftSideFractionElem.value = '1/2';
                            rightSideFractionElem.value = '3/8';
                        } else if (globalWidthFractionVal === '3/8') {
                            leftSideFractionElem.value = '1/4';
                            rightSideFractionElem.value = '1/8';
                        } else if (globalWidthFractionVal === '3/4') {
                            leftSideFractionElem.value = '1/2';
                            rightSideFractionElem.value = '1/4';
                        } else {
                            leftSideFractionElem.value = globalWidthFractionVal;
                            rightSideFractionElem.value = '0/0';
                        }
                    } else {
                        leftSideWidthElem.value = `${parseInt(globalWidthValNum / 2)}`;
                        rightSideWidthElem.value =
                            `${parseInt(globalWidthValNum / 2) + globalWidthValNumRemainder}`; // => globalWidthValNumRemainder = 1
                        if (globalWidthFractionVal === '1/4') {
                            leftSideFractionElem.value = '1/8';
                            rightSideFractionElem.value = '1/8';
                        } else if (globalWidthFractionVal === '5/8') {
                            leftSideFractionElem.value = '3/8';
                            rightSideFractionElem.value = '1/4';
                        } else if (globalWidthFractionVal === '7/8') {
                            leftSideFractionElem.value = '1/2';
                            rightSideFractionElem.value = '3/8';
                        } else if (globalWidthFractionVal === '3/8') {
                            leftSideFractionElem.value = '1/4';
                            rightSideFractionElem.value = '1/8';
                        } else if (globalWidthFractionVal === '3/4') {
                            leftSideFractionElem.value = '1/2';
                            rightSideFractionElem.value = '1/4';
                        } else {
                            leftSideFractionElem.value = globalWidthFractionVal;
                            rightSideFractionElem.value = '0/0';
                        }
                    }

                }
            }

            // Adding Eventlistener To The DOM Elements
            globalWidthElem.addEventListener('change', headrailWidthCalculator);
            globalWidthFractionElem.addEventListener('change', headrailWidthCalculator);
            headrailWidthCalculator()

            // Utility Functions
            function quotient(pole) {
                const poleArr = pole.split('/');
                const dividend = parseInt(poleArr[0]);
                const divisor = parseInt(poleArr[1]);
                let quotient;
                if (dividend === 0 & divisor === 0) {
                    quotient = 0
                } else {
                    quotient = dividend / divisor;
                }
                return quotient
            }

            //Headrail 2 on 1 width toggler
            $('[name=headrail_option]').on('change', function(e) {
                e.preventDefault();
                var headrailVal = $(this).val();
                if (headrailVal == 1) {
                    $("#premium-floating-headrail-option").slideDown();
                } else {
                    $("#premium-floating-headrail-option").slideUp();
                }
            });
        })
    </script>

@endpush
