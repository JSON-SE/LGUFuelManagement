<div class="modal fade " id="sampleCart" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Sample Cart ( <span
                        id="sampleCartItems">{{ $sampleCount }}</span> )</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

            </div>
            <div class="modal-footer justify-content-center">
                <a href="{{ url('/') }}" class="btn btn-secondary btn-sm ms-2">Continue
                    Shopping</a>
                <button type="button" class="btn btn-primary btn-sm" id="finalizeSampleCart">Finalize Order</button>
            </div>
        </div>
    </div>
</div>
