 @if($productFlitersRooms->count() > 0 || $productFlitersFeatures->count() > 0)
 <a href="javascript:void(0)">Feature/Room</a>
 <div class="dropdown-menu-items">
    <div class="row">
       
        @if($productFlitersFeatures->count() > 0)
        <div class="col-lg-7">
            <div class="fw-semibold">Features List:
                <hr class="mt-1 mb-2"/>
            </div>

            <ul class="dropdown-items  row">
                @foreach($productFlitersFeatures as $productFlitersFeature)
                <li class="col-lg-4"><a href="{{url('/shop/'.$productFlitersFeature->slug)}}">{{$productFlitersFeature->name}}</a>
                </li>
                @endforeach
            </ul>
        </div>
        @endif
         @if($productFlitersRooms->count() > 0)
        <div class="col-lg-5">
            <div class="fw-semibold">Rooms List:
                <hr class="mt-1  mb-2"/>
            </div>
            <ul class="dropdown-items">
                @foreach($productFlitersRooms as $productFliter)
                <li class="w-50"><a href="{{url('/shop/'.$productFliter->slug)}}">{{$productFliter->name}}</a>
                </li>
                @endforeach
            </ul>
        </div>
        @endif
    </div>
</div>
@endif