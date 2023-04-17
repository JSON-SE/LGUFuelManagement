@extends('layouts.Backend.admin.admin')

@section('content')


<section id="body-content" class="">
    <div class="container-fluid px-lg-5 px-md-4 pb-5 pt-lg-3">

        <div class="row pt-4">
            <div class="col-12">
                <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='white'/%3E%3C/svg%3E&#34;);"
                    aria-label="breadcrumb">
                    <ol class="breadcrumb mb-2">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">All Modal Coupons</li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="row pb-4">
            <div class="col-sm-6 text-white my-auto">
                <h3 class="mb-0">All Modal Coupons</h3>
            </div>


            <div class="col-sm-6 pt-3 pt-lg-0 my-auto d-flex justify-content-sm-end">
                <!-- <button class="btn btn-light">New view</button> -->
                <a class="btn btn-primary d-flex align-items-center ms-2" href="{{ route('admin.modal-coupons.create') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-plus" viewBox="0 0 16 16">
                        <path
                            d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z" />
                    </svg>
                    <span class="d-none d-md-block">Create new Coupon</span>
                </a>
            </div>

        </div>

        <div class="bg-white rounded page-height mt-3 shadow position-relative">

            @if(Session::has('message'))
            <p class="alert alert-info my-4">{{ Session::get('message') }}</p>
            @endif


            <div class="p-4">
                <div class="row">
                    <div class="col-lg-12">
                        <div id="productaccordion">
                            <table id="modal-table" class="table table-responsive table-striped table-bordered text-center">
                                <thead class="product-option-list">
                                    <tr class="heading-list">
                                        <td>#</td>
                                        <td>Coupon Name</td>
                                        <td>Coupon Code</td>
                                        <td>Start Date</td>
                                        <td>End Date</td>
                                        <td>Amount</td>
                                        <td>Icon</td>
                                        <td>Status</td>
                                        <td>Action</td>
                                    </tr>
                                </thead>
                                <tbody class="product-option-list ui-sortable  bottom-border ">

                                    @forelse($coupons as $coupon)
                                    <tr class=" ui-state-default ui-sortable-handle" style="vertical-align: middle;">

                                        <td>
                                            <div class="check-box d-inline-block">
                                                {{-- <input type="checkbox" id="sb-1" name="sb-1" value="sb-1"> --}}
                                                <label for="sb-1">{{  $loop->index+1 }}</label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="fw-bold">{{ $coupon->name }}</div>
                                        </td>
                                        <td>
                                            <div class="fw-bold">{{ $coupon->code }}</div>
                                        </td>
                                        <td>
                                             {{date('d-m-Y H:i:s',strtotime($coupon->start_date))}}
                                        </td>
                                        <td>
                                           {{date('d-m-Y H:i:s',strtotime($coupon->end_date))}}
                                        </td>
                                        <td>
                                            <!--{{ $coupon->amount }}-->
                                            {{ number_format($coupon->amount,2) }}
                                        </td>
                                        <td>
                                            <img src="{{ $helpers->getThumbnail($coupon->icon) }}" style="width:70px">
                                        </td>
                                        <td>
                                            @php
                                               $checkDate = \Carbon\Carbon::parse($coupon->end_date ?? null);
                                                $message = '';

                                                if (empty($coupon->is_active)){
                                                    $message = "Inactive";
                                                }elseif($checkDate->isPast()){
                                                    $message = "Expired";
                                                }elseif ($checkDate->lessThan($coupon->start_date ?? null)){
                                                     $message = "Not Yet Started";
                                                }elseif (!empty($coupon->is_active)){
                                                    $message = "Active";
                                                }
                                            @endphp
                                            {{ $message }}
                                        </td>

                                        <td class="">
                                            <div class="d-flex justify-content-center">
                                                <a class="btn text-secondary"
                                                    href="{{ route('admin.modal-coupons.edit',$coupon->id) }}">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                        fill="currentColor" class="bi bi-pencil-square"
                                                        viewBox="0 0 16 16">
                                                        <path
                                                            d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456l-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                                        <path fill-rule="evenodd"
                                                            d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                                                    </svg>
                                                </a>

                                                <form method="post"
                                                    action={{ route('admin.modal-coupons.destroy',$coupon->id) }}>
                                                    @method('delete')
                                                    <button class="btn" type="submit"
                                                        onclick="return confirm('Are you sure you want to delete this item?');">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                            fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                                            <path
                                                                d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z">
                                                            </path>
                                                            <path fill-rule="evenodd"
                                                                d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z">
                                                            </path>
                                                        </svg>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>

                                    </tr>
                                    @empty
                                    <tr><td colspan="8"><h3><a href="{{route('admin.modal-coupons.create')}}">Create First Coupon</a></h3></td></tr>
                                    @endforelse

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="my-2">
                    {{ $coupons->links()   }}
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
@section('scripts')
<script>
    jQuery(function($) {
        
        $('#modal-table').DataTable({
            processing: true,
            searching :true,
            ordering : false,
            });

    })
</script>
@endsection