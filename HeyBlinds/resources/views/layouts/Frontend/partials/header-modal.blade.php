<div class="modal fade " id="RightFit-Guarantee" tabindex="-1" aria-labelledby="RightFitGuarantee" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header border-0 pb-0">
                <div><img src="{{ asset('images/icon7.png') }}" alt="Hey Blindes RightFit Guarantee" /></div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h5 class="modal-title fw-semibold pb-4" id="RightFitGuarantee">RightFit<small style="top: -10px"
                        class="TrademarkSymbol">&reg;</small> &nbsp; Guarantee</h5>
                <p>
                    Make a mistake measuring, and we’ll fix it for free.
                </p>

                <p>
                    That’s right. Even if you make a slight mistake, we’ll remake your blind for free because we want
                    your blind to fit
                    perfectly for a professional look.
                </p>
            </div>

        </div>
    </div>
</div>



<div class="modal fade " id="Risk-Free-Trial" tabindex="-1" aria-labelledby="RiskFreeTrial" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header border-0 pb-0">
                <div><img src="{{ asset('images/icon8.png') }}" alt="Hey Blindes Risk Free Trial" /></div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h5 class="modal-title fw-semibold pb-4" id="RiskFreeTrial">100 Day Risk-Free In-Home Trial</h5>
                <p>
                    We want you to be sure you’ve chosen the right blind in the right colour and texture.
                </p>

                <p>
                    That’s why we’ll let you live with your blind for 100 days so you can be confident you made the
                    right choice.
                </p>
                <p>
                    We don't want anyone unhappy so if you're not satisfied with your purchase, we'll do everything in
                    our power to make you happy. But if it's just impossible for us to make you happy then rest assured
                    we’ll be here to help you with returning your order for a refund or exchange!
                </p>
                <p>
                    Make sure you’re covered by our 100 Day RIsk-Free In-Home Trial by ordering free samples. That way,
                    you can better see how the colours & materials will look and feel for a perfect complement to your
                    room—order as many as you like. HeyBlinds will ship them all for free. And we’ll lock in today’s
                    sale pricing for 3 weeks so that you have time to be sure of your choice before ordering!
                </p>
                <p>
                    See our <a href="{{ url('/warranty') }}" target="_blank">warranty page</a> for full details.
                </p>
            </div>

        </div>
    </div>
</div>



<div class="modal fade " id="Price-Lowest-Guarantee" tabindex="-1" aria-labelledby="PriceLowestGuarantee"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header border-0 pb-0">
                <div><img src="{{ asset('images/icon9.png') }}" alt="Hey Blindes Delivery Truck" /></div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            @if (config('global.is_heyblinds_com') == true)
                <div class="modal-body">
                    <h5 class="modal-title fw-semibold pb-4" id="PriceLowestGuarantee">Hey, found a better price? We’ll
                        beat it, guaranteed.</h5>
                    <p>
                        Whether you buy one blind or enough for your entire home, we’ll guarantee you got the lowest
                        price for up to 21 days after your purchase.
                    </p>
                    <p>
                        If you find a lower price, we’ll not only match it; we’ll beat it with an additional 10%
                        discount on the difference.
                    </p>
                </div>
            @else
                <div class="modal-body">
                    <h5 class="modal-title fw-semibold pb-4" id="PriceLowestGuarantee">Best Price Guarantee</h5>
                    <p>
                        Hey, found a better price? We’ll beat it, guaranteed.
                    </p>
                    <p>
                        Whether you buy one blind or enough for your entire home, we guarantee you paid the lowest price
                        for 60 days after your purchase.
                    </p>
                    <p>
                        If you find a lower price, we’ll not only match it; we’ll beat it with an additional 10%
                        discount on the difference.
                    </p>
                </div>
            @endif
        </div>
    </div>
</div>



<div class="modal fade " id="Shipping-On-Everything" tabindex="-1" aria-labelledby="ShippingOnEverything"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header border-0 pb-0">
                <div><img src="{{ asset('images/delivery-truck.png') }}" alt="Hey Blindes Delivery Truck" /></div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h5 class="modal-title fw-semibold pb-4" id="ShippingOnEverything">Free Shipping</h5>
                @if (config('global.is_is_heyblinds_com') == true)
                    <p>
                        HeyBlinds offers free ground shipping to the lower 48. We do not ship to P.O. Boxes, APO/FPO
                        addresses, or anywhere outside the 48 contiguous United States. Orders with horizontal blinds or
                        shades that are 94” wide or more, or with vertical blinds that are 94” long or more, are shipped
                        for a flat, non-refundable $75 oversize freight fee. You can expect to receive your blinds
                        approximately 2-3 weeks after ordering. Oversized blinds and shipments to rural areas may take
                        longer.
                    </p>
                @else
                    <p>
                        HeyBlinds offers free ground shipping, within Canada. Orders with horizontal blinds or shades
                        that
                        are 94” wide or more, or with vertical blinds that are 94” long or more, are shipped for a flat,
                        non-refundable $85 oversize freight fee. You can expect to receive your blinds approximately 2-3
                        weeks after ordering. Oversized blinds and shipments to rural areas may take longer.
                    </p>
                @endif
            </div>

        </div>
    </div>
</div>


<div class="modal fade " id="Year-Unlimited-Warranty" tabindex="-1" aria-labelledby="7YearUnlimitedWarranty"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header border-0 pb-0">
                <div>
                    <img src="{{ asset('images/icon10.png') }}" alt="Hey Blindes Delivery Truck" />
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h5 class="modal-title fw-semibold pb-4" id="7YearUnlimitedWarranty">FREE Limited Lifetime Warranty</h5>

                <p>We've got you covered!</p>


                <p>
                    Your blind was designed for so much more than just looks and function. It was designed for life!
                    That’s why we offer our FREE Limited Lifetime Warranty.
                </p>

                <p>
                    If your blinds arrive damaged, something breaks or if there is any kind of defect in materials and
                    workmanship, you're covered for the next 10 years. See our <a
                        href="{{ url('/warranty#Warranties') }}" target="_blank">HeyOK Warranties</a> page under Help
                    for all the details.
                </p>

            </div>

        </div>
    </div>
</div>
