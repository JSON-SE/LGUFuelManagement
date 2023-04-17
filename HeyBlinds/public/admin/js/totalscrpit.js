jQuery(document).ready(function ($) {
    $(".show-toster").on("click", function () {
        toastr.warning(
            "My name is Inigo Montoya. You killed my father, prepare to die!"
        );
    });

    $(function () {
        $("#sortable, .sortable").sortable({
            revert: true,
        });

        $("ul#sortable, #sortable li").disableSelection();
    });

    $(".summernote").summernote({
        dialogsInBody: true,
        minHeight: 150,
        spellCheck: true,
        fontSizeUnits: ["px", "pt"],
        toolbar: [
            // [groupName, [list of button]]
            ["style", ["style"]],
            ["font", ["bold", "italic", "underline", "clear"]],
            ["font", ["fontsize", "color"]],
            // ['font', ['fontname']],
            ["para", ["ul", "ol", "paragraph"]],
            ["table", ["table"]],
            // ['insert', ['link','image', 'doc', 'video']], // image and doc are customized buttons
            ["insert", ["link", "image", "doc"]],
            // ["view", ["fullscreen", "codeview", "help"]],
            ["view", ["fullscreen", "help"]],
        ],
        popover: {
            image: [
                [
                    "image",
                    ["resizeFull", "resizeHalf", "resizeQuarter", "resizeNone"],
                ],
                ["float", ["floatLeft", "floatRight", "floatNone"]],
                ["remove", ["removeMedia"]],
            ],
            link: [["link", ["linkDialogShow", "unlink"]]],
            table: [
                [
                    "add",
                    ["addRowDown", "addRowUp", "addColLeft", "addColRight"],
                ],
                ["delete", ["deleteRow", "deleteCol", "deleteTable"]],
            ],
            air: [
                ["color", ["color"]],
                ["font", ["bold", "underline", "clear"]],
                ["para", ["ul", "paragraph"]],
                ["table", ["table"]],
                ["insert", ["link", "picture"]],
            ],
        },
    });

    $("#video-url").click(function () {
        $(".video-url-input").slideToggle("slow");
    });

    $("#upload-video").click(function () {
        $(".upload-video-setion").slideToggle("slow");
    });

    // $(".enter-video-url").keydown(function (e) {
    //     if (e.keyCode == 13 || e.keyCode == 32) {
    //         var getValue = $(this).val();
    //         $('.all-video-url').append('<span class="video-urls text-truncate">' + getValue + ' <span class="cancel-url btn-close btn-close-white"></span></span>');
    //         $(this).val('');
    //     }
    // });

    $(document).on("click", ".cancel-url", function () {
        $(this).parent().remove();
    });

    $(document).on("click", ".add-option-price", function () {
        var clone = $(".option-price").clone();
        clone.find("input").val(null);

        clone.appendTo(".option_price_dynamic");
        $(".option_price_dynamic .option-price").addClass("single remove ");
        $(".single .option-price-action").append(
            '<button class="btn remove-option-price btn-secondary btn-sm pe-3 d-flex align-items-center ms-auto">' +
                '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">' +
                '<path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>' +
                '<path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>' +
                "</svg>" +
                '<span class="d-none d-md-block">Remove</span>' +
                "</button>"
        );
        $(".option_price_dynamic> .single").attr("class", "remove row gx-2");
    });

    $(document).on("click", ".remove-option-price", function (e) {
        $(this).parents(".remove").remove();
        e.preventDefault();
    });

    // $(document).on('click', '.add-rules', function () {
    //     var clone = $('.rules-row').clone()
    //     clone.find("input").val(null);
    //
    //     clone.appendTo('.option_rules_dynamic');
    //     $('.option_rules_dynamic .rules-row').addClass('single-rules remove ');
    //     $('.single-rules .option-rules-action').append('<button class="btn remove-rules-price btn-secondary btn-sm pe-3 d-flex align-items-center ms-auto">' +
    //         '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">' +
    //         '<path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>' +
    //         '<path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>' +
    //         '</svg>' +
    //         '<span class="d-none d-md-block">Remove</span>' +
    //         '</button>');
    //     $('.option_rules_dynamic> .single-rules').attr("class", "remove");
    // });

    // $(document).on('click', '.remove-rules-price', function (e) {
    //     $(this).parents('.remove').remove();
    //     e.preventDefault();
    // });

    $(".add-colour-name").select2({
        tags: true,
        tokenSeparators: [",", " "],
    });

    // $('.select2-selection__rendered').appendTo('.color_records_dynamic');

    $(document).on("click", ".add-price-row", function () {
        var clone = $(".price-row:last-child").clone();
        clone.find("input").val("0");
        clone.appendTo(".pricetable tbody");
    });

    $(".add-price-col").click(function () {
        $(".pricetable tbody tr").append(
            '<td><span class="inner"><input class="table-input" type="number" value="00" readonly/></span></td>'
        );
        $(".pricetable thead tr").append(
            '<th class="text-center"><div class="d-flex align-items-center justify-content-center"><span class="inner"><input class="table-input" type="number" value="00" readonly/> </span></div></th>'
        );
    });

    $(document).on("click", ".remove-price-row", function (e) {
        if ($(this).closest(".price-row").is(".price-row:only-child")) {
            alert("cannot delete last row");
            $(this).closest(".price-row").find("span").text("0");
        } else {
            $(this).closest(".price-row").remove();
        }
        // $(this).parents('.price-row').remove();
        e.preventDefault();
    });

    $(document).on("click", ".remove-shipping-row", function (e) {
        if ($(this).closest(".shipping-row").is(".shipping-row:only-child")) {
            alert("cannot delete last row");
            // $(this).closest('.shipping-row').find("input").removeAttr('value');
        } else {
            $(this).closest(".shipping-row").remove();
        }
        // $(this).parents('.price-row').remove();
        e.preventDefault();
    });

    $(document).on("click", ".add-shipping-row", function (e) {
        e.preventDefault();
        var clone = $(".shipping-row:last-child").clone();
        clone.find("input").val("");

        clone.appendTo(".shippingtable tbody");
    });

    $(document).on("click", ".remove-price-col", function () {
        var index = $(this).closest("th").index();
        $(this)
            .closest("table.pricetable")
            .find("tr")
            .each(function () {
                this.removeChild(this.cells[index]);
            });
    });

    $(".advanced-settings").click(function () {
        $(".advanced-settings-setion").slideToggle("slow");
    });

    // input fild edit function

    // ----end

    // product upload submit btn
    // $(document).on('click', '.info-submit', function () {
    //     var productName = $('.clone-product-name').val();
    //     $('.product-management-tab .nav-link').prop("disabled", false);
    //     $('.add-product-name').html(productName);
    //     $(window).scrollTop(0);
    //
    //     $('.product-management-tab > .nav-item > .active').parent().next('li').find('button').trigger('click');
    // });

    // ----end

    //   quantity js
    $(".add").click(function () {
        var th = $(this).closest(".quantity").find(".count");
        th.val(+th.val() + 1);
    });
    $(".sub").click(function () {
        var th = $(this).closest(".quantity").find(".count");
        if (th.val() > 1) th.val(+th.val() - 1);
    });

    // ----end

    //   input file upload js
    $(document).ready(function () {
        $("input:file").on("change", function () {
            var target = $(this);
            var relatedTarget = target.siblings(".file-name");
            var fileName = target[0].files[0].name;
            relatedTarget.val(fileName);
        });
    });
    // ----end
});

