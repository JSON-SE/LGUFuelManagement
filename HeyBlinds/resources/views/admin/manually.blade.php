@extends('layouts.Backend.admin.admin')

@section('content')
<section id="body-content" class="">
    <div class="container-fluid px-lg-5 px-md-4 pb-5 pt-lg-3">
        <div class="row pt-4">
            <div class="col-12">
                <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='white'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
                    <ol class="breadcrumb mb-2">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Manually</li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="row pb-4">
            <div class="col-sm-6 text-white my-auto">

                <h3 class="mb-0">Manually</h3>
            </div>
        </div>
        

        <div class="bg-white rounded page-height mt-3 shadow">
            <div class="p-lg-4 p-3">
                <div class="row pb-4 pb-md-5">
                    <div class="col-md-8 pt-3 color-sidedar-fixd">
                        
                                        <h5 class="step-heading">Shipping Address</h5>
                                        <div class="row g-2 gx-3 personal-infomation-form align-items-center pt-2">
        
                                            <div class="col-md-6 mt-4">
                                                <div class="form-floating">
        
                                                    <input type="text" class="form-control" placeholder="First Name">
                                                    <label for="">First Name <span class="text-danger">*</span></label>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mt-4">
                                                <div class="form-floating">
        
                                                    <input type="text" class="form-control" placeholder="Last Name">
                                                    <label for="">Last Name <span class="text-danger">*</span></label>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 mt-4">
                                                <div class="form-floating">
        
                                                    <input type="email" class="form-control " placeholder="Email">
                                                    <label for="">Email <span class="text-danger">*</span></label>
                                                </div>
                                            </div>
        
                                            <div class="col-lg-6 mt-4">
                                                
        
                                                <div class="form-floating ">
                                                    <input type="number"
                                                        class="form-control"
                                                        placeholder="Phone Number">
                                                    <label for="">Phone Number <span class="text-danger">*</span></label>
                                                </div>
                                            </div>
        
        
                                            <div class="col-md-6 mt-4">
                                                <div class="form-floating">
        
                                                    <input type="text" class="form-control" placeholder="Street Address">
                                                    <label for="">Street Address<span class="text-danger">*</span></label>
                                                </div>
                                            </div>
        
                                            <div class="col-md-6 mt-4">
                                                <div class="form-floating">
        
                                                    <input type="text" class="form-control" placeholder="Street Address">
                                                    <label for="">Apt, Ste, Unit, Bldg (Optional)</label>
                                                </div>
                                            </div>
        
                                            <div class="col-lg-6 mt-4">
                                                <div class="form-floating">
        
                                                    <input type="text" class="form-control" placeholder="City">
                                                    <label for="">City <span class="text-danger">*</span></label>
                                                </div>
                                            </div>
                                            <div class="col-lg-3 col-sm-6 mt-4">
                                                <div class="form-floating">
        
                                                    <select class="form-select" aria-label="Floating label select example">
                                                        <option value="AK">AK</option>
                                                        <option value="AL">AL</option>
                                                        <option value="AR">AR</option>
                                                        <option value="AZ">AZ</option>
                                                        <option value="CA">CA</option>
                                                        <option value="CO">CO</option>
                                                        <option value="CT">CT</option>
                                                        <option value="DE">DE</option>
                                                        <option value="FL">FL</option>
                                                        <option value="GA">GA</option>
                                                        <option value="HI">HI</option>
                                                        <option value="IA">IA</option>
                                                        <option value="ID">ID</option>
                                                        <option value="IL">IL</option>
                                                        <option value="IN">IN</option>
                                                        <option value="KS">KS</option>
                                                        <option value="KY">KY</option>
                                                        <option value="LA">LA</option>
                                                        <option value="MA">MA</option>
                                                        <option value="MD">MD</option>
                                                        <option value="ME">ME</option>
                                                        <option value="MI">MI</option>
                                                        <option value="MN">MN</option>
                                                        <option value="MO">MO</option>
                                                        <option value="MS">MS</option>
                                                        <option value="MT">MT</option>
                                                        <option value="NC">NC</option>
                                                        <option value="ND">ND</option>
                                                        <option value="NE">NE</option>
                                                        <option value="NH">NH</option>
                                                        <option value="NJ">NJ</option>
                                                        <option value="NM">NM</option>
                                                        <option value="NV">NV</option>
                                                        <option value="NY">NY</option>
                                                        <option value="OH">OH</option>
                                                        <option value="OK">OK</option>
                                                        <option value="OR">OR</option>
                                                        <option value="PA">PA</option>
                                                        <option value="PR">PR</option>
                                                        <option value="RI">RI</option>
                                                        <option value="SC">SC</option>
                                                        <option value="SD">SD</option>
                                                        <option value="TN">TN</option>
                                                        <option value="TX">TX</option>
                                                        <option value="UT">UT</option>
                                                        <option value="VA">VA</option>
                                                        <option value="VT">VT</option>
                                                        <option value="WA">WA</option>
                                                        <option value="WI">WI</option>
                                                        <option value="WV">WV</option>
                                                        <option value="WY">WY</option>
                                                    </select>
                                                    <label for="">Province <span class="text-danger">*</span></label>
                                                </div>
                                            </div>
                                            <div class="col-lg-3 col-sm-6 mt-4">
                                                <div class="form-floating">
                                                    <input type="text" class="form-control" placeholder="Postal">
                                                    <label for="">Postal Code <span class="text-danger">*</span></label>
                                                </div>
                                            </div>
                                            
        
                                        </div>
        
                    </div>
        
        
                    <div class="col-md-4 select-colour-items">
                        <div class="pt-4">
        
                            <div class="bg-white rounded shadow p-3">
        
                                <h5>Cart Summary</h5>
                                <hr class="my-2" />
        
                                <h6 class="d-flex"><span class="w-50">SubTotal<small>&nbsp;(6 items)</small></span> <b
                                        class="w-50 text-end">$501.10</b></h6>
        
                                <h6 class="mb-2 d-flex text-primary">
                                    <b class="w-50">Save 30% </b>
                                    <span class="text-end w-50">-$15.05</span>
                                </h6>
        
                                <h6 class="mb-2 d-flex text-primary">
                                    <b class="w-50">Extra 10% </b>
                                    <span class="text-end w-50">-$3.51</span>
                                </h6>
        
                                <h6 class="mb-2 d-flex text-success">
                                    <span class="w-50">Shipping <span class=" ps-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor"
                                                class="bi bi-question-circle" viewBox="0 0 16 16">
                                                <path
                                                    d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                                <path
                                                    d="M5.255 5.786a.237.237 0 0 0 .241.247h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286zm1.557 5.763c0 .533.425.927 1.01.927.609 0 1.028-.394 1.028-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94z" />
                                            </svg>
                                        </span></span>
                                    <b class="w-50 text-end">Free</b>
                                </h6>
        
                                <h6 class="mb-2 d-flex text-success">
                                    <span class="w-50">Warranty <span class=" ps-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor"
                                                class="bi bi-question-circle" viewBox="0 0 16 16">
                                                <path
                                                    d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                                <path
                                                    d="M5.255 5.786a.237.237 0 0 0 .241.247h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286zm1.557 5.763c0 .533.425.927 1.01.927.609 0 1.028-.394 1.028-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94z" />
                                            </svg>
                                        </span></span>
                                    <b class="text-end w-50">Free</b>
                                </h6>
                                <h6 class="mb-2 d-flex text-success">
                                    <span class="w-50">Handling <span class=" ps-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor"
                                                class="bi bi-question-circle" viewBox="0 0 16 16">
                                                <path
                                                    d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                                <path
                                                    d="M5.255 5.786a.237.237 0 0 0 .241.247h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286zm1.557 5.763c0 .533.425.927 1.01.927.609 0 1.028-.394 1.028-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94z" />
                                            </svg>
                                        </span></span>
                                    <b class="text-end w-50">Free</b>
                                </h6>
                                <hr class="my-2" />
        
                                <h5 class="d-flex fw-bold"><span class="w-50">Your Price </span>
                                    <b class="w-50 text-end">$501.10</b></h5>
        
                                <button class="btn btn-lg btn-primary w-100 mt-2" disabled>Place Order</button>
        
        
                            </div>
        
                        </div>
        
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>

@push('js')

@endpush
@endsection
