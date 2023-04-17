$(function() {
    $('#subcribeModal').modal("hide");
    axios.post('/subcriber/email/check').then((response) => {
        if (response.data.status == true) {
            setTimeout(function() {
                $('#subcribeModal').modal("show");
                //$('#Klaviyo_form').modal("show");
            }, 7000)
        }
    });

    $(document).on('keyup change', '#subcriberemail', function(e) {
        $('.error').css('display', 'none');
    });
    $(document).on('submit', '#subcriber', function(e) {
        e.preventDefault();
        let $this = $(this);
        let formData = $this.serialize();
        axios.post('/subcriber/email', formData)
            .then((response) => {
                if (response.data.status == true && response.data.data != '') {
                    //toastr.success(response.data.message);
                    //$('#subcribeModal').modal("hide");
                    //$('#offerModal').modal("show");
                    $('.error').css('display', 'none');
                } else {
                    //$('#subcribeModal').modal("hide");
                    // $('#offerModal').modal("hide");
                    $('.error').css('display', 'inline-block');

                    //toastr.error(response.data.message);
                }
            })
            .catch(function(error) {
                toastr.error(error);
            });
    });
    $('#copyPromo').on('click', function(event) {
        copyToClipboard(event);
    });

    function copyToClipboard(e) {
        var
            t = e.target,
            c = t.dataset.copytarget,
            inp = (c ? document.querySelector(c) : null);
        console.log(inp);
        if (inp && inp.select) {
            inp.select();
            try {
                document.execCommand('copy');
                inp.blur();
                t.classList.add('copied');
                setTimeout(function() {
                    t.classList.remove('copied');
                }, 1500);
            } catch (err) {
                alert('please press Ctrl/Cmd+C to copy');
            }
        }
    }


    // --------testmonial slider

    $('.testmonial-slider').slick({
        slidesToShow: 3,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 2000,
        responsive: [{
                breakpoint: 1025,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 1,
                    infinite: true,
                    dots: true
                }
            },
            {
                breakpoint: 767,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    arrows: false,
                }
            }

        ]
    });
    //  ---------banner slider
    $('.banner-slider').slick({
        dots: false,
        infinite: true,
        speed: 1000,
        fade: true,
        autoplay: true,
        autoplaySpeed: 3000,
    });

});