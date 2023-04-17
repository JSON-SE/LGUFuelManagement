// window._ = require('lodash');
//require("jquery");
const bootstrap = require("bootstrap");
//require("@popperjs/core");
//require("slick-carousel");
//require("resize-sensor");
require("theia-sticky-sidebar");
//require("toastr");
/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */
global.$ = global.jQuery = require("jquery");

window.slick = require("slick-carousel");
window.axios = require("axios");
window.toastr = require("toastr");
window.bootstrap = bootstrap;

window.axios.defaults.headers.common["X-Requested-With"] = "XMLHttpRequest";

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */

// import Echo from 'laravel-echo';

// window.Pusher = require('pusher-js');

// window.Echo = new Echo({
//     broadcaster: 'pusher',
//     key: process.env.MIX_PUSHER_APP_KEY,
//     cluster: process.env.MIX_PUSHER_APP_CLUSTER,
//     forceTLS: true
// });
$(function() {
    $("form, input, select").attr("autocomplete", "nope");
    // --------header fixed
    $(window).scroll(function() {
        if ($(this).scrollTop() >= 36) {
            $("header").addClass("header-active");
        } else {
            $("header").removeClass("header-active");
        }
    });
    $(".top-header-dropdown-menu li button.top-menu-btn").click(function() {
        $(this)
            .parent("li")
            .siblings()
            .find(".top-menu-dropdown")
            .removeClass("active");
        $(this).next(".top-menu-dropdown").addClass("active");

        if ($($(".top-menu-dropdown").hasClass("active")).length === 0) {
            $("#menu-overlay").hide();
        } else {
            $("#menu-overlay").show();
        }
    });
    $("#menu-overlay").on("click", function() {
        $(".top-menu-dropdown").removeClass("active");
        $(this).hide();
    });

    // -------responsive btn
    $(".menu-icon").click(function() {
        $(".right-menu").toggleClass("active");
        $(this).toggleClass("active");
    });

    $("nav ul li.menu-dropdown > a").click(function() {
        $(".right-menu").addClass("active");
    });

    // --------Search btn

    $(".search-icon").click(function() {
        $(".search-add-class").toggleClass("active");
        $(this).toggleClass("active");
    });
    $(".search-icon").click(function() {
        $(".search-icon").addClass("animationOn");
    });

    // ----------  On hover function

    var pause = false;
    var item = $(".hover-items");

    var k = 0;

    setInterval(function() {
        if (pause) {
            var $this = item.eq(k);

            if (item.hasClass("active")) {
                item.removeClass("active");
            }
            block.removeClass("active").eq(k).addClass("active");
            $this.addClass("active");
            k++;
            if (k >= block.length) {
                k = 0;
            }
        }
    }, 1500);

    item.hover(
        function() {
            var block = $(this)
                .parents(".__category-list-items")
                .next()
                .find(".dropdown-items-description");
            $(this).siblings().removeClass("active");
            $(this).addClass("active");
            block.removeClass("active");
            block.eq($(this).index()).addClass("active");
            pause = false;
        },
        function() {
            pause = false;
        }
    );

    // // Add smooth scrolling to all links
    $('a[href^="#"]').on("click", function(e) {
        parent.location.hash = "";
        e.preventDefault();
        if (this.hash !== "") {
            var target = this.hash;
            var $target = $(target);
            $("html, body")
                .stop()
                .animate({
                        scrollTop: $target.offset().top - 100,
                    },
                    100,
                    "swing",
                    function() {
                        window.location.hash = target - 100;
                        window.location.hash = target;
                    }
                );
        }
    });

    $(".accordion-collapse").on("shown.bs.collapse", function(e) {
        var $panel = $(this).closest(".accordion-item");
        $("html,body").animate({
                scrollTop: $panel.offset().top - 150,
            },
            500
        );
    });

    $(".refine-tab button.nav-link").click(function() {
        $("html,body").animate({
                scrollTop: $(".refine-tab").offset().top - 150,
            },
            500
        );
    });

    $(".sample_color_scroll").click(function() {
        $("html,body").animate({
                scrollTop: $("#productData").offset().top - 120,
            },
            500
        );
    });

    //------fixd side bar

    $(".color-sidedar-fixd, .select-colour-items").theiaStickySidebar({
        containerSelector: "",
        additionalMarginTop: 130,
        additionalMarginBottom: 0,
        updateSidebarHeight: true,
        minWidth: 0,
        sidebarBehavior: "modern",
        defaultPosition: "relative",
        namespace: "TSS",
    });

    //------quantity
    $(".add").click(function() {
        var th = $(this).closest(".quantity").find(".count");
        th.val(+th.val() + 1);
    });
    $(".sub").click(function() {
        var th = $(this).closest(".quantity").find(".count");
        if (th.val() > 1) th.val(+th.val() - 1);
    });

    $(document).on("click", ".accordion-button", function() {
        var colorFixed = $(".theiaStickySidebar");

        $.each(colorFixed, function() {
            $(this).removeAttr("style");
            $(this).css("z-index", "0");
        });
    });

    $(document).on("click", "#cetagory-size-dropdown", function() {
        $(".cetagory-sort-dropdown-items").hide();
        $(".cetagory-size-dropdown-items").slideToggle();
    });

    $(document).on("click", "#cetagory-sort-dropdown", function() {
        $(".cetagory-size-dropdown-items").hide();
        $(".cetagory-sort-dropdown-items").slideToggle();
    });

    $(document).on("click", "#Checkout_free_postal_service", function() {
        $(".Checkout_express_postal_service_details").hide();
        $(".Checkout_free_postal_service_details").slideDown();
    });

    $(document).on("click", "#Checkout_express_postal_service", function() {
        $(".Checkout_free_postal_service_details").hide();
        $(".Checkout_express_postal_service_details").slideDown();
    });

    $(".colorchange").on("click", function() {
        $(".select-color-big-show").attr("src", $(this).attr("src"));
        $(".select-color-small-show").attr("src", $(this).attr("href"));
        $(".select-color-text b").html($(this).attr("value"));
        $(".sample-btn-display").fadeIn("slow");
        $(".select-color-text span").html("Colour Selected");

        var disclaimer = $(this).find(".disclaimer").val();

        if (disclaimer == 1) {
            $(".sample_order_description").removeClass("d-none");
        } else {
            $(".sample_order_description").addClass("d-none");
        }
    });

    if ($(".view_password_option")) {
        $(".toggle-password").on("click", function() {
            $(this).toggleClass("eye-active");
            let input = $(this).next(".view_password");
            input
                .attr(
                    "type",
                    input.attr("type") === "password" ? "text" : "password"
                )
                .focus();
        });
    }
});

