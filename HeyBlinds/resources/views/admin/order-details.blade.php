@extends('layouts.app')
@section('content')
<section id="body-content" class="">
  <div class="container-fluid px-lg-5 px-md-4 pb-5 pt-lg-3">
    <div class="row pt-4">
      <div class="col-12">
        <nav style="
                --bs-breadcrumb-divider: url(&#34;data:image/svg + xml,%3Csvgxmlns='http://www.w3.org/2000/svg'width='8'height='8'%3E%3Cpathd='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z'fill='white'/%3E%3C/svg%3E&#34;);
              " aria-label="breadcrumb">
          <ol class="breadcrumb mb-2">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">
              Order details
            </li>
          </ol>
        </nav>
      </div>
    </div>
    <div class="row pb-4">
      <div class="col-sm-6 text-white my-auto">
        <h3 class="mb-0">Order Details (HB0001)</h3>
      </div>

      <div class="col-sm-6 pt-3 pt-lg-0 my-auto d-flex justify-content-sm-end">
        <button class="btn btn-primary d-flex align-items-center ms-2">
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus"
            viewBox="0 0 16 16">
            <path
              d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z" />
          </svg>
          <span class="d-none d-md-block">Add new product</span>
        </button>
      </div>
    </div>

    <div class="bg-white rounded page-height mt-3 shadow">
      <div class="bg-primary p-2 text-white d-flex flex-wrap align-items-center justify-content-between">
        <p class="mb-0">
          Order status: in progress 2021-01-22 7.00 PM
        </p>
        <p class="mb-0">Order ID: 24178</p>
      </div>
      <div class="p-4">
        <div class="row">
          <div class="col-md-4 mb-3">
            <h5>Shipping information</h5>
            <p class="mb-2"><input type="text" class="edit-input table-input" value="John Doe" name="" readonly></p>
            <p class="mb-2"><input type="text" class="edit-input table-input" value="121, California, USA" name=""
                readonly></p>
            <p class="mb-2">
              <a href="#"><input type="text" class="edit-input table-input" value="test@gmail.com" name="" readonly></a>
            </p>
            <p class="mb-2"><a href="#"><input type="text" class="edit-input table-input" value="123456789" name=""
                  readonly></a></p>
          </div>
          <div class="col-md-4 mb-3">
            <h5>Billing information</h5>
            <p class="mb-2"><input type="text" class="edit-input table-input" value="John Doe" name="" readonly></p>
            <p class="mb-2"><input type="text" class="edit-input table-input" value="121, California, USA" name=""
                readonly></p>
            <p class="mb-2">
              <a href="#"><input type="text" class="edit-input table-input" value="test@gmail.com" name="" readonly></a>
            </p>
            <p class="mb-2"><a href="#"><input type="text" class="edit-input table-input" value="123456789" name=""
                  readonly></a></p>
            <p class="mb-2">Payment method: <input type="text" class="edit-input table-input" value="Card" name=""
                readonly></p>
          </div>
          <div class="col-md-4 mb-3">
            <ul class="payment-history">
              <li>
                <p class="mb-2 me-3">Subtotal</p>
                <p class="mb-2">$330.00</p>
              </li>
              <li>
                <p class="mb-2 me-3">Discount</p>
                <p class="mb-2">N/A</p>
              </li>
              <li>
                <p class="mb-2 me-3">Other processing</p>
                <p class="mb-2">$20.00</p>
              </li>
            </ul>
            <ul class="payment-history mb-0">
              <li>
                <p class="mb-2 me-3 fw-bold">TOTAL:</p>
                <p class="mb-2">$330.00</p>
              </li>
            </ul>
          </div>
        </div>
        <div class="row pt-2">
          <form>
            <div class="row">
              <div class="col-sm-8 mb-3">
                <h5>Customer note</h5>
                <p class="txt__sm">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec suscipit fermentum
                  metus, non ultrices enim mattis id. Vivamus porttitor varius venenatis. Proin lobortis finibus tellus
                  eu iaculis.</p>
                <form>
                  <textarea class="form-control mb-3" rows="7" placeholder="Message"></textarea>
                  <button class="btn btn-primary">Submit</button>
                </form>
              </div>
            </div>
          </form>
        </div>
        <div class="row pt-2">
          <div class="col-sm-4 mb-3">
            <h5 class="mb-0">2 LINE ITEMS (:3)</h5>
          </div>
          <div class="col-sm-8 mb-3">
            <div class="d-flex align-items-center flex-wrap justify-content-sm-end line-items-btn">
              <button type="button" class="btn btn-link">
                <svg class="me-1" xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="#198754"
                  viewBox="0 0 16 16">
                  <path
                    d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z" />
                  <path
                    d="M7.646 1.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708L8.5 2.707V11.5a.5.5 0 0 1-1 0V2.707L5.354 4.854a.5.5 0 1 1-.708-.708l3-3z" />
                </svg>
                <small>Upload</small>
              </button>
              <button type="button" class="btn btn-link">
                <svg xmlns="http://www.w3.org/2000/svg" class="me-1" width="14" height="14" fill="#198754"
                  viewBox="0 0 16 16">
                  <path
                    d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z" />
                </svg>
                <small>Add item 1</small>
              </button>
              <button type="button" class="btn btn-link">
                <svg xmlns="http://www.w3.org/2000/svg" class="me-1" width="14" height="14" fill="#198754"
                  viewBox="0 0 16 16">
                  <path
                    d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z" />
                </svg>
                <small>Add item 2</small>
              </button>
            </div>
          </div>
        </div>

        <div class="bg-light rounded-3 mb-4">
          <div class="list-item">
            <div class="list-item-action">
              <div class="mb-2">
                <button class="btn btn-primary" data-bs-toggle="tooltip" data-container="body" title="Edit">
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                    class="bi bi-pencil-fill" viewBox="0 0 16 16">
                    <path
                      d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z" />
                  </svg>
                </button>
              </div>
              <div class="mb-2">
                <button class="btn btn-primary" data-bs-toggle="tooltip" data-container="body" title="Delete">
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash"
                    viewBox="0 0 16 16">
                    <path
                      d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z" />
                    <path fill-rule="evenodd"
                      d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" />
                  </svg>
                </button>
              </div>
            </div>
            <div class="list-item-details">
              <h5 class="text-uppercase">
                Super Value Vinyl Blackout Roller Shades
              </h5>
              <p class="txt__sm">
                NEWLY REDESIGNED! One of our top-selling cellular shades has
                been redesigned to include more colours, a larger 3/4" pleat
                size, and a colour-coordinated metal headrail! Our upgraded
                Value Cordless
              </p>
              <ul class="payment-history txt__sm">
                <li>
                  <p class="mb-2 me-3 fw-bold">Color</p>
                  <p class="mb-2"><input type="text" class="edit-input table-input" value="Solid grey" name="" readonly>
                  </p>
                </li>
                <li>
                  <p class="mb-2 me-3 fw-bold">Width</p>
                  <p class="mb-2"><input type="text" class="edit-input table-input" value="57.3" name="" readonly></p>
                </li>
                <li>
                  <p class="mb-2 me-3 fw-bold">Height</p>
                  <p class="mb-2"><input type="text" class="edit-input table-input" value="24.11" name="" readonly></p>
                </li>
                <li>
                  <p class="mb-2 me-3 fw-bold">Mount Type</p>
                  <p class="mb-2"><input type="text" class="edit-input table-input" value="Inside" name="" readonly></p>
                </li>

                <li>
                  <p class="mb-2 me-3 fw-bold">Room name</p>
                  <p class="mb-2"><input type="text" class="edit-input table-input" value="Dining hall" name=""
                      readonly></p>
                </li>
                <li>
                  <p class="mb-2 me-3 fw-bold">Easy Lift Systems</p>
                  <p class="mb-2"><input type="text" class="edit-input table-input" value="Cordless Lift" name=""
                      readonly></p>
                </li>
                <li>
                  <p class="mb-2 me-3 fw-bold">Headrail Options</p>
                  <p class="mb-2"><input type="text" class="edit-input table-input" value="Standard Headrail" name=""
                      readonly></p>
                </li>
                <li>
                  <p class="mb-2 me-3 fw-bold">Valance</p>
                  <p class="mb-2"><input type="text" class="edit-input table-input" value="6 Valance" name="" readonly>
                  </p>
                </li>
                <li>
                  <p class="mb-2 me-3 fw-bold">Bottom Trim</p>
                  <p class="mb-2"><input type="text" class="edit-input table-input" value="Flax Trim ($111.32)" name=""
                      readonly></p>
                </li>
                <li>
                  <p class="mb-2 me-3 fw-bold">Warranty Options</p>
                  <p class="mb-2 w-100"><input type="text" class="edit-input table-input"
                      value="5 7-Years Unlimited Warranty" name="" readonly></p>
                </li>
              </ul>
            </div>
            <div class="list-item-image">
              <!-- <p class="txt__sm">57.3"x24.11"</p> -->
              <img src="./assets/images/product-image3.jpg" alt="Product Image" />
            </div>
            <div class="list-item-price">
              <ul class="payment-history txt__sm">
                <li>
                  <p class="mb-2 me-3 fw-bold">Qty</p>
                  <p class="mb-2">2</p>
                </li>
                <li>
                  <p class="mb-2 me-3 fw-bold">Tax</p>
                  <p class="mb-2">2.00</p>
                </li>
                <li>
                  <p class="mb-2 me-3 fw-bold">Warranty</p>
                  <p class="mb-2">0.00</p>
                </li>
                <li>
                  <p class="mb-2 me-3 fw-bold">Warranty</p>
                  <p class="mb-2">0.00</p>
                </li>
                <li>
                  <p class="mb-2 me-3 fw-bold">TOTAL</p>
                  <p class="mb-2">200.00</p>
                </li>
              </ul>
            </div>
          </div>
        </div>

        <div class="bg-light rounded-3 mb-4">
          <div class="list-item">
            <div class="list-item-action">
              <div class="mb-2">
                <button class="btn btn-primary" data-bs-toggle="tooltip" data-container="body" title="Edit">
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                    class="bi bi-pencil-fill" viewBox="0 0 16 16">
                    <path
                      d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z" />
                  </svg>
                </button>
              </div>
              <div class="mb-2">
                <button class="btn btn-primary" data-bs-toggle="tooltip" data-container="body" title="Delete">
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash"
                    viewBox="0 0 16 16">
                    <path
                      d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z" />
                    <path fill-rule="evenodd"
                      d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" />
                  </svg>
                </button>
              </div>
            </div>
            <div class="list-item-details">
              <h5 class="text-uppercase">
                Super Value Vinyl Blackout Roller Shades
              </h5>
              <p class="txt__sm">
                NEWLY REDESIGNED! One of our top-selling cellular shades has
                been redesigned to include more colours, a larger 3/4" pleat
                size, and a colour-coordinated metal headrail! Our upgraded
                Value Cordless
              </p>
              <ul class="payment-history txt__sm">
                <li>
                  <p class="mb-2 me-3 fw-bold">Color</p>
                  <p class="mb-2"><input type="" class="edit-input table-input" value="Solid grey" name="" readonly></p>
                </li>
                <li>
                  <p class="mb-2 me-3 fw-bold">Width</p>
                  <p class="mb-2"><input type="" class="edit-input table-input" value="57.3" name="" readonly></p>
                </li>
                <li>
                  <p class="mb-2 me-3 fw-bold">Height</p>
                  <p class="mb-2"><input type="text" class="edit-input table-input" value="24.11" name="" readonly></p>
                </li>
                <li>
                  <p class="mb-2 me-3 fw-bold">Mount Type</p>
                  <p class="mb-2"><input type="text" class="edit-input table-input" value="Inside" name="" readonly></p>
                </li>

                <li>
                  <p class="mb-2 me-3 fw-bold">Room name</p>
                  <p class="mb-2"><input type="text" class="edit-input table-input" value="Dining hall" name=""
                      readonly></p>
                </li>
                <li>
                  <p class="mb-2 me-3 fw-bold">Easy Lift Systems</p>
                  <p class="mb-2"><input type="text" class="edit-input table-input" value="Cordless Lift" name=""
                      readonly></p>
                </li>
                <li>
                  <p class="mb-2 me-3 fw-bold">Headrail Options</p>
                  <p class="mb-2"><input type="text" class="edit-input table-input" value="Standard Headrail" name=""
                      readonly></p>
                </li>
                <li>
                  <p class="mb-2 me-3 fw-bold">Valance</p>
                  <p class="mb-2"><input type="text" class="edit-input table-input" value="6 Valance" name="" readonly>
                  </p>
                </li>
                <li>
                  <p class="mb-2 me-3 fw-bold">Bottom Trim</p>
                  <p class="mb-2"><input type="text" class="edit-input table-input" value="Flax Trim ($111.32)" name=""
                      readonly></p>
                </li>
                <li>
                  <p class="mb-2 me-3 fw-bold">Warranty Options</p>
                  <p class="mb-2 w-100"><input type="text" class="edit-input table-input"
                      value="5 7-Years Unlimited Warranty" name="" readonly></p>
                </li>
              </ul>
            </div>
            <div class="list-item-image">
              <!-- <p class="txt__sm">57.3"x24.11"</p> -->
              <img src="./assets/images/product-image3.jpg" alt="Product Image" />
            </div>
            <div class="list-item-price">
              <ul class="payment-history txt__sm">
                <li>
                  <p class="mb-2 me-3 fw-bold">Qty</p>
                  <p class="mb-2">2</p>
                </li>
                <li>
                  <p class="mb-2 me-3 fw-bold">Tax</p>
                  <p class="mb-2">2.00</p>
                </li>
                <li>
                  <p class="mb-2 me-3 fw-bold">Warranty</p>
                  <p class="mb-2">0.00</p>
                </li>
                <li>
                  <p class="mb-2 me-3 fw-bold">Warranty</p>
                  <p class="mb-2">0.00</p>
                </li>
                <li>
                  <p class="mb-2 me-3 fw-bold">TOTAL</p>
                  <p class="mb-2">200.00</p>
                </li>
              </ul>
            </div>
          </div>
        </div>

        <!-- <div class="bg-light rounded-3 mb-4">
            <div class="list-item">
              <div class="list-item-action">
                <div class="mb-2">
                  <button class="btn btn-primary" data-bs-toggle="tooltip" data-container="body" title="Edit">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                      class="bi bi-pencil-fill" viewBox="0 0 16 16">
                      <path
                        d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z" />
                    </svg>
                  </button>
                </div>
                <div class="mb-2">
                  <button class="btn btn-primary" data-bs-toggle="tooltip" data-container="body" title="Delete">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                      class="bi bi-trash" viewBox="0 0 16 16">
                      <path
                        d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z" />
                      <path fill-rule="evenodd"
                        d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" />
                    </svg>
                  </button>
                </div>
              </div>
              <div class="list-item-details">
                <h5 class="text-uppercase">
                  Super Value Vinyl Blackout Roller Shades
                </h5>
                <p class="txt__sm">
                  NEWLY REDESIGNED! One of our top-selling cellular shades has
                  been redesigned to include more colours, a larger 3/4" pleat
                  size, and a colour-coordinated metal headrail! Our upgraded
                  Value Cordless
                </p>
                <ul class="payment-history txt__sm">
                  <li>
                    <p class="mb-2 me-3 fw-bold">Color</p>
                    <p class="mb-2">Solid grey</p>
                  </li>
                  <li>
                    <p class="mb-2 me-3 fw-bold">Mount Type</p>
                    <p class="mb-2">Inside</p>
                  </li>

                  <li>
                    <p class="mb-2 me-3 fw-bold">Room name</p>
                    <p class="mb-2">Dining hall</p>
                  </li>
                  <li>
                    <p class="mb-2 me-3 fw-bold">Easy Lift Systems</p>
                    <p class="mb-2">Cordless Lift</p>
                  </li>
                  <li>
                    <p class="mb-2 me-3 fw-bold">Headrail Options</p>
                    <p class="mb-2">Standard Headrail</p>
                  </li>
                  <li>
                    <p class="mb-2 me-3 fw-bold">Valance</p>
                    <p class="mb-2">6" Valance</p>
                  </li>
                  <li>
                    <p class="mb-2 me-3 fw-bold">Bottom Trim</p>
                    <p class="mb-2">Flax Trim ($111.32)</p>
                  </li>
                  <li>
                    <p class="mb-2 me-3 fw-bold">Warranty Options</p>
                    <p class="mb-2">5 7-Years Unlimited Warranty</p>
                  </li>
                </ul>
              </div>
              <div class="list-item-image">
                <p class="txt__sm">57.3"x24.11"</p>
                <img src="./assets/images/product-image3.jpg" alt="Product Image" />
              </div>
              <div class="list-item-price">
                <ul class="payment-history txt__sm">
                  <li>
                    <p class="mb-2 me-3 fw-bold">Qty</p>
                    <p class="mb-2">2</p>
                  </li>
                  <li>
                    <p class="mb-2 me-3 fw-bold">Tax</p>
                    <p class="mb-2">2.00</p>
                  </li>
                  <li>
                    <p class="mb-2 me-3 fw-bold">Warranty</p>
                    <p class="mb-2">0.00</p>
                  </li>
                  <li>
                    <p class="mb-2 me-3 fw-bold">Warranty</p>
                    <p class="mb-2">0.00</p>
                  </li>
                  <li>
                    <p class="mb-2 me-3 fw-bold">TOTAL</p>
                    <p class="mb-2">200.00</p>
                  </li>
                </ul>
              </div>
            </div>
          </div> -->
      </div>
    </div>
  </div>
</section>
@endsection