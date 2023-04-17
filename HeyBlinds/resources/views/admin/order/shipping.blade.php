<div class="shipping-info-view">
    <p class="mb-1">
        {{@$shippingAddress->first_name}}  {{ @$shippingAddress->last_name }}
    </p>
    <p class="mb-1">
        {{ @$shippingAddress->street }}, {{ @$shippingAddress->area_code }}
    </p>
    <p class="mb-1">
        {{ @$shippingAddress->city }},  {{ @$shippingAddress->province }}
    </p>
    <p class="mb-1">
        {{ @$shippingAddress->postal_code }}
    </p>
    <p class="mb-1">
        {{ @$shippingAddress->email }}
    </p>
    <p class="mb-2">
        {{ @$shippingAddress->phone_number }}
    </p>
    <p class="ps-5 ms-4">
        <button class="btn btn-primary btn-sm ms-5 " data-bs-toggle="tooltip" data-container="body" data-id="734" id="shipping-info-view" type="button">
            <svg class="bi bi-pencil-fill" fill="currentColor" height="16" viewbox="0 0 16 16" width="16" xmlns="http://www.w3.org/2000/svg">
                <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z">
                </path>
            </svg>
        </button>
    </p>
</div>
<div class="shipping-info-edit">

    <form id="shipping-form" method="post">
        <input type="hidden" name="shipping_id" value="{{@$shippingAddress->id}}">
        <input type="hidden" name="cart_id" value="{{@$cart->id}}">
        <p class="mb-1 d-flex">
            <input name="shipping_first_name" type="text" required value="{{ @$shippingAddress->first_name }}"/>
            <input name="shipping_last_name" type="text" required value="{{ @$shippingAddress->last_name }}"/>
        </p>
        <p class="mb-1 d-flex">
            <input name="shipping_street" type="text" required value="{{ @$shippingAddress->street }}"/>
            <input name="shipping_area_code" type="text"  value="{{ @$shippingAddress->area_code }}"/>
        </p>
        <p class="mb-1 d-flex">
            <input  name="shipping_city"  type="text" required value="{{ @$shippingAddress->city }}"/>
            <select  name="shipping_province"  id="shipping_province"  required>
                <option value="">Province</option>
                @foreach($proviences as $provience)
                <option value="{{$provience->code}}" {{$provience->code  == $shippingAddress->province ? 'selected' : ''}}>
                   {{$provience->code}}
                </option>
                @endforeach

            </select>
        </p>
        <p class="mb-1">
            <input name="shipping_postal_code" class="postal_code" type="text" maxlength="7" required value="{{ @$shippingAddress->postal_code }}"/>
        </p>
        <p class="mb-1">
            <input name="shipping_email" type="email" required value="{{ @$shippingAddress->email }}"/>
        </p>
        <p class="mb-2">
            <input name="shipping_phone_number" class="phone_number" maxlength="16"  type="text" required value="{{ @$shippingAddress->phone_number }}"/>
        </p>
        <p class="ps-5 ms-4">
            <button type="submit" class="btn btn-primary btn-sm" data-bs-toggle="tooltip" data-container="body" id="shipping-info-edit" title="Save" type="submit">
                <img src="{{url('fonts/save.png')}}"/>
            </button>
        </p>
    </form>
</div>
@push('js')

<script type="text/javascript">
    $(document).ready(function(){
        $('.shipping-info-edit').css('display', 'none');
        $('#shipping-info-view').on("click", function(e) {
            e.preventDefault();
            $('.shipping-info-view').css('display', 'none');
            $('.shipping-info-edit').css('display', 'block');
        })

        $(document).on('submit', '#shipping-form', function(e) {
            e.preventDefault();
            let formData = $(this).serialize();
            var provience = $("#shipping_province").val();
            $('.shipping-info-view').css('display', 'block');
            $('.shipping-info-edit').css('display', 'none');
            axios.post('/admin/shipping-info-edit',formData)
            .then((response) =>{
                if(response.data.status == true){
                    taxCalculation(provience);
                    toastr.success(response.data.message);
                    window.location.reload();
                }
            })
            .catch((error) =>{
                 toastr.error(response.data.message);
            })
        })
    })
      function taxCalculation(provience) {
            axios.post('/tax-calculation',{
                "provience": provience,
                "cart_id": {{$cart->id}}
            }).then((response) => {
                
            }).catch((error) =>{
            })
    }



</script>
@endpush