// window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
// let token = document.head.querySelector('meta[name="csrf-token"]');
// if (token){
//     window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
// }else {
//     console.log('CSRF token not found')
// }
success_callback = function(url, formData = null, success, errors) {
    axios
        .post(url, formData)
        .then(function(response) {
            success(response);
        })
        .catch(function(error) {
            errors(error);
        });
};

function get_data(url, formData = null, success, errors) {
    axios
        .get(url, formData)
        .then(function(response) {
            success(response);
        })
        .catch(function(error) {
            errors(error);
        });
}

signin = function(e) {
    var email = $("#email").val();
    var password = $("#id_password").val();
    var data = {
        email: email,
        password: password,
    };
    axios.post("/user/form-cart-login", data).then(
        (response) => {
            if (response.data.status == true) {
                toastr.success(response.data.message);
                window.location.href = "/user/my-account";
            } else {
                toastr.error(response.data.message);
            }
        },
        function(error) {
            let errors = error.response.data.errors;
            $.each(errors, function(key, value) {
                toastr.error(value);
            });
        }
    );
};

// ------Header ProgressBar
function progressBarScroll() {
    let winScroll =
        document.body.scrollTop || document.documentElement.scrollTop,
        height =
        document.documentElement.scrollHeight -
        document.documentElement.clientHeight,
        scrolled = (winScroll / height) * 100;
    document.getElementById("scroll-bar").style.width = scrolled + "%";
}

window.onscroll = function() {
    progressBarScroll();
};

// -------Circle Button Progress Bar

var progressPath = document.querySelector(".progress-wrap path");
var pathLength = progressPath.getTotalLength();
progressPath.style.transition = progressPath.style.WebkitTransition = "none";
progressPath.style.strokeDasharray = pathLength + " " + pathLength;
progressPath.style.strokeDashoffset = pathLength;
progressPath.getBoundingClientRect();
progressPath.style.transition = progressPath.style.WebkitTransition =
    "stroke-dashoffset 10ms linear";
var updateProgress = function() {
    var scroll = $(window).scrollTop();
    var height = $(document).height() - $(window).height();
    var progress = pathLength - (scroll * pathLength) / height;
    progressPath.style.strokeDashoffset = progress;
};
updateProgress();
$(window).scroll(updateProgress);
var offset = 50;
var duration = 900;
jQuery(window).on("scroll", function() {
    if (jQuery(this).scrollTop() > offset) {
        jQuery(".progress-wrap").addClass("active-progress");
    } else {
        jQuery(".progress-wrap").removeClass("active-progress");
    }
});

jQuery(".progress-wrap").on("click", function(event) {
    event.preventDefault();
    jQuery("html, body").animate({
            scrollTop: 0,
        },
        duration
    );
    return false;
});

$(document).on("click", "#finalizeSampleCart", function() {
    let sampleCartId = readCookie("__sb_sample_cart");
    if (sampleCartId) {
        document.location.href =
            document.location.origin + "/sample/checkout/" + sampleCartId;
    }
});

