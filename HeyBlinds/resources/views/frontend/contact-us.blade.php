@extends('layouts.Frontend.app')
@section('title')
    Contact Us | HeyBlinds Canada
@endsection
@push('css')
    <style type="text/css">
        #klaviyo-form-style .kdmtMJ.kdmtMJ {
            background: #fff !important;
            width: auto !important;
            height: auto !important;
        }

    </style>
@endpush
@section('content')
    <section class="container">
        <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);"
            aria-label="breadcrumb">
            <ol class="breadcrumb mb-2 pt-2">
                <li class="breadcrumb-item"><a href="{{ route('welcome') }}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Contact us</li>
            </ol>
        </nav>
        <div class="inner-banner rounded">
            <img class="rounded" src="{{ asset('images/contact-banner.jpg') }}" alt="" />
            <div class="inner-banner-text">
                Contact Us
            </div>
        </div>

    </section>


    <section id="body-content">
        <div class="container pb-5">
            <div class="row">
                <div class="col-lg-4">
                    <div class="row">
                        <div class="mt-4 col-lg-12 col-sm-6 pt-md-3">
                            <h6 class="fw-bold border-start border-3 border-primary ps-2">Contact Information</h6>
                            <p class="d-flex mt-3">
                                <span class="text-primary">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor"
                                        class="bi bi-telephone-fill" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd"
                                            d="M1.885.511a1.745 1.745 0 0 1 2.61.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.678.678 0 0 0 .178.643l2.457 2.457a.678.678 0 0 0 .644.178l2.189-.547a1.745 1.745 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.634 18.634 0 0 1-7.01-4.42 18.634 18.634 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877L1.885.511z" />
                                    </svg>
                                </span>

                                <a class="ms-2 text-dark" href="tel:(888) 412-3439">(888) 412-3439</a>
                            </p>
                        </div>

                        <div class="mt-4 col-lg-12 col-sm-6 pt-md-3">
                            <h6 class="fw-bold border-start border-3 border-primary ps-2">Normal Hours</h6>
                            <p class="d-flex  mt-3">
                                <span class="text-primary">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                                        class="bi bi-alarm-fill" viewBox="0 0 16 16">
                                        <path
                                            d="M6 .5a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 0 1H9v1.07a7.001 7.001 0 0 1 3.274 12.474l.601.602a.5.5 0 0 1-.707.708l-.746-.746A6.97 6.97 0 0 1 8 16a6.97 6.97 0 0 1-3.422-.892l-.746.746a.5.5 0 0 1-.707-.708l.602-.602A7.001 7.001 0 0 1 7 2.07V1h-.5A.5.5 0 0 1 6 .5zm2.5 5a.5.5 0 0 0-1 0v3.362l-1.429 2.38a.5.5 0 1 0 .858.515l1.5-2.5A.5.5 0 0 0 8.5 9V5.5zM.86 5.387A2.5 2.5 0 1 1 4.387 1.86 8.035 8.035 0 0 0 .86 5.387zM11.613 1.86a2.5 2.5 0 1 1 3.527 3.527 8.035 8.035 0 0 0-3.527-3.527z" />
                                    </svg>
                                </span>

                                <span class="ms-2">8AM - 10PM EST Eastern Time,<br /> Monday – Friday</span>

                            </p>
                        </div>
                    </div>

                </div>

                <div class="col-lg-8">
                    @if (\Session::has('message'))
                        <div class="alert alert-success">
                            <ul>
                                <li>{!! \Session::get('message') !!}</li>
                            </ul>
                        </div>
                    @endif
                    <div class="mt-3 p-sm-4 p-3 p-lg-4 rounded shadow">
                        <div class="">
                            <div class="row p-2 pb-3">
                                <div class="col-md-6">
                                    <h5 class="fw-bold">Email Us</h5>
                                    <p class="border-start border-3 border-primary ps-2">Hey, <br />Go ahead, Ask us
                                        anything!</p>
                                </div>
                                <div class="col-md-6 text-start text-md-end">
                                    <h5 class="fw-bold">Live Chat</h5>
                                    <div
                                        class="d-flex flex-md-row-reverse contact-right-border border-end border-3 border-primary pe-0 ps-2 ps-md-0 pe-md-2">
                                        <a type="button" class="" onclick="$crisp.push(['do', 'chat:open'])">
                                            <img src="{{ asset('images/chat-icon.png') }}" alt="" />
                                        </a>
                                        <p class="mb-0 px-2">Chat with a member of our <br />Customer Satisfaction
                                            Team.</p>

                                    </div>

                                </div>
                            </div>
                            <div id="klaviyo-form-style">
                                <div class="klaviyo-form-XSieVd"></div>
                            </div>

                            {{-- <form method="post" action="{{ route('frontend.contact.store') }}">

                                <div class="row pt-2">

                                    <div class="col-md-6">
                                        <div class="form-floating mb-3">
                                            <input type="text" name="first_name" class="form-control bg-transparent"
                                                id="floatingInput" maxlength="30" placeholder="First Name"
                                                value="{{ old('first_name') }}" required>
                                            <label for="floatingInput">First Name *</label>
                                            @error('first_name')
                                                <span class="text-danger" role="alert">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-floating mb-3">
                                            <input type="text" name="last_name" class="form-control bg-transparent"
                                                id="floatingInput" placeholder="Last Name" maxlength="30"
                                                value="{{ old('last_name') }}">
                                            <label for="floatingInput">Last Name </label>

                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-floating mb-3">
                                            <input type="email" name="email" class="form-control bg-transparent"
                                                id="floatingInput" placeholder="Email" maxlength="80"
                                                value="{{ old('email') }}" required>
                                            <label for="floatingInput">Email *</label>
                                            @error('email')
                                                <span class="text-danger" role="alert">
                                                    {{ $email }}
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating mb-3">
                                            <input type="email" name="confirm_email" class="form-control bg-transparent"
                                                id="floatingInput" placeholder="Email" maxlength="80"
                                                value="{{ old('confirm_email') }}" required>
                                            <label for="floatingInput">Confirm Email *</label>
                                            @error('confirm_email')
                                                <span class="text-danger" role="alert">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-floating mb-3">
                                            <input type="text" name="phone_number"
                                                class="form-control bg-transparent phone_number" id="floatingInput"
                                                placeholder="Phone Number" maxlength="16"
                                                value="{{ old('phone_number') }}">
                                            <label for="floatingInput">Phone Number</label>
                                            @error('phone_number')
                                                <span class="text-danger" role="alert">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating mb-3">
                                            <input type="text" name="order_number" value="{{ old('order_name') }}"
                                                maxlength="30" class="form-control bg-transparent" id="floatingInput"
                                                placeholder="Order Number">
                                            <label for="floatingInput">Order Number</label>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-floating mb-3">
                                            <select class="form-select bg-transparent" name="preferred_communication"
                                                id="floatingSelect">
                                                <option value="Email or Phone">Email or Phone</option>
                                                <option value="Email">Email</option>
                                                <option value="Phone">Phone</option>

                                            </select>
                                            <label for="floatingSelect">Please get back to me by:</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating mb-3">
                                            <select class="form-select bg-transparent" name="contact_reason"
                                                id="floatingSelect">
                                                <option value="">-- Select a Reason --</option>
                                                <option value="A Problem Checking Out">A Problem Checking Out</option>
                                                <option value="Payment Info">Payment Info</option>
                                                <option value="My Existing Order">My Existing Order</option>
                                                <option value="A Product Question">A Product Question</option>
                                                <option value="My Order Status">My Order Status</option>
                                                <option value="A Change Request to My Order">A Change Request to My Order
                                                </option>
                                                <option value="Canceling My Order">Canceling My Order</option>
                                                <option value="Suggestions to Improve">Suggestions to Improve</option>
                                                <option value="Website Problems">Website Problems</option>
                                                <option value="Damage to My Blinds">Damage to My Blinds</option>
                                                <option value="Missing Parts">Missing Parts</option>
                                                <option value=" Something Else Important"> Something Else Important</option>

                                            </select>
                                            <label for="floatingSelect">I'm contacting HeyBlinds about:</label>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-floating">
                                            <textarea class="form-control bg-transparent" name="message"
                                                value="{{ old('message') }}" placeholder="Leave a message here"
                                                id="floatingTextarea2" style="height: 100px"></textarea>

                                            <label for="floatingTextarea2">Message </label>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <button type="submit" class="btn btn-primary mt-3">Send Email</button>
                                    </div>

                                </div>

                            </form> --}}

                        </div>

                    </div>

                    <div class="d-flex mt-4">
                        <div>
                            <h6 class="fw-bold border-start border-3 border-primary ps-2">Address</h6>
                            <p class="d-flex ">

                            <p class="mb-2 d-flex mt-3">
                                <span class="text-primary">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                                        class="bi bi-geo-fill" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd"
                                            d="M4 4a4 4 0 1 1 4.5 3.969V13.5a.5.5 0 0 1-1 0V7.97A4 4 0 0 1 4 3.999zm2.493 8.574a.5.5 0 0 1-.411.575c-.712.118-1.28.295-1.655.493a1.319 1.319 0 0 0-.37.265.301.301 0 0 0-.057.09V14l.002.008a.147.147 0 0 0 .016.033.617.617 0 0 0 .145.15c.165.13.435.27.813.395.751.25 1.82.414 3.024.414s2.273-.163 3.024-.414c.378-.126.648-.265.813-.395a.619.619 0 0 0 .146-.15.148.148 0 0 0 .015-.033L12 14v-.004a.301.301 0 0 0-.057-.09 1.318 1.318 0 0 0-.37-.264c-.376-.198-.943-.375-1.655-.493a.5.5 0 1 1 .164-.986c.77.127 1.452.328 1.957.594C12.5 13 13 13.4 13 14c0 .426-.26.752-.544.977-.29.228-.68.413-1.116.558-.878.293-2.059.465-3.34.465-1.281 0-2.462-.172-3.34-.465-.436-.145-.826-.33-1.116-.558C3.26 14.752 3 14.426 3 14c0-.599.5-1 .961-1.243.505-.266 1.187-.467 1.957-.594a.5.5 0 0 1 .575.411z" />
                                    </svg>
                                </span>
                                @if(config('global.is_heyblinds_com') == true)
                                <span class="ms-2"> HeyBlinds’ head office is located at 5572 Pie-IX Boulevard in beautiful Montreal, Canada, H1X 2B8. <a class="ps-2" href="https://heyblinds.com/">HeyBlinds.com</a> offers you products from American companies, with the friendliest Canadian Customer Care. </span>
                                @else
                                <span class="ms-2">5572 Pie-IX Boulevard, Montreal, QC
                                    H1X 2B8</span>
                                @endif
                                
                            </p>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
