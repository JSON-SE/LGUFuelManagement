<section id="banner" class="d-none d-sm-block">
    <div class="banner-slider">
        @if (!empty($promo->sliders))

            @foreach ($promo->sliders as $slider)
                {{-- @if (!empty($slider->media_id)) --}}
                <div>
                    <a href="{{ $slider->slider_link }}">
                        <img src="{{ $helpers->getSliderImage($slider->media_id) }}" alt="HeyBlinds Storewide Sale" />
                    </a>
                </div>
                {{-- @endif --}}
            @endforeach
            {{-- <div>
                    <a href="https://poll.app.do/canada-s-shadiest-politician-election-2021">
                        <img src="{{asset('images/banner/HeyBlinds_Shadiest_Politician_Slider.jpg')}}" alt="Hey-Blinds-banner" />
                    </a>
                </div> --}}
            {{-- <div>
                <a target="_blank" href="https://www.instagram.com/p/CWaiLfjo2Jq/">
                    <img src="{{ asset('images/banner/HeyHolidayGivewayHPBanner_Rev.png') }}" alt="Hey-Blinds-banner" />
                </a>
            </div> --}}

        @else

            <div>
                <a href="https://heyblinds.ca/warranty">
                    <img src="{{ asset('images/banner/HeyBlinds-warranty-1920x749.webp') }}"
                        alt="Hey-Blinds-banner" />
                </a>
            </div>
        @endif
    </div>
</section>
