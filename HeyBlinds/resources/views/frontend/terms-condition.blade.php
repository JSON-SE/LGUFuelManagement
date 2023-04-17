@extends('layouts.Frontend.app')
@section('title')
    Terms & Conditions | HeyBlinds Canada
@endsection
@section('content')

<section class="container">
    <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);"
        aria-label="breadcrumb">
        <ol class="breadcrumb mb-2 pt-2">
            <li class="breadcrumb-item"><a href="{{route('welcome')}}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Terms and Conditions</li>
        </ol>
    </nav>
    <div class="inner-banner rounded">
        <img class="rounded" src="{{asset('images/shipping-banner.jpg')}}" alt="" />
        <div class="inner-banner-text">
            Terms and Conditions
        </div>
    </div>

</section>

<section id="body-content">
    <div class="container py-4 pb-4 pb-xxl-5">
        <h1 class="heading-one pt-3">Everything you need to know about your order and more!</h1>
        <h5>Ordering from HeyBlinds! should always be easy.</h5>
        <h5 class="mt-5 fw-bold border-start border-4 border-primary ps-2">Return Policy</h5>
        <p>At HeyBlinds.ca, we strive to ensure that each of our customers is fully satisfied with their orders. We offer our 100% Satisfaction Guarantee: if you’re not 100% satisfied with your window coverings, contact us within 100 days of when your order was received, and we’ll do everything possible to work with you to make sure you’re happy with your purchase. If you’re still not fully pleased with your coverings, we offer store credits to be used on other coverings and products that may be more suitable for your specific situation.</p>
        <p>To receive the merchandise credit option, the original blinds will need to be donated to a charity that is both registered and able to provide a copy of the donation receipt for you to send back to us, including the recipient being listed as HeyBlinds.ca. Please be aware that, in some cases (e.g., high-value motorized blinds), the original blinds will instead need to be returned to us here at HeyBlinds.ca. Please <a href="{{url('/contact-us')}}" class="text-decoration-underline">contact our Customer Service</a> department before proceeding with the donation option for any of our blinds.</p>

        <h5 class="mt-4 fw-bold border-start border-4 border-primary ps-2">Satisfaction Guarantee</h5>
        <p>View our <a href="{{ url('/warranty') }}" class="text-decoration-underline">Satisfaction Guarantee</a> page for further details.</p>

        <h5 class="mt-4 fw-bold border-start border-4 border-primary ps-2">Express Shipping Disclaimer</h5>
        <p>For customers requiring their orders to have quicker than usual processing and receiving times, HeyBlinds.ca is able to offer express shipping options. Please be aware that standard shipping times are provided in each product’s “Shipping and Production” tab, which can be found towards the bottom of each product page. </p>

        <h5 class="mt-4 fw-bold border-start border-4 border-primary ps-2">Discount Codes</h5>
        <p>Discount codes for our products are subject to time limitations. Some discount codes will not be able to be combined with some of our other offers or available promotions.</p>

        <h5 class="mt-4 fw-bold border-start border-4 border-primary ps-2">Pricing Policy</h5>
        <p>HeyBlinds.ca makes every effort for ensuring the accuracy of all item descriptions, product images, detailed specifications, item pricing, links, and all additional product-related information, both on and referenced here on our website. Although we strive for perfection, some flaws or changes in information may still slip past us at times, so we cannot fully guarantee that all item descriptions, product images, detailed specifications, item pricing, links, and all additional product-related information listed is fully accurate, complete, or up-to-date, nor can we assume responsibility for any of these potential inaccuracies. In the event that one of our product listings on the HeyBlinds.ca website includes an incorrect price due to potential technical, typographical, informational, or other error, HeyBlinds.ca reserves the right to refuse processing and/or cancel any order of the mispriced product(s) and will immediately revise, correct, and/or remove the erroneous details.</p>

        <h5 class="mt-4 fw-bold border-start border-4 border-primary ps-2">Free Shipping</h5>
        <p>We offer FREE shipping to all locations in Canada for any blinds that are less than 94" wide (verticals less than 94” long), available to all areas where ground shipping is possible. There may be a one-time oversize charge ($85) for any orders with blinds that are 94" wide (verticals - 94” long) or larger. If ground shipping is unavailable in your area, we’ll notify you of any additional shipping costs ahead of your order being shipped. HeyBlinds.ca only ships to addresses located in Canada.</p>

        <h5 class="mt-4 fw-bold border-start border-4 border-primary ps-2">Order Processing Fee</h5>
        <p>HeyBlinds.ca may stick with the industry standard regarding our order processing fees: these range from $5-$30 depending upon the quantity of blinds being purchased as well as the overall value of the order placed. By implementing this particular fee, we’re able to keep our prices low and keep our shipping FREE for all of the orders placed and shipped to recipients within Canadian borders. </p>

        <h5 class="mt-5 fw-bold border-start border-4 border-primary ps-2">Terms and Conditions</h5>
        <p><b>1.</b> Unless otherwise noted, you should assume that everything contained within our site is copyrighted material and may not be used or duplicated without the express written consent of the HeyBlinds.ca company. The only exceptions are provided within these terms and conditions or otherwise listed in the site itself.</p>
        <p><b>2.</b> HeyBlinds.ca is not liable for, and assumes no liability for, any damages to your computer equipment (e.g., viruses) or other property resulting from your access to, use of, or browsing within the website or resulting from your personal choice of downloading any materials, images, videos, data, audio, or text from the site. </p>
        <p><b>3.</b> Any content you transmit to our website via email or other methods (i.e., any questions, comments, data, recommendations, or other) is, and will be treated as, nonproprietary, unless otherwise specifically noted. Anything transmitted to us by you becomes the property of HeyBlinds.ca and may be used for any purpose we may see fit. This is including, but not limited to, disclosure, reproduction, transmission, posting, or general public information. </p>
        <p><b>4.</b> As indicated within our Privacy Statement, all information submitted via this site shall be deemed and remain the property of HeyBlinds.ca and its affiliates. Both HeyBlinds.ca and our affiliates will be free to use, for any purpose, any concepts, ideas, know-how, or techniques contained within the information a visitor to our site provides through the website. HeyBlinds.ca and its affiliates will not be subject to any obligations of confidentiality in regard to submitted information except as agreed upon by the entity having the direct customer relationship or as otherwise specifically agreed or required by law.  </p>
        <p><b>5.</b> HeyBlinds.ca will occasionally monitor or review posts and transmissions on the site but is under no obligation to do so and assumes zero liability for damages or other concerns occurring from the existence of the content of any such postings or transmissions. We also assume no liability for the events arising from any error, libel, slander, defamation, omission, falsehood, obscenity, profanity, pornography, danger, or inaccuracy contained within any of the information within such locations on the site. Visitors to the site are prohibited from posting or transmitting any unlawful, threatening, defamatory, libelous, scandalous, inflammatory, obscene, pornographic, or profane material or any material that could possibly constitute or encourage behavior that would be considered a criminal offense, give rise to civil liability, or otherwise violate any laws. HeyBlinds.ca will fully cooperate alongside any law enforcement authorities or court orders requesting or instructing HeyBlinds.ca to disclose the identity of any individual posting any such materials or information. </p>

        <h5 class="mt-4 fw-bold border-start border-4 border-primary ps-2">Order Changes and Cancellations</h5>
        <p>Here at HeyBlinds.ca, we’re willing to do everything possible to help you with any changes you may need to make regarding your order. Your order is sent directly to the manufacturer to ensure the timely fabrication and delivery of your blinds, shades, and shutters. In most cases, you may be able to make changes to your order within the first 24 hours without incurring any additional fees, but certain products instantly go into production, and these will warrant a fee to change. All order modifications and cancellations must be made over the phone. Once your order has shipped from the factory, address changes may not be possible, and will incur additional shipping charges if they are.</p>

        <h5 class="mt-4 fw-bold border-start border-4 border-primary ps-2">Phone Orders</h5>
        <p>To ensure that orders placed over the phone are indeed accurate, customers will receive an order confirmation via email from HeyBlinds.ca and are required to verify their orders online. Our 100% Satisfaction Guarantee is only applicable to phone orders that have been verified online by the customer for complete accuracy before purchase. If you do not receive an order confirmation via email, please contact HeyBlinds.ca at your earliest convenience so we can resend your verification and be sure that your order is covered by our 100% Satisfaction Guarantee. </p>

        <h5 class="mt-4 fw-bold border-start border-4 border-primary ps-2">Damaged Shipments</h5>
        <p>Any shipments that have been damaged must be reported to the HeyBlinds.ca Customer Service Department within 30 days of delivery.</p>

        <h5 class="mt-5 fw-bold border-start border-4 border-primary ps-2">Privacy</h5>
        <p class="mb-2 mt-2">This privacy statement covers the entire website at <a href="{{ route('welcome') }}" class="text-decoration-underline">www.HeyBlinds.ca</a></p>
        <ul class="ms-4 mb-2 list-items">
            <li>What personally identifiable information is collected by HeyBlinds.ca.</li>
            <li class="mt-2">What personally identifiable information third parties collect via our website.</li>
            <li class="mt-2">Which organization collects this information.</li>
            <li class="mt-2">How HeyBlinds.ca uses the information collected.</li>
            <li class="mt-2">With whom HeyBlinds.ca may share user information.</li>
            <li class="mt-2">The options available to users regarding the collection, distribution, and use of the collected information.</li>
            <li class="mt-2">The types of security procedures that are in place for protecting against the loss, misuse, or modification of information under HeyBlinds.ca’s control.</li>
            <li class="mt-2">How users can resolve any inaccuracies contained within the collected information.</li>
        </ul>
        <p>For any questions or concerns users may have regarding this statement, they should first contact Robert Mendelson, General Manager, by <a href="mailto:robert@heyblinds.ca" class="text-decoration-underline">email.</a></p>

        <h5 class="mt-4 fw-bold border-start border-4 border-primary ps-2">Information Collection and Use</h5>
        <p class="mb-1">HeyBlinds.ca is the sole owner of the information collected on <a href="{{ route('welcome') }}" class="text-decoration-underline">www.HeyBlinds.ca</a> This information is collected by HeyBlinds.ca at several different points within the website.</p>

        <h5 class="mt-4 fw-bold border-start border-4 border-primary ps-2">Shopping Cart</h5>
        <p>Users must first complete the required registration form on our website before being able to purchase any available products. During this application process, the user is required to provide contact information (e.g., a name and email address), a physical address, and their credit card information for the sake of the purchasing transaction. This information is required because HeyBlinds.ca will need to:</p>
        <ul class="ms-4 mb-2 list-disc">
            <li>Contact the individual about any services on our website for which they have expressed interest; and</li>
            <li class="mt-2">Process any orders submitted by the user.</li>
        </ul>

        <h5 class="mt-4 fw-bold border-start border-4 border-primary ps-2">Information Use</h5>
        <p>Information provided to HeyBlinds.ca is not shared with any parties or entities not specifically involved in the industry of blind and/or shade and/or shutter manufacture and distribution. Any of your information collected will not be shared, sold, or otherwise distributed to any individual, group, or entity aside from our blind/shade/shutter fabricators and freight forwarders who will require your shared information for the sake of producing and shipping your ordered product. The need for both privacy and security regarding your financial and personal information is taken seriously here at HeyBlinds.ca, and we take every measure to ensure your data is secure.</p>

        <h5 class="mt-4 fw-bold border-start border-4 border-primary ps-2">Log Files</h5>
        <p>As with most website servers you interact with on a daily basis, we also use log files. This includes internet protocol (IP) addresses, internet service provider (ISP), browser type, referring/exit pages, date/time stamp, platform type, and the number of clicks while on our site to analyze trends, track user movement within the aggregate, and administer the site, as well as assemble broad demographic information for collective use. IP addresses, ISP information, and similar data are not linked to your personally identifiable information. </p>

        <h5 class="mt-4 fw-bold border-start border-4 border-primary ps-2">Special Offers and Updates</h5>
        <p>All new members receive a welcome email from us to verify their password and username. Established members of HeyBlinds.ca can opt-in to receive our newsletter as well as updates on product information, services, and any special deals or promotions we may be running. For those who aren’t interested in receiving these types of communications, we also offer the option to opt-out via a link provided at the bottom of the emails.</p>

        <h5 class="mt-4 fw-bold border-start border-4 border-primary ps-2">Newsletter</h5>
        <p>If you’d like to subscribe to our newsletter, the only information we’ll ask for is your general contact information (i.e., your name and email address). As with our notifications regarding special offers and updates, you can also opt-out of receiving our newsletter if you decide you’d no longer like to receive these types of communications. Please see the “Opt-out” section.</p>

        <h5 class="mt-4 fw-bold border-start border-4 border-primary ps-2">Service Announcements</h5>
        <p>Although it is rare that we’d need to do so, it may sometimes be necessary for us to send out a strictly service-related announcement regarding our website or products. For example, if we require maintenance on any level of our website or within our services, communication or access may be temporarily unavailable, and we may notify users via email. These types of communications are not promotional in any way, and we do not offer the option for our users to opt-out of receiving service-related communications. However, if you’d fully prefer not to see these types of communications in your inbox, you may also deactivate your account. </p>

        <h5 class="mt-4 fw-bold border-start border-4 border-primary ps-2">Customer Service</h5>
        <p>Our Customer Service department is available via phone or email for assistance with any account or service-related questions or concerns.</p>

        <h5 class="mt-4 fw-bold border-start border-4 border-primary ps-2">Legal Disclaimer</h5>
        <p>At HeyBlinds.ca, we make every effort to preserve the privacy of our users, but some situations may arise in which we need to disclose a user’s personal information. This is only in legitimate instances when we are required by law and our company believes that such disclosure is necessary in order to comply with a court order, a current judicial proceeding, or any legal process served regarding our website.</p>

        <h5 class="mt-4 fw-bold border-start border-4 border-primary ps-2">Aggregate Information (Non-Personally Identifiable)</h5>
        <p>Aggregated demographic information we’ve collected is occasionally shared with our partners and advertisers in order to accurately represent the number of users that visit and interact with our website, the average amount of website traffic and/or usage statistics, and other related information regarding HeyBlinds.ca. We and our partners and advertisers use this information strictly for evaluating the performance and viability of <a href="{{ route('welcome') }}" class="text-decoration-underline">www.HeyBlinds.ca</a>, and none of this data is linked to any of our users’ personally identifiable information.</p>

        <h5 class="mt-4 fw-bold border-start border-4 border-primary ps-2">Third-Party Advertisers</h5>
        <p>HeyBlinds.ca shares usage information regarding the users on our website only with reputable third parties (such as but not limited to Yahoo, AOL, and MSN) for the sole purpose of targeting our banner advertisements both on this website and others. </p>

        <h5 class="mt-4 fw-bold border-start border-4 border-primary ps-2">Business Transitions</h5>
        <p>Regarding any potential instance of a business transition, such as acquisition by another company, a merger, or selling any portion of its assets, the personal information of users will, in most cases, be included as part of the assets being transferred. Any users affected by these changes will be notified through both a notice on the <a href="{{ route('welcome') }}" class="text-decoration-underline">www.HeyBlinds.ca</a> website, as well as via email, thirty (30) days prior to any change of ownership or management of their personal information. If any of the changes resulting from a business transition affect the users' personally identifiable information, such as if it may be applied in a manner otherwise than what was stated at the time of initial collection, users will be provided options consistent with our “Notification of Changes” section.</p>

        <h5 class="mt-4 fw-bold border-start border-4 border-primary ps-2">Opt-out</h5>
        <p>For users no longer wishing to receive our newsletter and/or notices and promotional communications, they may opt-out of being on the mailing list for these communications by clicking "unsubscribe" at the bottom of our emails and following the opt-out directions.</p>
        <p>When information is collected by relevant outside parties, our users will be notified so they can make informed decisions as to whether or not they feel comfortable proceeding with any services that include third-party involvement.</p>

        <h5 class="mt-4 fw-bold border-start border-4 border-primary ps-2">Links</h5>
        <p>Our website contains links to outside sources, and HeyBlinds.ca is not personally responsible for any of the privacy policies held by these other websites. Please be aware when leaving our site that the privacy practices of other websites will possibly not be the same as ours. Therefore, we encourage you to read the privacy statements of any other site visited through links we’ve provided to be aware of their policies on collecting personally identifiable information. Our privacy statement here applies solely to the information collected by the HeyBlinds.ca website. </p>

        <h5 class="mt-4 fw-bold border-start border-4 border-primary ps-2">Surveys & Contests</h5>
        <p>Occasionally, our site may request information via surveys or contests. It is voluntary to participate in these surveys and contests, so users will have a choice regarding whether they want to disclose this information or not. Typically, the only information collected via these means will be contact information (i.e., a name and shipping address) and demographic information (i.e., postal code). This contact information will only be used/shared with the sponsors of the contest or survey for the sake of notifying the winners and providing award prizes. Survey information is used only for monitoring or improving the use of and the user satisfaction of our site. Any personally identifiable information of our users is not shared with third parties without users receiving prior notice of this action and being given a choice to opt-in or opt-out. Although we may choose to use intermediary means in order to conduct some of these surveys and contests, none of these other parties are permitted to use the personally identifiable information collected on our users for any additional purposes. </p>

        <h5 class="mt-4 fw-bold border-start border-4 border-primary ps-2">Security</h5>
        <p>HeyBlinds.ca takes every precaution necessary to best protect the information of our valued users. When information is submitted through our website, we provide protection both online and offline for this sensitive data.</p>
        <p>When users are prompted to enter any sensitive information (i.e., credit card number and/or banking and routing information) via our registration/order forms, the information processed is encrypted and protected using the best encryption software available in the industry: SSL. The lock icon on a user’s browser will indicate ‘locked’ when interacting with a secure page, such as our order form page, rather than the ‘unlocked’ icon depicted when one is simply browsing. </p>
        <p>SSL encryption is used for top-of-the-line protection of our users’ sensitive information online, but we also make it a priority to protect our users’ information offline as well. All user information, both sensitive and otherwise, is contained in our offices. Only employees needing user information for the sake of performing a specific job (e.g., a customer service representative or billing clerk) are approved to have access to any personally identifiable information. All of our employees are required to use screensavers with password protection when leaving their desks. Upon returning, they will have to re-enter their password to once again gain access to any of the applicable user information. Additionally, we ensure that ALL HeyBlinds.ca employees are kept up-to-date on ALL of our security and privacy practices. Whenever new policies are instated, as well as in regular 6-month intervals, all HeyBlinds.ca employees are alerted and/or reminded of the importance our company places on privacy and the measures they can take to ensure our users' information is secure. Lastly, our servers that contain the collected personally identifiable information are stored in a secure location.</p>
        <p>For any questions regarding the security of our website, simply send an email to help(at)HeyBlinds(dot)ca.</p>

        <h5 class="mt-4 fw-bold border-start border-4 border-primary ps-2">Supplementation of Information</h5>
        <p>For the HeyBlinds.ca website to properly comply with its obligation to users, it is essential that we supplement our received information with additional information from third party sources.</p>

        <h5 class="mt-4 fw-bold border-start border-4 border-primary ps-2 text-break">Correcting/Updating/Deleting/Deactivating Personal Information</h5>
        <p>In the event that there are changes to a user's personally identifiable information (e.g., postal code, email, phone, or shipping address), or if our service is no longer desired by a particular user, we allow users to update, correct, or delete/deactivate their personally identifiable information. The easiest methods of making these changes are contacting us by telephone or our mailing address, or by emailing our Customer Support at help(at)HeyBlinds(dot)ca.</p>

        <h5 class="mt-4 fw-bold border-start border-4 border-primary ps-2">Notification of Changes</h5>
        <p>In the event of changes to our privacy policy, we will post notification of these changes on our home page, on this privacy statement, and/or any other locations we deem appropriate so users remain fully aware of the specifics regarding what information we collect, how it is used, and the circumstances, if applicable, in which we may disclose it. Information will be used in accordance with the privacy policy in effect during the time period in which the information was collected. </p>
        <p>If a user’s personally identifiable information will be used in a manner different from what was stated at the time of collection, they will be notified via email of the occurrence and be provided a choice regarding whether or not their information is used in this different manner. For users who have opted out of communications with the HeyBlinds.ca website, or that have deleted/deactivated their accounts, they will not be contacted about these issues and their personal information will not be used in the new manner in question. Additionally, for any changes in our privacy practices that have no effect on the user information already collected and contained in our database, we will simply display a prominent notice on the HeyBlinds.ca website notifying users of the change. For users who have opted in to receiving communications from us, we may also send an email notice along with the prominently displayed website notifications to inform them of the changes in our privacy practices.</p>

        <h5 class="mt-4 fw-bold border-start border-4 border-primary ps-2">Held Over Sale Pricing When You Order Samples</h5>
        <p>When samples are ordered, the sale pricing in effect during that time will still be honoured once you’re ready to place your final order. This pricing is valid for up to three weeks after receiving the samples unless stated otherwise. Any other promotional discounts, such as ones received via email, cannot be combined with the sample order sale pricing.</p>

        <h5 class="mt-5 fw-bold border-start border-4 border-primary ps-2">Samples Policy</h5>
        <p>You will be guaranteed the present day’s sale pricing for three weeks only.</p>
        <p>We offer “next business day” delivery to nearly all metropolitan locations. For any sample orders placed after 12PM noon Eastern time, this may take up to two days. Shipment may take up to three business days if receiving addresses are in a rural area. <b>HeyBlinds.ca offers 12 or more free samples per customer with a possible additional charge of $3 for any extras surpassing that number. </b> For orders received within 30 days of the initial sample order having been placed, you can enter your sample order’s ID # in the “Special Instructions” section at checkout on our website, and we will apply a $20 credit if your samples originally had overnight shipping which you paid for.</p>

        <h5 class="mt-5 fw-bold text-decoration-underline">Contact Information</h5>
        <p>For suggestions or any questions regarding our privacy statement, please contact us at:</p>
        <p class="mt-3 mb-1"><b>Mailing Address:</b></p>
        <p>5572 Pie-IX Boulevard<br>
            Montreal, QC<br>
            H1X 2B8
        </p>
        <p>HeyBlinds.ca<br>
            Phone: 888-412-3439<br>
            Monday through Friday 9AM-11PM, Eastern Time
        </p>
        <p class="mt-2 mb-1"><a href="{{ url('/contact-us') }}" class="text-decoration-underline"><b>Click Here</b></a> to contact our Customer Service department. </p>

        <h5 class="mt-5 fw-bold border-start border-4 border-primary ps-2">Colour Disclaimer</h5>
        <p>The key to having your blinds perfectly complete your room’s look is choosing the right colour. Here at HeyBlinds.ca, we encourage each of our customers to order samples before making a final purchase decision to ensure they can see the actual colour they’ll be getting. Our samples are completely free and an essential part of helping you to find the perfect colour and texture match for your home or business.</p>
        <p>Please note that product colours may appear differently depending upon the screen settings of the device you are using to view our website, so we strongly encourage you to order some of our free samples to make sure you’re happy with the colours you’re interested in. If you’ve ordered some of our free samples before placing a final blinds order and are unhappy with the colour of your blinds purchase for any reason, we will gladly do everything possible to have your blinds or shades remade with your updated colour selection, free of charge. </p>
        <p>When ordering multiple blinds or shades sharing the same colour, we also recommend that you order all of the blinds at once to ensure consistency in the colour and grain of the blinds. It is possible for each lot manufactured to have slight variations, so ordering them all at once provides you with the greatest opportunity to ensure you have a fully matching product set.</p>

        <h5 class="mt-4 fw-bold border-start border-4 border-primary ps-2">Limited Lifetime Warranty</h5>

        <p>
            The manufacturer warranties that for the reasonable lifetime for which your blinds and shades were bought, 
            its products are free from manufacturing defects. 
        </p>

            <p>This Limited Lifetime Warranty is not transferable and only applies to the original purchaser. It doesn't apply 
            if your product was damaged due to alteration or misuse of any kind - improper installation included. Normal wear 
            & tear is also to be expected and not covered by this Warranty. 
            And there are those times where Mother Nature gets in the way, such as fires or acts of God which are also not 
            covered by this Warranty. </p>

            <p>It's natural for fading to occur from extensive exposure to sunlight and isn't covered under this Limited Warranty.</p>

                <p>The manufacturer is obligated to replace or repair your defective product, but they do not cover shipping 
            charges and labor costs.</p>

            <p>Motorized products and remotes come with a two-year warranty.</p>

                <p>If any part or provision of this Limited Warranty conflicts with any present or future law, 
            statute, ordinance, regulation, or ruling, the latter will prevail; provided that only those 
            sections necessary for compliance are included and all other parts remain intact.</p>

            <p>With the latest manufacturing and product safety guidelines, each of our products comes standard
             with warning tags and labels, and other safety guidelines and safety devices to keep you safe. We also provide 
             installation instructions for your convenience so that all you have left are worries about doing some yard work!</p>

             <p>The person who buys, uses and/or installs the products must follow the manufacturer's instructions 
            closely with no modifications and install any safety devices that are provided. </p>

            <p>THIS WARRANTY IS EXCLUSIVE AND IN LIEU OF ALL OTHER OBLIGATIONS, LIABILITIES AND WARRANTIES, 
            EXPRESS OR IMPLIED. IN NO EVENT SHALL THE MANUFACTURER, OR ITS DISTRIBUTORS AND RETAILERS, 
            BE LIABLE OR RESPONSIBLE FOR ANY INCIDENTAL OR CONSEQUENTIAL DAMAGES, OR OTHER DIRECT OR INDIRECT DAMAGE, 
            LOSS, COST, EXPENSE, OR FEE. IN NO EVENT SHALL THE MANUFACTURER’S LIABILITY EXCEED THE COST OF THE PRODUCT.

        </p>
        <p>For more information, please visit our <a href="{{ url('/warranty') }}" class="text-decoration-underline"><b>Warranty</b></a> page.</p>
    </div>
</section>

@endsection