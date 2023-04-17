@extends('layouts.Frontend.app')
@section('title')
   Blinds | Custom Blinds and Shades Online | Window Coverings | Hey Blinds Canada
@endsection

@section('content')
    <section class="container">
        <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);"
            aria-label="breadcrumb">
            <ol class="breadcrumb mb-2 pt-2">
                <li class="breadcrumb-item"><a href="{{route('welcome')}}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{route('welcome')}}">Blinds & Shades</a></li>
                <li class="breadcrumb-item"><a href="{{route('welcome')}}">Honeycomb/Cellular Shades</a></li>
                <li class="breadcrumb-item active" aria-current="page">Light Filtering Cordless Cellular/Honeycomb Shades</li>
            </ol>
        </nav>

    </section>

    <section id="body-content">
        <div class="container py-lg-5 py-4">
            <div class="row mb-view-row relative" style="transform: none;">
                <div class="col-lg-8 col-md-7" style="transform: none;">
                    <h2 class=" d-block px-4 py-2 bg-secondary text-white h5 rounded">Select Your Size</h2>
                    <div class="row py-3">
                        <div class="col-6 pe-lg-4">
                            <div class="row g-2 align-items-end">
                                <div class="col-md-auto">
                                    <h5 class="border-start border-primary border-4 px-2 label-aria-text">Width:</h5>
                                </div>
                                <div class="col">
                                    <div class="form-floating width-select-fild">
                                        <select class="form-select" name="filter_width" id="filter_width" aria-label="Floating label select example">
                                            <option value="">00</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                            <option value="6">6</option>
                                        </select>
                                        <label for="floatingSelectGrid">Inches</label>
                                    </div>
                                </div>

                                <div class="col">
                                    <div class="form-floating width-select-fild">
                                        <select class="form-select" name="width_fraction_val" id="filter_width_fraction" aria-label="Floating label select example">
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
                        </div>

                        <div class="col-6 ps-lg-4 ">
                            <div class="row g-2 align-items-end">
                                <div class="col-md-auto">
                                    <h5 class="border-start border-primary border-4 px-2 label-aria-text">Height:</h5>
                                </div>
                                <div class="col">
                                    <div class="form-floating width-select-fild">
                                        <select class="form-select" name="filter_height" id="filter_height" aria-label="Floating label select example">
                                            <option value="">00</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                            <option value="6">6</option>
                                              
                                        </select>
                                        <label for="floatingSelectGrid">Inches</label>
                                    </div>
                                </div>

                                <div class="col">
                                    <div class="form-floating width-select-fild">
                                        <select class="form-select" id="filter_height_fraction" name="filter_height_fraction" aria-label="Floating label select example">
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
                        </div>
                    </div>


                    <h2 class=" d-block px-4 py-2 bg-secondary text-white h5 rounded mt-4">Select Your Options</h2>

                    <div>
                        {{-- <div class="row align-items-center">
                            <div class="col-md-5">
                                <h6 class="fw-semibold">Color 
                                    <a href="javascript:void(0)" class="ms-2" id="premiumColorModal" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-zoom-in" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd" d="M6.5 12a5.5 5.5 0 1 0 0-11 5.5 5.5 0 0 0 0 11zM13 6.5a6.5 6.5 0 1 1-13 0 6.5 6.5 0 0 1 13 0z"/>
                                            <path d="M10.344 11.742c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1 6.538 6.538 0 0 1-1.398 1.4z"/>
                                            <path fill-rule="evenodd" d="M6.5 3a.5.5 0 0 1 .5.5V6h2.5a.5.5 0 0 1 0 1H7v2.5a.5.5 0 0 1-1 0V7H3.5a.5.5 0 0 1 0-1H6V3.5a.5.5 0 0 1 .5-.5z"/>
                                        </svg>
                                        <span class="p fw-normal">(Click to zoom)</span>
                                    </a>
                                </h6>
                            </div>

                            <div class="col-md-7">
                                <div class="dropdown">
                                    <button class="btn d-flex justify-content-between align-items-center dropdown-toggle border w-100 text-start" type="button" id="premiumColorDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                        Click to Choose Color
                                    </button>
                                    <ul class="dropdown-menu premium-color-dropdown scrollbar-style" aria-labelledby="premiumColorDropdown">
                                        <li>
                                            <a class="dropdown-item" href="#"><span class="premium-color-group">
                                                <span>
                                                    <span>
                                                        <img class="rounded premium-color-image me-2" src="{{ asset('images/natural.svg') }}" alt="" />
                                                    </span> 
                                                    Natural
                                                </span>
                                            </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="#"><span class="premium-color-group">
                                                <span>
                                                    <span>
                                                        <img class="rounded premium-color-image me-2" src="{{ asset('images/pink.svg') }}" alt="" />
                                                    </span> 
                                                        Pink
                                                </span>
                                            </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="#"><span class="premium-color-group">
                                                <span>
                                                    <span>
                                                        <img class="rounded premium-color-image me-2" src="{{ asset('images/silver-grey.svg') }}" alt="" />
                                                    </span> 
                                                    Silver Grey
                                                </span>
                                            </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="#"><span class="premium-color-group">
                                                <span>
                                                    <span>
                                                        <img class="rounded premium-color-image me-2" src="{{ asset('images/yellow-gold.svg') }}" alt="" />
                                                    </span> 
                                                    Yellow Gold
                                                </span>
                                            </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="#"><span class="premium-color-group">
                                                <span>
                                                    <span>
                                                        <img class="rounded premium-color-image me-2" src="{{ asset('images/green.svg') }}" alt="" />
                                                    </span> 
                                                    Green
                                                </span>
                                            </a>
                                        </li>
                                        
                                       
                                    </ul>
                                </div>
                            </div>

                        </div> --}}


                        <div class="accordion premium-plain-accordion" id="accordionPremium">

                            {{-- <div class="accordion-item mt-3">
                              <div class="accordion-header" id="headingOne">
                                <div class="row align-items-center"> 
                                    <div class="col-md-5">
                                        <button class="accordion-button fw-semibold collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                            Mount 
                                            <strong class="ms-2">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-question-circle-fill" viewBox="0 0 16 16">
                                                    <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.496 6.033h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286a.237.237 0 0 0 .241.247zm2.325 6.443c.61 0 1.029-.394 1.029-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94 0 .533.425.927 1.01.927z"/>
                                                </svg>
                                            </strong>
                                        </button>
                                    </div>

                                    <div class="col-md-7 mt-1 mt-md-0">
                                        <div class="form-floating">
                                            <select class="form-select" id="floatingSelect" aria-label="Floating label select example">
                                              <option >Choose Mount Type</option>
                                              <option value="1">Inside</option>
                                              <option value="2">Outside</option>
                                            </select>
                                            <label for="floatingSelect">Click to Choose Mount Type</label>
                                        </div>
                                    </div>
                                </div>
                              </div>

                              <div id="collapseOne" class="accordion-collapse collapse " aria-labelledby="headingOne" data-bs-parent="#accordionPremium">
                                <div class="accordion-body p-0 pt-2">
                                    <div class="cart-box p-4 rounded">
                                        <p class="mb-0">Most customers prefer to mount their blinds inside the window frame. It gives a neater, more tailored look, 
                                            without covering any details of the window or the surrounding decorative moulding.</p>
                                    </div>
                                </div>
                              </div>
                            </div> --}}

                            <div class="accordion-item mt-3">
                              <div class="accordion-header" id="headingTwo">
                                <div class="row align-items-center"> 
                                    <div class="col-md-5">
                                        <button class="accordion-button fw-semibold collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                            Headrail
                                            <strong class="ms-2">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-question-circle-fill" viewBox="0 0 16 16">
                                                    <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.496 6.033h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286a.237.237 0 0 0 .241.247zm2.325 6.443c.61 0 1.029-.394 1.029-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94 0 .533.425.927 1.01.927z"/>
                                                </svg>
                                            </strong>
                                        </button>
                                    </div>

                                    <div class="col-md-7 mt-1 mt-md-0">
                                        <div class="form-floating">
                                            <select class="form-select" id="premium-floating-headrail" aria-label="Floating label select example">
                                                <option value="0">Standard</option>
                                                <option value="1">2 Shades on 1 Headrail</option>
                                                <option value="2">Standard</option>
                                                <option value="3">Standard</option>
                                            </select>
                                            <label for="premium">Click to Choose Headrail</label>
                                        </div>
                                    </div>
                                </div>
                              </div>
                              <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionPremium">
                                <div class="accordion-body p-0  pt-2">
                                    <div class="cart-box p-4 rounded">
                                        <p class="mb-0">Most customers prefer to mount their blinds inside the window frame. It gives a neater, more tailored look, 
                                            without covering any details of the window or the surrounding decorative moulding.</p>

                                    </div>
                                </div>
                              </div>
                            </div>

                            <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionPremium">
                                <div class="accordion-body p-0  pt-2">
                                    <div class="cart-box p-4 rounded">
                                        <p class="mb-0">Most customers prefer to mount their blinds inside the window frame. It gives a neater, more tailored look, 
                                            without covering any details of the window or the surrounding decorative moulding.</p>

                                    </div>
                                </div>
                            </div>

                            <div id="premium-floating-headrail-option" class="cart-box p-4 rounded mt-3">
                                <p class="mb-1">Split Headrail Options</p>
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
                                                    <select class="form-select bg-transparent" name="filter_width" id="filter_width" aria-label="Floating label select example">
                                                        <option value="">00</option>
                                                        <option value="1">1</option>
                                                        <option value="2">2</option>
                                                        <option value="3">3</option>
                                                        <option value="4">4</option>
                                                        <option value="5">5</option>
                                                        <option value="6">6</option>
                                                    </select>
                                                    <label for="floatingSelectGrid">Inches</label>
                                                </div>
                                            </div>
            
                                            <div class="col">
                                                <div class="form-floating width-select-fild">
                                                    <select class="form-select bg-transparent" name="width_fraction_val" id="filter_width_fraction" aria-label="Floating label select example">
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
                                                    <select class="form-select bg-transparent" name="filter_width" id="filter_width" aria-label="Floating label select example">
                                                        <option value="" selected>Left</option>
                                                        <option value="1" >Right</option>
                                                        
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
                                                <h5 class="border-start border-primary border-4 px-2 label-aria-text">Height:</h5>
                                            </div>

                                            <div class="col">
                                                <div class="form-floating width-select-fild">
                                                    <select class="form-select bg-transparent" name="filter_height" id="filter_height" aria-label="Floating label select example">
                                                        <option value="">00</option>
                                                        <option value="1">1</option>
                                                        <option value="2">2</option>
                                                        <option value="3">3</option>
                                                        <option value="4">4</option>
                                                        <option value="5">5</option>
                                                        <option value="6">6</option>
                                                        
                                                    </select>
                                                    <label for="floatingSelectGrid">Inches</label>
                                                </div>
                                            </div>
            
                                            <div class="col">
                                                <div class="form-floating width-select-fild">
                                                    <select class="form-select bg-transparent" id="filter_height_fraction" name="filter_height_fraction" aria-label="Floating label select example">
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
                                                    <select class="form-select bg-transparent" name="filter_width" id="filter_width" aria-label="Floating label select example">
                                                        <option value="">Left</option>
                                                        <option value="1" selected>Right</option>
                                                        
                                                    </select>
                                                    <label for="floatingSelectGrid">Position</label>
                                                </div>
                                            </div>
            
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>



                            {{-- <div class="accordion-item mt-3">
                              <div class="accordion-header" id="headingThree">
                               
                                <div class="row align-items-center"> 
                                    <div class="col-md-5">
                                        <button class="accordion-button fw-semibold collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                            Lift Type 
                                            <strong class="ms-2">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-question-circle-fill" viewBox="0 0 16 16">
                                                    <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.496 6.033h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286a.237.237 0 0 0 .241.247zm2.325 6.443c.61 0 1.029-.394 1.029-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94 0 .533.425.927 1.01.927z"/>
                                                </svg>
                                            </strong>
                                        </button>
                                    </div>

                                    <div class="col-md-7 mt-1 mt-md-0">
                                        <div class="form-floating">
                                            <select class="form-select" id="floatingSelect" aria-label="Floating label select example">
                                              <option>Cord Lift-Right (standard)	</option>
                                              <option value="1">Cord Lift-Left</option>
                                              <option value="2">Cordless</option>
                                            </select>
                                            <label for="floatingSelect">Click to Choose Lift Type</label>
                                        </div>
                                    </div>
                                </div>
                              </div>
                              <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionPremium">
                                <div class="accordion-body p-0 pt-2">
                                    <div class="cart-box p-4 rounded">
                                        <p class="mb-0">Most customers prefer to mount their blinds inside the window frame. It gives a neater, more tailored look, 
                                            without covering any details of the window or the surrounding decorative moulding.</p>

                                    </div>
                                </div>
                              </div>
                            </div> --}}
                        </div>

                        {{-- <div class="row align-items-center mt-3">
                            <div class="col-md-5">
                                <h6 class="fw-semibold">Window Name <span class="p fw-normal">(optional)</span></h6>
                            </div>

                            <div class="col-md-7">
                                <div class="">
                                    <input type="text" class="form-control" id="" placeholder="Kitchen, master, bedroom, etc. 30 character max">
                                  </div>
                            </div>

                        </div> --}}
                        
                        
                    </div>
                    
                </div>

                <div class="col-lg-4 col-md-5 mb-3 mt-4 mt-md-0">
                    <div class="shadow py-4 rounded" style="position: sticky; top: 140px; left:0;">
                        <div class="px-4">
                            <h5 class="font-secondary text-center fw-bold border-bottom mb-2 pb-2">My Blinds & Shades</h5>
                            <div>
                                <h6 class="mb-2 d-flex justify-content-between">
                                    <span class="w-50">Quantity </span>
                                    <b class="w-25 text-end">
                                        <select class="form-select cart-quantity bg-transparent form-select-sm " name="quantity" id="quantity1789" aria-label="form-select-sm example" onchange="cartItemUpdate(1789)">
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                            <option value="6">6</option>
                                            <option value="7">7</option>
                                            <option value="8">8</option>
                                            <option value="9">9</option>
                                        </select>
                                    </b>
                                </h6>

                                <h6 class="mb-2 d-flex">
                                    <span class="w-50">Price:</span>
                                    <b class="text-end w-50 text-decoration-line-through">$195.20</b>
                                </h6>
                                <h6 class="mb-2 d-flex">
                                    <span class="w-50">Options:</span>
                                    <b class="text-end w-50 text-decoration-line-through">$0.00</b>
                                </h6>

                                <h6 class="mb-2 d-flex">
                                    <span class="w-50">Subtotal:</span>
                                    <b class="text-end w-50 text-decoration-line-through">$195.20</b>
                                </h6>

                                <p class="mb-2 pt-3 text-end">
                                    
                                    <b class=" d-inline rounded bg-primary px-2 py-1 text-white small">SAVE 30%</b>
                                </p>
                                <h6 class="mb-2 d-flex">
                                    <span class="w-50">Price:</span>
                                    <b class="text-end w-50">$117.20</b>
                                </h6>
                                <h6 class="mb-2 d-flex">
                                    <span class="w-50">Options:</span>
                                    <b class="text-end w-50">$0.00</b>
                                </h6>
                                <hr class="my-2">

                                
                                <h5 class="d-flex fw-bold"><span class="w-50">TOTAL</span>
                                    <b class="w-50 text-end" id=""> $117.20</b>
                                </h5>
                            </div>
                        </div>

                        
                        <div id="sample-checkout-sticky-section"></div>

                            <div class="px-4 mt-3">
                                    <a href="#" class="btn btn-primary w-100">Add To Cart</a>
                            </div>

                    </div>
                </div>
            </div>
        </div>
    </section>

    



    {{-- <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
          <div class="modal-content">
              
            <div class="modal-body relative">
                <button type="button" class="btn-close top-0 end-0 position-absolute" data-bs-dismiss="modal" aria-label="Close"></button>
                <img class="rounded premium-colorimage-view" src="{{ asset('images/no-image.jpg') }}" alt="" />
            </div>
          </div>
        </div>
    </div> --}}


@endsection

@push('js')

    <script>
        $(function(){
            // $(".premium-color-dropdown .dropdown-item ").on('click', function () {
            //     var premiumColor = $(this).html();
            //     $('#premiumColorDropdown').html('');
            //     $(premiumColor).appendTo("#premiumColorDropdown").addClass('abc');
            // });


            // $("#premiumColorModal").on('click', function(){
            //     var check_value = $('#premiumColorDropdown img').attr('src');

            // $('.premium-colorimage-view').attr('src', check_value);
            // });

            $("#premium-floating-headrail").on('click', function () {
                var headrailVal = $("#premium-floating-headrail").val();
                if( headrailVal == 1){
                    $("#premium-floating-headrail-option").slideDown();
                }else{
                    $("#premium-floating-headrail-option").slideUp();
                }
                // alert(headrailVal);
            });
        })
    </script>

@endpush