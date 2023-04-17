<div class="billing-info-view">
    <p class="mb-1">
        {{ $billingAddress->first_name }} {{ $billingAddress->last_name }}
    </p>
    <p class="mb-1">
        {{ $billingAddress->street }},  {{ $billingAddress->area_code }}
    </p>
    <p class="mb-1">
        {{ $billingAddress->city }}, {{ $billingAddress->province }}
    </p>
    <p class="mb-1">
        {{ @$billingAddress->postal_code }}
    </p>
    <p class="mb-1">
        {{ $billingAddress->phone_number }}
    </p>
    @if($order->order_status ==10)
    <p class="mb-1">
        Payment status : Transaction Failed.
    </p>
    @else
    <p class="mb-1">
        Payment method: Card  NC
    </p>
    @endif
    <p class="ps-5 ms-4">
        <button class="btn btn-primary btn-sm ms-5 " data-bs-toggle="tooltip" data-container="body" data-id="734" id="billing-info-view" type="button">
            <svg class="bi bi-pencil-fill" fill="currentColor" height="16" viewbox="0 0 16 16" width="16" xmlns="http://www.w3.org/2000/svg">
                <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z">
                </path>
            </svg>
        </button>
    </p>
</div>
<div class="billing-info-edit">
    <form id="billing-form" method="post">
         <input type="hidden" name="billing_id" value="{{@$billingAddress->id}}">
        <p class="mb-1">
            <input  name="first_name" type="text" required value="{{ $billingAddress->first_name }}"/>
             <input  name="last_name" type="text" required value="{{ $billingAddress->last_name }}"/>
        </p>
        <p class="mb-1">
            <input  name="street" type="text" required value="{{ $billingAddress->street }}"/>
            <input  name="area_code" type="text" value="{{ $billingAddress->area_code }}"/>
        </p>
        <p class="mb-1">
            <input  name="billing_city" type="text" required value="{{ $billingAddress->city }}"/>
            <select  name="billing_province"  id="billing_province"  required>
                <option value="">Province</option>
                @foreach($proviences as $provience)
                <option value="{{$provience->code}}" {{$provience->code  == $shippingAddress->province ? 'selected' : ''}}>
                   {{$provience->code}}
                </option>
                @endforeach

            </select>
        </p>
        <p class="mb-1">
            <p class="mb-1">
                <input  type="text" name="postal_code" class="postal_code" required maxlength="7" value="{{ @$billingAddress->postal_code }}"/>
            </p>
            <p class="mb-1">
                <input  name="billing_phone_number" class="phone_number" type="text" required value="{{ @$billingAddress->phone_number }}"/>
            </p>
            @if($order->order_status ==10)
            <p class="mb-1">
                Payment
                <input  name="" readonly="" type="text" value="Trasaction Failed."/>
            </p>
            @else
            <p class="mb-1">
                Payment method:
                <input class="" name="" type="text" value="Card  NC"/>
            </p>
            @endif
            <p class="ps-5 ms-4">
                <button class="btn btn-primary btn-sm" data-bs-toggle="tooltip" data-container="body"  title="Save" type="submit">
                    <img src="{{url('fonts/save.png')}}"/>
                    
                </button>
            </p>
        </p>
    </form>
</div>
@push('js')
<script type="text/javascript">
    $(document).ready(function(){
        $('.billing-info-edit').css('display', 'none');
        $('#billing-info-view').on("click", function(e) {
            e.preventDefault();
            $('.billing-info-view').css('display', 'none');
            $('.billing-info-edit').css('display', 'block');
        })

        $(document).on('submit', '#billing-form', function(e) {
            e.preventDefault();
            let formData = $(this).serialize();
            var provience = $("#shipping_province").val();
            $('.billing-info-view').css('display', 'block');
            $('.billing-info-edit').css('display', 'none');
            axios.post('/admin/billing-info-edit',formData)
            .then((response) =>{
                if(response.data.status == true){
                    toastr.success(response.data.message);
                    window.location.reload();
                }
            })
            .catch((error) =>{
                 toastr.error(response.data.message);
            })
        })
    })
</script>
@endpush
