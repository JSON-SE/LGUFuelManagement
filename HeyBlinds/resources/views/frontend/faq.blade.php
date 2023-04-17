@extends('layouts.Frontend.app')
@section('title')
    Window Blinds & Shades Frequently Asked Questions | HeyBlinds Canada
@endsection
@section('content')

    <section class="container">
        <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);"
            aria-label="breadcrumb">
            <ol class="breadcrumb mb-2 pt-2">
                <li class="breadcrumb-item"><a href="{{ route('welcome') }}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">FAQ</li>
            </ol>
        </nav>
        <div class="d-flex align-items-center justify-content-center text-light rounded bg-secondary">

            <div class="text-center py-5">
                <h1 class="heading-two text-light">Hey! Got a Question?</h1>
                <p class="mb-0">Find your answer here. <br />
                    If you don’t see the question or answer you’re looking for, please get in touch!</p>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">

                <div class="pt-3">
                    <h6 class="fw-bold w-100 mb-0 pt-1 font-secondary pb-2 text-primary">Blinds and Shades</h6>

                    <ul class="list-items faq-list-items">
                        <li><a href="#faq-1">Are there other products I can buy on your site?</a></li>
                        <li><a href="#faq-2">Do you supply catalogues or brochures?</a></li>
                        <li><a href="#faq-3">How do I know I'm buying a quality product?</a></li>
                        <li><a href="#faq-4">Why should 2 blinds be mounted on the same headrail?</a></li>
                        <li><a href="#faq-5">Where do I include special requests for my order? i.e., two blinds mounted on 1
                                headrail with the lift and controls in a specific place.</a></li>
                        <li><a href="#faq-6">What does Top Down/Bottom Up mean?</a></li>
                        <li><a href="#faq-7">What is a continuous cord loop?</a></li>
                        <li><a href="#faq-8">How do cordless blinds lift and lower?</a></li>
                        <li><a href="#faq-9">What does blackout mean?</a></li>
                        <li><a href="#faq-10">How do I figure out which blinds or shades I need?</a></li>
                        <li><a href="#faq-11">Which blinds are the most affordable?</a></li>
                        <li><a href="#faq-12">Which roller shade colours block sunlight the best?</a></li>
                        <li><a href="#faq-13">How should I remove blinds from my window?</a></li>
                        <li><a href="#faq-14">If my blind cords are too long how do I shorten them?</a></li>
                        <li><a href="#faq-15">What's the "Faux" in wood blinds?</a></li>
                        <li><a href="#faq-16">Which blinds are best for basements?</a></li>
                        <li><a href="#faq-17">If my room gets a lot of sun, which blinds should I choose?</a></li>
                        <li><a href="#faq-18">Why are cellular shades pricier than other shades?</a></li>
                        <li><a href="#faq-19">What is the best way to remove vertical blinds? </a></li>
                        <li><a href="#faq-20">Is there a standard size for blinds?</a></li>
                        <li><a href="#faq-20">What blinds should I choose for a picture window?</a></li>
                        <li><a href="#faq-21">What are the pros of roller shades?</a></li>
                        <li><a href="#faq-22">Are there other options to wood blinds?</a></li>
                        <li><a href="#faq-23">How much do Roman Blinds generally cost? </a></li>
                        <li><a href="#faq-24">How is a solar shade different?</a></li>
                        <li><a href="#faq-25">Which blackout shade is the best for a nursery?</a></li>
                        <li><a href="#faq-26">Which horizontal blinds offer the best view?</a></li>
                        <li><a href="#faq-27">What materials are used for a roller shade?</a></li>
                        <li><a href="#faq-28">How are Roman Shades different? </a></li>
                        <li><a href="#faq-29">How wide can I custom order a Roman Shade? </a></li>
                        <li><a href="#faq-30">What is a mini blind?</a></li>
                        <li><a href="#faq-31">What are the best black out shades you carry? </a></li>
                    </ul>
                </div>


                <div class="pt-3">
                    <hr />
                    <h6 class="fw-bold w-100 mb-0 pt-1 font-secondary pb-2 text-primary">Motorization</h6>

                    <ul class="list-items faq-list-items">
                        <li><a href="#faq-44">How do motorized blinds operate?</a></li>
                        <li><a href="#faq-45">Will one remote operate multiple shades? </a></li>
                    </ul>

                </div>
                

                <div class="pt-3">
                    <hr />
                    <h6 class="fw-bold w-100 mb-0 pt-1 font-secondary pb-2 text-primary">Returns</h6>

                    <ul class="list-items faq-list-items">
                        <li><a href="#faq-66">What is your return policy?</a></li>
                    </ul>

                </div>

            </div>

            <div class="col-md-6">
                <div class="pt-3">
                    <h6 class="fw-bold w-100 mb-0 pt-1 font-secondary text-primary pb-2">Measure And Install</h6>

                    <ul class="list-items faq-list-items">
                        <li><a href="#faq-32">How do I know which size blinds or shades to order?</a></li>
                        <li><a href="#faq-33">How do I install my new blinds or shades?</a></li>
                        <li><a href="#faq-34">Can I use the measurements of my old blinds?</a></li>
                        <li><a href="#faq-35">Should I round my measurements up or down?</a></li>
                        <li><a href="#faq-36">Does min flush-mount depth and min inside-mount depth mean the same?</a></li>
                        <li><a href="#faq-37">Will my blinds come with all the hardware and instructions?</a></li>
                        <li><a href="#faq-38">What if I measure wrong?</a></li>
                        <li><a href="#faq-39">I need more than one blind for my window. How do I measure?</a></li>
                        <li><a href="#faq-40">What is the difference between inside and outside mount?</a></li>
                        <li><a href="#faq-41">For Top-Down/Bottom-Up blinds is there a min width?</a></li>
                        <li><a href="#faq-42">For an inside mount, is there a min width for my window sill?</a></li>
                        <li><a href="#faq-43">Do you offer measuring/installation services?</a></li>
                    </ul>

                </div>

                <div class="pt-3">
                    <hr />
                    <h6 class="fw-bold w-100 mb-0 pt-1 font-secondary text-primary pb-2">Ordering Blinds and Shades</h6>

                    <ul class="list-items faq-list-items">
                        @if(config('global.is_heyblinds_com') != true)
                        <li><a href="#faq-47">I'm Canadian, can I order from HeyBlinds?</a></li>
                        @endif
                        <li><a href="#faq-48">Can I cancel or change my order once it's complete?</a></li>
                        <li><a href="#faq-49">Do the images on your site accurately show the colours of each product?</a>
                        </li>

                        @if(config('global.is_heyblinds_com') != true)
                        <li><a href="#faq-50">Are your prices Canadian?</a></li>
                        @endif

                        @if(config('global.is_heyblinds_com') != true)
                        <li><a href="#faq-51">Will I be charged tax? </a></li>
                        @endif

                        @if(config('global.is_heyblinds_com') != true)
                        <li><a href="#faq-52">How do I pay for my order?</a></li>
                        @endif
                        
                        <li><a href="#faq-53">Can I edit my cart?</a></li>

                        <li><a href="#faq-54">If I order samples during a promotion can I still get the deal even if I miss
                                the deadline?</a></li>
                        <li><a href="#faq-55">When will my credit card be charged for my order?</a></li>
                        <li><a href="#faq-56">Will you confirm my order?</a></li>
                        <li><a href="#faq-57">Is my personal information safe?</a></li>
                        <li><a href="#faq-58">Does your site accurately capture the look of light filtering fabrics? </a>
                        </li>
                        <li><a href="#faq-59">How do I place my order if I am a tax exempt customer? </a></li>
                        <li><a href="#faq-60">Which brands are sold through your site?</a></li>
                    </ul>

                </div>




                <div class="pt-3">
                    <hr />
                    <h6 class="fw-bold w-100 mb-0 pt-1 font-secondary text-primary pb-2">Shipping</h6>

                    <ul class="list-items faq-list-items">
                        @if(config('global.is_heyblinds_com') == true)
                        <li><a href="#faq-611">Do you ship to Hawaii or Alaska?</a></li>
                        @endif
                        <li><a href="#faq-61">When will I receive my order?</a></li>
                        <li><a href="#faq-62">Is shipping always free? </a></li>
                        <li><a href="#faq-64">How do I check the status of my order? </a></li>
                        <li><a href="#faq-65">Once I've ordered, when will my blinds or shades be shipped?</a></li>
                    </ul>

                </div>



                <div class="pt-3">
                    <hr />
                    <h6 class="fw-bold w-100 mb-0 pt-1 font-secondary text-primary pb-2">
                        Help</h6>

                    <ul class="list-items faq-list-items">
                        <li><a href="#faq-67">If my blind or shade breaks will you offer a replacement?</a></li>
                        <li><a href="#faq-68">Can I order replacement parts?</a></li>
                        <li><a href="#faq-69">How can I reach HeyBlinds?</a></li>
                    </ul>

                </div>

            </div>

        </div>

        <div class="pt-2 pb-5">
            <div id="faq-1" class="bg-ex-light p-3 rounded mt-4">
                <h6 class="fw-bold w-100 mb-0 pt-1 font-secondary pb-2">Are there other products I can buy on your site?
                </h6>
                <p class="mb-0">
                    HeyBlinds carries a wide variety of blackout blinds. <a
                        href="{{ url('/product/room-darkening-zebra-shades') }}">Zebra blackout blinds</a> are quickly
                    becoming
                    more popular due to their unique look. <a href="{{ url('/category/blinds-and-shades/roller-shades') }}">
                        Blackout Roller Shades</a> and <a href="{{ url('/category/blinds-and-shades/roman-shades') }}">Roman
                        Blinds</a> are always a classic choice.
                    <a href="{{ url('/category/blinds-and-shades/honeycomb-cellular-shades') }}"> Blackout Cellular
                        shades</a> will not only block the light,
                    they will also help to lower your energy bill.
                </p>
            </div>

            <div id="faq-2" class="bg-ex-light p-3 rounded mt-4">
                <h6 class="fw-bold w-100 mb-0 pt-1 font-secondary pb-2">Do you supply catalogues or brochures?</h6>
                <p class="mb-0">HeyBlinds is strictly an online store and does not print brochures or catalogues.
                    That helps us to keep things easy, economical, and environmentally friendly.</p>
            </div>

            <div id="faq-3" class="bg-ex-light p-3 rounded mt-4">
                <h6 class="fw-bold w-100 mb-0 pt-1 font-secondary pb-2">How do I know I'm buying a quality product?</h6>
                @if(config('global.is_heyblinds_com') == true)
                <p class="mb-0">
                    HeyBlinds only carries the best quality blinds available. Every product we sell has been carefully selected and tested for quality control. Our <a href="{{ url('/warranty') }}"> "100-Day Risk-Free In-Home Trial"</a>  guarantee lets you try out your blind to make sure you're completely satisfied with your purchase. Your blinds and shades also come with a <a href="{{ url('/warranty') }}"> 3 year warranty</a>.
                </p>
                @else
                
                <p class="mb-0">
                    HeyBlinds only carries the best quality blinds available. Every product we sell has been carefully selected and tested for quality control. Our <a href="{{ url('/warranty') }}"> 100-Day Risk-Free In-Home Trial</a> guarantee lets you try out your blind to make sure you're completely satisfied with your purchase. Your blinds and shades also come with a <a href="{{ url('/warranty') }}">3 year warranty</a>.

                </p>
                @endif
                
            </div>

            <div id="faq-4" class="bg-ex-light p-3 rounded mt-4">
                <h6 class="fw-bold w-100 mb-0 pt-1 font-secondary pb-2">Why should 2 blinds be mounted on the same headrail?
                </h6>
                <p class="mb-0">In certain cases there are weight limitations for particular blinds. If a blind is
                    too long the weight could add frequent strain on the working mechanism. For extra wide blinds, we
                    recommend splitting the blind into two separate blinds to reduce the weight and strain.</p>
            </div>

            <div id="faq-5" class="bg-ex-light p-3 rounded mt-4">
                <h6 class="fw-bold w-100 mb-0 pt-1 font-secondary pb-2">Where do I include special requests for my order?
                    i.e., two blinds mounted on 1 headrail with the lift and controls in a specific place.</h6>
                <p class="mb-0">You can let our HeyBlinds team know about any special instructions in the Notes
                    textbox that you'll find in your cart and on the checkout page. This is where you can, for example,
                    simply specify where you would like the tilt controls.(ex. for tilt controls on the outside of the
                    blinds enter: left blind tilt position=left, right blind tilt position=right)
                </p>
            </div>

            <div id="faq-6" class="bg-ex-light p-3 rounded mt-4">
                <h6 class="fw-bold w-100 mb-0 pt-1 font-secondary pb-2">What does Top Down/Bottom Up mean?</h6>
                <p class="mb-0">Top Down/Bottom Up means you can raise your blind from the bottom or lower it from
                    the top. So you can have the bottom or
                    top of your window blinds or shades open depending on the privacy you need or want.
                </p>
            </div>

            <div id="faq-7" class="bg-ex-light p-3 rounded mt-4">
                <h6 class="fw-bold w-100 mb-0 pt-1 font-secondary pb-2">What is a continuous cord loop?</h6>
                <p class="mb-0">Continuous cord loop means the cord used to raise and lower your shade is one
                    continuous loop operated by a
                    clutch mechanism. It makes the blind operate smoothly and is often recommended for larger blinds.
                </p>
            </div>

            <div id="faq-8" class="bg-ex-light p-3 rounded mt-4">
                <h6 class="fw-bold w-100 mb-0 pt-1 font-secondary pb-2">How do cordless blinds lift and lower?</h6>
                <p class="mb-0">No cords means you only have to grasp the bottom of the blind to raise or lower it
                    into place. Safe, quick, easy and clean.
                </p>
            </div>


            <div id="faq-9" class="bg-ex-light p-3 rounded mt-4">
                <h6 class="fw-bold w-100 mb-0 pt-1 font-secondary pb-2">What does blackout mean?</h6>
                <p class="mb-0">Blackout means no light will come through your shade. It will keep your room
                    completely dark.
                    Perfect for anyone who needs to get some extra shut-eye.
                </p>
            </div>


            <div id="faq-10" class="bg-ex-light p-3 rounded mt-4">
                <h6 class="fw-bold w-100 mb-0 pt-1 font-secondary pb-2">
                    How do I figure out which blinds or shades I need?</h6>
                <p class="mb-0">If you aren't sure where to start, just reach out to our Customer Care team,
                    they'll help guide you and narrow down
                    which blinds and shades best suit your needs.
                </p>
            </div>


            <div id="faq-11" class="bg-ex-light p-3 rounded mt-4">
                <h6 class="fw-bold w-100 mb-0 pt-1 font-secondary pb-2">Which blinds are the most affordable?</h6>
                <p class="mb-0">
                    You might be surprised to know that our <a
                        href="{{ url('/category/blinds-and-shades/faux-wood-blinds') }}"> 2" Faux Wood Blinds </a> are the
                    best priced blinds on our site.
                    Surprising right?
                    Because they don't look cheap at all. <a
                        href="{{ url('/category/blinds-and-shades/mini-blinds-aluminum') }}"> Aluminum mini-blinds </a> are
                    another great budget choice.
                </p>
            </div>

            <div id="faq-12" class="bg-ex-light p-3 rounded mt-4">
                <h6 class="fw-bold w-100 mb-0 pt-1 font-secondary pb-2">Which roller shade colours block sunlight the best?
                </h6>
                <p class="mb-0">
                    Dark colours like grey and black do a better job of reducing the light into a room. For a completely
                    dark room,
                    our <a href="{{ url('/category/blinds-and-shades/roller-shades') }}">blackout roller blinds </a> can
                    blockout 99% of incoming light.

                </p>
            </div>

            <div id="faq-13" class="bg-ex-light p-3 rounded mt-4">
                <h6 class="fw-bold w-100 mb-0 pt-1 font-secondary pb-2">How should I remove blinds from my window?</h6>
                <p class="mb-0">
                    Removing blinds from a window is very easy. Start by raising your blind completely. Release the clip
                    holding your blinds and set them aside. Next detach the headrail from the mounting clips holding it in
                    place.
                    To finish up, unscrew the mounting hardware. You're all done!
                </p>
            </div>

            <div id="faq-14" class="bg-ex-light p-3 rounded mt-4">
                <h6 class="fw-bold w-100 mb-0 pt-1 font-secondary pb-2">If my blind cords are too long how do I shorten
                    them?</h6>
                <p class="mb-0">
                    Lower your blinds all the way. Untie the knot at the end and cut your cords to the desired length.
                    Re-tie the knots at the end and you're all done.
                </p>
            </div>

            <div id="faq-15" class="bg-ex-light p-3 rounded mt-4">
                <h6 class="fw-bold w-100 mb-0 pt-1 font-secondary pb-2">What's the "Faux" in wood blinds?</h6>
                <p class="mb-0">
                    "Faux" is actually the French word for 'fake'. The "Faux" is a mixture of composite wood material or a
                    PVC/vinyl material, manufactured to look like real wood.
                    It's actually better than wood because they won't warp due to humidity.
                </p>
            </div>

            <div id="faq-16" class="bg-ex-light p-3 rounded mt-4">
                <h6 class="fw-bold w-100 mb-0 pt-1 font-secondary pb-2">Which blinds are best for basements?</h6>
                <p class="mb-0">
                    HeyBlinds recommends any blind that are durable and can resist moisture and humidity.
                    <a href="{{ url('/category/blinds-and-shades/faux-wood-blinds') }}">Faux Wood Blinds</a>, <a
                        href="{{ url('/category/blinds-and-shades/roller-shades') }}"> Roller Shades</a>, and <a
                        href="{{ url('/category/blinds-and-shades/mini-blinds-aluminum') }}">Aluminum Mini Blinds</a> are
                    perfect contenders for any basement.
                </p>
            </div>

            <div id="faq-17" class="bg-ex-light p-3 rounded mt-4">
                <h6 class="fw-bold w-100 mb-0 pt-1 font-secondary pb-2">If my room gets a lot of sun, which blinds should I
                    choose?</h6>
                <p class="mb-0">
                    If you're looking to eliminate light from the sun, HeyBlinds recommends choosing a blackout or <a
                        href="{{ url('/category/blinds-and-shades/solar-shades') }}"> solar shade</a>.
                    If you are wanting to control the temperature, <a
                        href="{{ '/category/blinds-and-shades/honeycomb-cellular-shades' }}">cellular shades</a> are a
                    great option.

                </p>
            </div>

            <div id="faq-18" class="bg-ex-light p-3 rounded mt-4">
                <h6 class="fw-bold w-100 mb-0 pt-1 font-secondary pb-2">Why are cellular shades pricier than other shades?
                </h6>
                <p class="mb-0">
                    <a href="{{ url('/category/blinds-and-shades/honeycomb-cellular-shades') }}"> Cellular shades</a> are
                    one of the hardest working shades on the market.
                    They have intricate layers of fabric that can control the heat and cold in your home.
                    With their ability to reduce your energy bill they are a wise investment.
                </p>
            </div>

            <div id="faq-19" class="bg-ex-light p-3 rounded mt-4">
                <h6 class="fw-bold w-100 mb-0 pt-1 font-secondary pb-2">What is the best way to remove vertical blinds?
                </h6>
                <p class="mb-0">
                    Rotate each blade so they are partially open and then begin to remove them. Remove the track by locating
                    the spring clip at the back and release it with a screw driver.
                    After you have removed the track unscrew all the mounting hardware so your window is ready for your next
                    window treatment.
                </p>
            </div>

            <div id="faq-20" class="bg-ex-light p-3 rounded mt-4">
                <h6 class="fw-bold w-100 mb-0 pt-1 font-secondary pb-2">Is there a standard size for blinds?</h6>
                <p class="mb-0">
                    Not really. Because windows come in all shapes and sizes, there isn't a true standard size for blinds.
                </p>
            </div>

            <div id="faq-21" class="bg-ex-light p-3 rounded mt-4">
                <h6 class="fw-bold w-100 mb-0 pt-1 font-secondary pb-2">What blinds should I choose for a picture window?
                </h6>
                <p class="mb-0">
                    When choosing a blind or shade, you should always think of your home's decor first. <a
                        href="{{ url('/category/blinds-and-shades/zebra-shades') }}"> Zebra blinds</a>,
                    <a href="{{ url('/category/blinds-and-shades/roller-shades') }}"> roller shades, </a> and <a
                        href="{{ url('/category/blinds-and-shades/faux-wood-blinds') }}">faux wood blinds </a> are all good
                    choices for larger windows.
                </p>
            </div>

            <div id="faq-22" class="bg-ex-light p-3 rounded mt-4">
                <h6 class="fw-bold w-100 mb-0 pt-1 font-secondary pb-2">What are the pros of roller shades?</h6>
                <p class="mb-0">
                    <a href="{{ url('/category/blinds-and-shades/roller-shades') }}">Roller blinds</a> are a great choice
                    if you want a blind that rolls right up completely, out of the way.
                    They are also very versatile, easy to clean, and require very little maintenance and upkeep.
                </p>
            </div>

            <div id="faq-23" class="bg-ex-light p-3 rounded mt-4">
                <h6 class="fw-bold w-100 mb-0 pt-1 font-secondary pb-2">Are there other options to wood blinds?</h6>
                <p class="mb-0">
                    If you're looking for a versatile blind that looks like real wood, then a <a
                        href="{{ url('/category/blinds-and-shades/faux-wood-blinds') }}"> faux wood blind</a> would be the
                    perfect choice for you.
                    They look like wood but don't warp, crack, or hold moisture. Only downside is they are a bit heavier
                    than real wood blinds.
                </p>
            </div>

            <div id="faq-24" class="bg-ex-light p-3 rounded mt-4">
                <h6 class="fw-bold w-100 mb-0 pt-1 font-secondary pb-2">How much do Roman Blinds generally cost? </h6>
                <p class="mb-0">
                    <a href="{{ url('/category/blinds-and-shades/roman-shades') }}">Roman blinds and shades</a> are
                    generally going to cost more than most other types
                    of blinds and shades. This is because they are made with more fabrics, and also require stronger lift
                    mechanisms due to their heavier weight.
                </p>
            </div>

            <div id="faq-25" class="bg-ex-light p-3 rounded mt-4">
                <h6 class="fw-bold w-100 mb-0 pt-1 font-secondary pb-2">How is a solar shade different?</h6>
                <p class="mb-0">
                    <a href="{{ url('/category/blinds-and-shades/solar-shades') }}">Solar shades</a> have the unique
                    ability to block out the sun's harmful UV rays.
                    During the day they block out the sun while still offering a view to the outside, and privacy. They come
                    in a range of open percentages so you can choose the blockage you need.
                    However, it's important to know, they do not provide privacy at night.
                </p>
            </div>

            <div id="faq-26" class="bg-ex-light p-3 rounded mt-4">
                <h6 class="fw-bold w-100 mb-0 pt-1 font-secondary pb-2">Which blackout shade is the best for a nursery?
                </h6>
                <p class="mb-0">
                    For nurseries we would recommend a <a
                        href="{{ url('/product/blackout-cordless-cellular-honeycomb-shades') }}"> blackout cordless
                        cellular shade</a>, or a
                    cordless <a href="{{ url('/category/blinds-and-shades/roman-shades') }}"> blackout roman shade</a>.
                    Both will block 99% of the light,
                    and the cordless option makes them safe for young children. A <a
                        href="{{ url('/category/blinds-and-shades/roller-shades') }}"> blackout roller blind</a> would also
                    be a good choice, with the cordless option.
                </p>
            </div>

            <div id="faq-27" class="bg-ex-light p-3 rounded mt-4">
                <h6 class="fw-bold w-100 mb-0 pt-1 font-secondary pb-2">Which horizontal blinds offer the best view?</h6>
                <p class="mb-0">
                    Our <a href="{{ url('/category/blinds-and-shades/faux-wood-blinds') }}"> 2" Faux Wood Blinds</a> offer
                    a lot of visibility between their wide slats. Similarly, <a
                        href="{{ url('/category/blinds-and-shades/zebra-shades') }}">Zebra Blinds</a>,
                    although a roller blind, offer the visibility of a wide slat vertical blind.
                </p>
            </div>

            <div id="faq-28" class="bg-ex-light p-3 rounded mt-4">
                <h6 class="fw-bold w-100 mb-0 pt-1 font-secondary pb-2">What materials are used for a roller shade?</h6>
                <p class="mb-0">
                    Our <a href="{{ url('/category/blinds-and-shades/roller-shades') }}"> roller blinds</a> come in a
                    traditional vinyl, light filtering fabric, and blackout fabric.
                    Depending on your needs, they are suitable for a variety of rooms and situations.
                </p>
            </div>

            <div id="faq-29" class="bg-ex-light p-3 rounded mt-4">
                <h6 class="fw-bold w-100 mb-0 pt-1 font-secondary pb-2">How are Roman Shades different? </h6>
                <p class="mb-0">
                    <a href="{{ url('/category/blinds-and-shades/roman-shades') }}">Roman Blinds</a> are made of fabric and
                    look equally appealing down or up. When down, they have the appearance of a tailored drape,
                    when raised they fold neatly into perfect pleats. They are a blind with the softness of a drape.
                </p>
            </div>

            <div id="faq-30" class="bg-ex-light p-3 rounded mt-4">
                <h6 class="fw-bold w-100 mb-0 pt-1 font-secondary pb-2">How wide can I custom order a Roman Shade?</h6>
                <p class="mb-0">
                    <a href="{{ url('/category/blinds-and-shades/roman-shades') }}">Roman Blinds </a> are lovely, but they
                    can get heavy. 120" is the max width you can order.
                    If your window is wider, we recommend having two blinds made for the same window.
                </p>
            </div>


            <div id="faq-31" class="bg-ex-light p-3 rounded mt-4">
                <h6 class="fw-bold w-100 mb-0 pt-1 font-secondary pb-2">What is a mini blind?</h6>
                <p class="mb-0">
                    <a href="{{ url('/category/blinds-and-shades/mini-blinds-aluminum') }}"> Mini Blinds </a> got their
                    name because they are, well, mini. They have narrow 1" aluminum slats and can fit into tight spaces
                    better than most blinds.
                </p>
            </div>

            <div id="faq-32" class="bg-ex-light p-3 rounded mt-4">
                <h6 class="fw-bold w-100 mb-0 pt-1 font-secondary pb-2">What are the best black out shades you carry?</h6>
                <p class="mb-0">
                    HeyBlinds carries a wide variety of black out blinds. Zebra black out blinds are quickly becoming more
                    popular due to their unique look. Blackout Roller Shades and Roman Blinds are always a classic choice.
                    Blackout Cellular shades will not only block the light, they will also help to lower your energy bill.
                </p>
            </div>

            <div id="faq-33" class="bg-ex-light p-3 rounded mt-4">
                <h6 class="fw-bold w-100 mb-0 pt-1 font-secondary pb-2">How do I know which size blinds or shades to order?
                </h6>
                <p class="mb-0">
                    To determine your blinds or shades’ size, you will need to take a few window measurements.
                    Don't worry; it's easy. Just follow our quick <a href="{{ url('/warranty') }}"> measuring guide</a> for
                    a perfect fit.
                </p>
            </div>
            <div id="faq-34" class="bg-ex-light p-3 rounded mt-4">
                <h6 class="fw-bold w-100 mb-0 pt-1 font-secondary pb-2">
                    How do I install my new blinds or shades?</h6>
                <p class="mb-0">
                    You can find everything you need to know for installing your blinds or shades on our installation
                    instructions page. No special skills or tool belt required.
                </p>
            </div>
            <div id="faq-35" class="bg-ex-light p-3 rounded mt-4">
                <h6 class="fw-bold w-100 mb-0 pt-1 font-secondary pb-2">
                    Can I use the measurements of my old blinds?</h6>
                <p class="mb-0">
                    Although that would be easy, it wouldn't give you the perfect fit. Your old blinds were made with
                    factory deductions
                    and wouldn't be the right measurements for your new ones. For help, check out our <a
                        href="{{ url('/measure-instructions') }}">Measuring Guide</a>.
                </p>
            </div>
            <div id="faq-36" class="bg-ex-light p-3 rounded mt-4">
                <h6 class="fw-bold w-100 mb-0 pt-1 font-secondary pb-2">Should I round my measurements up or down?</h6>
                <p class="mb-0">
                    When measuring, round down to the nearest 1/8" for width and round up to the nearest 1/8" for height.
                </p>
            </div>
            <div id="faq-37" class="bg-ex-light p-3 rounded mt-4">
                <h6 class="fw-bold w-100 mb-0 pt-1 font-secondary pb-2">Does min flush-mount depth and min inside-mount
                    depth mean the same?</h6>
                <p class="mb-0">
                    Those are two different measurements for different mounting specifications.
                    Min flush-mount depth is the depth needed to mount your blinds within the frame so they sit flush with
                    the window.
                    Min inside-mount depth is the depth needed to install the blind inside the window frame.
                </p>
            </div>
            <div id="faq-38" class="bg-ex-light p-3 rounded mt-4">
                <h6 class="fw-bold w-100 mb-0 pt-1 font-secondary pb-2">Will my blinds come with all the hardware and
                    instructions?</h6>
                <p class="mb-0">
                    Yes. You will have everything you need to install your blinds. You shouldn't need additional hardware
                    unless you are mounting into a surface material that requires anchors or screws that are more sturdy.
                    The instructions you receive will be easy to follow,
                    but you can also refer to our Installation Guide for quick reference tips.
                </p>
            </div>

            <div id="faq-39" class="bg-ex-light p-3 rounded mt-4">
                <h6 class="fw-bold w-100 mb-0 pt-1 font-secondary pb-2">What if I measure wrong?</h6>
                <p class="mb-0">
                    Don't worry! Our Right Fit Guarantee has you covered. If you make a mistake in measuring, we'll fix it
                    for free.
                    Check out the <a href="{{ url('/warranty') }}">HeyBlinds Guarantee page</a> for more information.
                </p>
            </div>

            <div id="faq-40" class="bg-ex-light p-3 rounded mt-4">
                <h6 class="fw-bold w-100 mb-0 pt-1 font-secondary pb-2">I need more than one blind for my window. How do I
                    measure?</h6>
                <p class="mb-0">
                    Measure the width of your window at the top, middle and bottom.
                    For 2 blinds, divide the smallest width by two. Then add 1/4" to each blind. Repeat the same process for
                    3 blinds.
                </p>
            </div>

            <div id="faq-41" class="bg-ex-light p-3 rounded mt-4">
                <h6 class="fw-bold w-100 mb-0 pt-1 font-secondary pb-2">What is the difference between inside and outside
                    mount?</h6>
                <p class="mb-0">
                    The difference between inside and outside mount refers to the way you can hang your blind or shade.
                    Inside mount means the blind or shade is attached within the window frame.
                    Outside mount means the blind or shade hangs from outside the window frame.
                </p>
            </div>

            <div id="faq-42" class="bg-ex-light p-3 rounded mt-4">
                <h6 class="fw-bold w-100 mb-0 pt-1 font-secondary pb-2">For Top-Down/Bottom-Up blinds is there a min width?
                </h6>
                <p class="mb-0">
                    Yes. In most cases the min width requirements begin at 18", but verify the measurement requirements for
                    your exact shade before ordering.
                    Detailed specifications are listed for each product.
                </p>
            </div>

            <div id="faq-43" class="bg-ex-light p-3 rounded mt-4">
                <h6 class="fw-bold w-100 mb-0 pt-1 font-secondary pb-2">For an inside mount, is there a min width for my
                    window sill?</h6>
                <p class="mb-0">
                    Yes. However, each blind has different measurement requirements. Check the product info for your exact
                    blind to get the measurements you need.
                </p>
            </div>

            <div id="faq-44" class="bg-ex-light p-3 rounded mt-4">
                <h6 class="fw-bold w-100 mb-0 pt-1 font-secondary pb-2">Do you offer measuring/installation services?</h6>
                <p class="mb-0">
                    Almost all of our customers measure and install on their own. By following the detailed <a
                        href="{{ url('/measure-instructions') }}"> instructions</a> on our site you will see how easy it
                    is to measure,
                    and when it comes to installing, if you can hang a picture frame on your wall then you will have no
                    trouble installing your blinds, it's really that easy!
                    And remember, our HeyOK Guarantees have got you covered just in case something goes wrong.
                </p>
            </div>

            <div id="faq-45" class="bg-ex-light p-3 rounded mt-4">
                <h6 class="fw-bold w-100 mb-0 pt-1 font-secondary pb-2">How do motorized blinds operate?</h6>
                <p class="mb-0">
                    Our motorized blinds are easy to operate with a programmable remote control. They can also be connected
                    to your Google Home, Alexa, Apple Home, or any mobile device with an add-on. You can also set schedules
                    to when your blinds go up or down depending on the app you use.
                </p>
            </div>

            <div id="faq-46" class="bg-ex-light p-3 rounded mt-4">
                <h6 class="fw-bold w-100 mb-0 pt-1 font-secondary pb-2">Will one remote operate multiple shades?</h6>
                <p class="mb-0">
                    Yes! Our motorized blinds allow you to operate up to 5 blinds from the same remote.
                    You can find more information on how to program your remote in the product description of your selected
                    motorized blind.
                </p>
            </div>
            @if(config('global.is_heyblinds_com') != true)
            <div id="faq-48" class="bg-ex-light p-3 rounded mt-4">
                <h6 class="fw-bold w-100 mb-0 pt-1 font-secondary pb-2">I'm Canadian, can I order from HeyBlinds?</h6>
                <p class="mb-0">
                    You bet! HeyBlinds is a Canadian owned and operated online store. And don't forget, HeyBlinds offers <a target="_blank" href="{{ url('/free-shipping') }}">free ground shipping</a> within Canada.
                </p>
            </div>
            @endif
            

            <div id="faq-49" class="bg-ex-light p-3 rounded mt-4">
                <h6 class="fw-bold w-100 mb-0 pt-1 font-secondary pb-2">Can I cancel or change my order once it's complete?
                </h6>
                <p class="mb-0">
                    Each order is sent to production within one business day after ordering. Please ensure that the sizes
                    and colours are correct before ordering. Orders that are cancelled or changed may incur a fee.
                    Feel free to contact us however as we will make every effort to make any changes we can without any
                    additional charges.
                </p>
            </div>

            <div id="faq-50" class="bg-ex-light p-3 rounded mt-4">
                <h6 class="fw-bold w-100 mb-0 pt-1 font-secondary pb-2">Do the images on your site accurately show the
                    colours of each product?</h6>
                <p class="mb-0">
                    We wish we could say that what you see is what you'll get, but in the land of computers and smart
                    phones, colours in images on screens often vary.
                    The best way to be sure you're ordering the right fabric colour is to request a free sample. Order as
                    many as you like, they are always free!
                </p>
            </div>
            @if(config('global.is_heyblinds_com') != true)
            <div id="faq-51" class="bg-ex-light p-3 rounded mt-4">
                <h6 class="fw-bold w-100 mb-0 pt-1 font-secondary pb-2">
                    Are your prices Canadian?</h6>
                <p class="mb-0">
                    Yes! HeyBlinds is a Canadian owned and operated online store, so we keep everything in CAD dollars.
                </p>
            </div>
            @endif

            @if(config('global.is_heyblinds_com') != true)
            <div id="faq-52" class="bg-ex-light p-3 rounded mt-4">
                <h6 class="fw-bold w-100 mb-0 pt-1 font-secondary pb-2">Will I be charged tax?</h6>
                <p class="mb-0">
                    Yes, you will automatically be charged sales tax based on your province.
                </p>
            </div>
            @endif

            @if(config('global.is_heyblinds_com') != true)
            <div id="faq-53" class="bg-ex-light p-3 rounded mt-4">
                <h6 class="fw-bold w-100 mb-0 pt-1 font-secondary pb-2">How do I pay for my order?</h6>
                <p class="mb-0">
                    We accept Visa, MasterCard and American Express cards, as well as Interac.
                </p>
            </div>
            @endif

            

            <div id="faq-54" class="bg-ex-light p-3 rounded mt-4">
                <h6 class="fw-bold w-100 mb-0 pt-1 font-secondary pb-2">Can I edit my cart?</h6>
                <p class="mb-0">
                    Yes, you can edit your shopping cart before you submit your order.
                    Click on the shopping cart icon and select "edit" under the product you wish to change.
                    Once you're done, update your order and continue shopping.
                </p>
            </div>

            <div id="faq-55" class="bg-ex-light p-3 rounded mt-4">
                <h6 class="fw-bold w-100 mb-0 pt-1 font-secondary pb-2">If I order samples during a promotion can I still
                    get the deal even if I miss the deadline?</h6>
                    @if(config('global.is_heyblinds_com') == true)
                         Absolutely! We want you to love your blinds and take the time make a good decision with a few samples. We will honor the promotion up to 21 days from the date you ordered your samples. Our Customer Care team will be happy to help you. Contact us once you're ready to order and we'll make sure you get the discount.     
                    @else
                    <p class="mb-0">
                        {{-- Absolutely! We want you to love your blinds and take the time make a good decision with a few samples.
                        We will honour the promotion up to 30 days from the date you ordered your samples. Our Customer Care
                        team will be happy to help you.
                        Contact us once you're ready to order and we'll make sure you get the discount. --}}

                        Absolutely! We want you to love your blinds and take the time make a good decision with a few samples. We will honour the promotion up to 21 days from the date you ordered your samples. Our Customer Care team will be happy to help you. Contact us once you're ready to order and we'll make sure you get the discount.


                    </p>
                    @endif
                
            </div>

            <div id="faq-56" class="bg-ex-light p-3 rounded mt-4">
                <h6 class="fw-bold w-100 mb-0 pt-1 font-secondary pb-2">When will my credit card be charged for my order?
                </h6>
                <p class="mb-0">
                    Once you place your order, your card will be charge immediately. Because your blinds are custom made to
                    your exact window measurements, we require payment in full. But don't worry.
                    Our HeyOK Warranties are there to give you peace of mind shopping.
                </p>
            </div>

            <div id="faq-57" class="bg-ex-light p-3 rounded mt-4">
                <h6 class="fw-bold w-100 mb-0 pt-1 font-secondary pb-2">Will you confirm my order?</h6>
                <p class="mb-0">
                    Yes. Once you've submitted your order you will immediately receive an email confirming all the details.
                </p>
            </div>

            <div id="faq-58" class="bg-ex-light p-3 rounded mt-4">
                <h6 class="fw-bold w-100 mb-0 pt-1 font-secondary pb-2">Is my personal information safe?</h6>
                <p class="mb-0">
                    Absolutely. The information you share with us is safe and will never be shared with a third party. And
                    we never store any payment or credit card information on our site.
                </p>
            </div>

            <div id="faq-59" class="bg-ex-light p-3 rounded mt-4">
                <h6 class="fw-bold w-100 mb-0 pt-1 font-secondary pb-2">Does your site accurately capture the look of light
                    filtering fabrics?</h6>
                <p class="mb-0">
                    While the quality of the images on our site are high and fairly accurate, it is difficult to
                    authentically capture light filtering through fabric. We recommend ordering a free sample - you can
                    order as many as you need - to see exactly how the fabric will look when light is filtered through.
                </p>
            </div>

            <div id="faq-60" class="bg-ex-light p-3 rounded mt-4">
                <h6 class="fw-bold w-100 mb-0 pt-1 font-secondary pb-2">How do I place my order if I am a tax exempt
                    customer?</h6>
                <p class="mb-0">
                    After you have placed your order on our site, including the usual sales taxes, you can then use your
                    order confirmation to apply for your tax-exempt refund.
                </p>
            </div>

            <div id="faq-61" class="bg-ex-light p-3 rounded mt-4">
                <h6 class="fw-bold w-100 mb-0 pt-1 font-secondary pb-2">Which brands are sold through your site?</h6>
                <p class="mb-0">
                    HeyBlinds works with a number of high-quality North American window covering factories, to produce the
                    best quality blinds and shades at the lowest prices.
                    All of our products are backed by our industry best HeyOK Warranties.
                </p>
            </div>

            <div id="faq-62" class="bg-ex-light p-3 rounded mt-4">
                <h6 class="fw-bold w-100 mb-0 pt-1 font-secondary pb-2">When will I receive my order?</h6>
                <p class="mb-0">
                    You should receive your order within 2-3 weeks of ordering. Once you've placed your order, your custom
                    blind or shade will go into production the
                    following business day. Production, depending on your selection, takes 5-10 business days to complete.

                </p>
            </div>

            <div id="faq-63" class="bg-ex-light p-3 rounded mt-4">
                <h6 class="fw-bold w-100 mb-0 pt-1 font-secondary pb-2">Is shipping free?</h6>
                @if(config('global.is_heyblinds_com') == true)
                Yes! HeyBlinds offers <a target="_blank" href="{{ url('/free-shipping') }}">free ground shipping</a>, within all 48 contiguous states. 
                @else
                <p class="mb-0">
                    Yes! HeyBlinds offers <a target="_blank" href="{{ url('/free-shipping') }}">free ground shipping</a>, within Canada.
                </p>
                @endif
                
            </div>

            {{-- <div id="faq-64" class="bg-ex-light p-3 rounded mt-4">
            <h6 class="fw-bold w-100 mb-0 pt-1 font-secondary pb-2">Do you ship to Hawaii or Alaska?</h6>
            <p class="mb-0">
                Unfortunatel no. Sadl HeyBlinds is unable to ship blinds or shades to Hawaii or Alaska.
            </p>
        </div> --}}

            <div id="faq-65" class="bg-ex-light p-3 rounded mt-4">
                <h6 class="fw-bold w-100 mb-0 pt-1 font-secondary pb-2">How do I check the status of my order? </h6>
                <p>
                    Your order gets processed immediately, and production starts the following business day.
                    We aim to get your custom-made blinds or shades out the door as soon as possible,
                    with production times that vary by product from 2-10 business days,
                    starting the business day after we receive your order.
                </p>
                <p class="mb-0">
                    Once your order is ready for shipment, you will receive an email containing tracking information.
                    Shipping takes another 1-5 business days. Most orders are received within 2-3 weeks after the order is
                    placed.
                </p>
            </div>

            <div id="faq-66" class="bg-ex-light p-3 rounded mt-4">
                <h6 class="fw-bold w-100 mb-0 pt-1 font-secondary pb-2">Once I've ordered, when will my blinds or shades be
                    shipped?</h6>
                <p class="mb-0">
                    Once you've placed your order, your custom blinds or shades will go into production the following
                    business day.
                    Production, depending on your selection, takes 5-10 business days to complete.
                    Shipping takes another 1-5 business days. Most orders are received within 2-3 weeks after the order is
                    placed.
                </p>
            </div>

            <div id="faq-67" class="bg-ex-light p-3 rounded mt-4">
                <h6 class="fw-bold w-100 mb-0 pt-1 font-secondary pb-2">What is your return policy?</h6>
                <p class="mb-0">
                    At HeyBlinds, we sell custom made window treatments manufactured with extreme care to the specifications
                    provided by our customers.
                    For this reason, most orders are non-returnable.
                    But our <a href="{{ url('/warranty') }}"> HeyOK Warranties</a> have you covered if something ever goes
                    wrong or isn’t quite right.
                </p>
            </div>

            <div id="faq-68" class="bg-ex-light p-3 rounded mt-4">
                <h6 class="fw-bold w-100 mb-0 pt-1 font-secondary pb-2">If my blind or shade breaks will you offer a
                    replacement?</h6>
                    @if(config('global.is_heyblinds_com') == false)
                        Your blind or shade was built to last, but we know sometimes accidents happen. All of our blinds and shades come with a <a href="{{ route('frontend.warranty') }}"> 3 Year Limited Warranty</a>.
                    @else
                    <p class="mb-0">
                        {{-- Your blind or shade was built to last, but we know sometimes accidents happen. All of our blinds and
                        shades come with a <a href="{{ route('frontend.warranty') }}">7 Year Unlimited Warranty</a>. --}}

                        Your blind or shade was built to last, but we know sometimes accidents happen. All of our blinds and shades come with a <a href="{{ route('frontend.warranty') }}"> 3 Year Limited Warranty</a>.
                    </p>
                    @endif
                
            </div>

            <div id="faq-69" class="bg-ex-light p-3 rounded mt-4">
                <h6 class="fw-bold w-100 mb-0 pt-1 font-secondary pb-2">Can I order replacement parts?</h6>
                @if(config('global.is_heyblinds_com') == true)
                <p class="mb-0">
                    Definitely. Just call our Customer Care with your order number and the part you need to replace. If you no longer have your order number, we'll find it for you. 
                </p>
                @else
                <p class="mb-0">
                    Definitely. Just call our Customer Care with your order number and the part you need to replace. If you no longer have your order number, we'll find it for you. 
                </p>
                    
                @endif
                
            </div>

            <div id="faq-70" class="bg-ex-light p-3 rounded mt-4">
                
                <h6 class="fw-bold w-100 mb-0 pt-1 font-secondary pb-2">How can I reach HeyBlinds?</h6>
                @if(config('global.is_heyblinds_com') == true)
                You can call us at 888-412-3439 or chat with us online, during our service hours of 8AM-10PM EST, Monday - Friday.
                @else
                <p class="mb-0">
                    You can call us at 888-412-3439 or chat with us online, during our service hours of 8AM-10PM EST, Monday - Friday.
                </p>
                @endif
            </div>
            @if(config('global.is_heyblinds_com') == true)
            <div id="faq-611" class="bg-ex-light p-3 rounded mt-4">
                <h6 class="fw-bold w-100 mb-0 pt-1 font-secondary pb-2">Do you ship to Hawaii or Alaska?</h6>
                <p class="mb-0">
                    Unfortunately no 😞
                </p>
            </div>
            @endif

        </div>

    </section>



@endsection