// bootstrap data table
// $(document).ready(function () {
//     $('#example').DataTable();
// });
// ----end

var fileTypes = ["csv"];

function readURL(input) {
    if (input.files && input.files[0]) {
        var extension = input.files[0].name.split(".").pop().toLowerCase(),
            isSuccess = fileTypes.indexOf(extension) > -1;

        if (isSuccess) {
            var reader = new FileReader();
            reader.onload = function (e) {
                if (extension == "csv") {
                    $(input)
                        .closest(".fileUpload")
                        .find(".icon")
                        .attr("src", "assets/images/csv-file-format.svg");
                } else {
                    $(input)
                        .closest(".uploadDoc")
                        .find(".docErr")
                        .slideUp("slow");
                }
            };

            reader.readAsDataURL(input.files[0]);
        } else {
            $(input).closest(".uploadDoc").find(".docErr").fadeIn();
            setTimeout(function () {
                $(".docErr").fadeOut("slow");
            }, 9000);
        }
    }
}
$(document).ready(function () {
    $(document).on("change", ".up", function () {
        var id = $(this).attr("id");
        var profilePicValue = $(this).val();
        var fileNameStart = profilePicValue.lastIndexOf("\\");
        profilePicValue = profilePicValue
            .substr(fileNameStart + 1)
            .substring(0, 20);
        if (profilePicValue != "") {
            $(this).closest(".fileUpload").find(".upl").html(profilePicValue);
        }
    });
});

function valueChanged() {
    if ($("#optioncheck1").is(":checked")) {
        $("#option-price-check").empty();
        $(".option-price-heading-text").empty();
    } else {
        $("#option-price-check").append(
            '<div class="row gx-2 option-price pb-3"><div class="col-md-3"><div class="form-floating"><input type="text" class="form-control" placeholder="Widtn"><label for="">Min Width</label></div></div><div class="col-md-3"><div class="form-floating"><input type="text" class="form-control" placeholder="Widtn"><label for="">Max Width</label></div></div><div class="col-md-2"><div class="form-floating"><select class="form-select" aria-label="Floating label select example"><option value="1">Percentage</option><option value="2">Ftal</option></select><label for="">Price Type</label></div></div><div class="col-md-2"><div class="form-floating"><input type="number" class="form-control" id="" placeholder="Widtn"><label for="">Price</label></div></div><div class="col-md-2 d-flex option-price-action"><button class="btn btn-primary btn-sm pe-3 d-flex align-items-center add-option-price ms-auto"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus" viewBox="0 0 16 16"><path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"></path></svg><span class="d-none d-md-block">Add</span></button></div></div><div class="option_price_dynamic"></div>'
        );
        $(".option-price-heading-text").append("<h6>Add Price</h6>");
    }
}