function phoneFormat(input) {
    input = input.replace(/\D/g, "");
    input = input.substring(0, 10);
    var size = input.length;
    if (size == 0) {
        input = input;
    } else if (size < 4) {
        input = "(" + input;
    } else if (size < 7) {
        input = "(" + input.substring(0, 3) + ") " + input.substring(3, 6);
    } else {
        input =
            "(" +
            input.substring(0, 3) +
            ") " +
            input.substring(3, 6) +
            " - " +
            input.substring(6, 10);
    }
    return input;
}

$(document).on("keyup", ".phone_number", function(e) {
    e.preventDefault();
    let phone = this.value;
    $(this).val(phoneFormat(phone));
});

$(document).on("keyup", ".postal_code", function(e) {
    e.preventDefault();
    let number = this.value;
    $(this).val(postalFormat(number));
});
//for capitalize text
$(document).on("keyup change", ".capitalize", function(e) {
    var string = $(this).val();
    if (string) {
        $(this).val(
            string.charAt(0).toUpperCase() + string.slice(1).toLowerCase()
        );
    }
});

function postalFormat(input) {
    if (input.length > 3) {
        return input.toUpperCase().replace(/\W/g, "").replace(/(...)/, "$1 ");
    } else {
        return input;
    }
}

// -------Time count

createCookie = function(name, value, days) {
    var expires;

    if (days) {
        var date = new Date();
        date.setTime(date.getTime() + days * 24 * 60 * 60 * 1000);
        expires = "; expires=" + date.toGMTString();
    } else {
        expires = "";
    }
    document.cookie =
        encodeURIComponent(name) +
        "=" +
        encodeURIComponent(value) +
        expires +
        "; path=/";
};

readCookie = function(name) {
    var nameEQ = encodeURIComponent(name) + "=";
    var ca = document.cookie.split(";");
    for (var i = 0; i < ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) === " ") c = c.substring(1, c.length);
        if (c.indexOf(nameEQ) === 0)
            return decodeURIComponent(c.substring(nameEQ.length, c.length));
    }
    return null;
};

eraseCookie = function(name) {
    createCookie(name, "", -1);
};

removeCartButton = function() {
    const displayCart = $("#sample-page-cart-right");
    let allProduct = displayCart.find(".samples-cart-list-box");
    if (allProduct.length < 1) {
        displayCart.append(
            '<p id="emptySampleText">Add your first sample.</p>'
        );
        $("#finalizeSampleCheckoutButton").hide();
        window.location.reload(true);
    }
};

removeCart = function(data, $this, type = "") {
    axios
        .post("/product/" + data.pid + "/sample-remove-from-cart", data)
        .then(function(response) {
            let data = response.data;
            var a = 0;
            let existing = parseInt($("#sampleCartCountBadge").text());
            console.log(existing);
            $this.removeAttr('disabled');
            if (existing != 0) {
                $("#sampleCartCountBadge, #totalFreeSampleCarts").text(
                    existing - 1
                );
                $("#sampleCartItems").text(existing - 1);
            }
            if (type === "cart") {
                $this.parents(".samples-cart-list").remove();

                // const a = $('.samples-cart-list').length;
                if (existing == 1) {
                    $("#sample-page-cart-right").remove();
                    $(".samples-cart-list-box").append(
                        "<div> <h4>No Sample Found</h4> </div> </div>"
                    );
                    $("#finalizeSampleCart").attr("disabled", "disabled");
                }
            } else if (type === "samples") {
                let totalProductCount = $(
                    ".samples-cart-list-box[data-pid='" + data.pid + "']"
                ).find(".samples-cart-list[data-pid='" + data.pid + "']");
                if (totalProductCount.length - 1 > 0) {
                    $this.parents(".samples-cart-list").remove();
                } else {
                    $this
                        .parents(
                            ".samples-cart-list-box[data-pid='" +
                            data.pid +
                            "']"
                        )
                        .remove();
                }
                $(
                        ".cart-sample-select-button[data-pid='" +
                        data.pid +
                        "'][data-id='" +
                        data.optid +
                        "']"
                    )
                    .removeClass("selected")
                    .prop("checked", false)
                    .removeAttr("checked");
                removeCartButton();
            } else {
                $this
                    .removeClass("btn-outline-primary btn-primary")
                    .addClass("btn-outline-primary")


                .removeAttr("selected")
                    .text("Order Free Sample");
            }
        })
        .catch(function(error) {
            $this.prop("checked", false);
            console.log(error);
        });
};
logoutFunction = function() {
    axios.post("/user/logout").then((response) => {
        if (response.data.status == true) {
            eraseCookie("__cart_items");
            window.location.href = "/";
        }
    });
};