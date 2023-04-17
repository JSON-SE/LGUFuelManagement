jQuery(document).ready(function ($) {

    $('.show-toster').on("click", function () {
        toastr.warning('My name is Inigo Montoya. You killed my father, prepare to die!')
    });

    $(function () {
        $("#sortable").sortable({
            revert: true
        });

        $("ul#sortable, #sortable li").disableSelection();
    });


    $('.summernote').summernote({
        dialogsInBody: true,
        minHeight: 150,
        toolbar: [
            ['style', ['bold', 'italic', 'underline', 'clear']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['font', ['strikethrough']],

        ]
    });



    $("#video-url").click(function () {
        $(".video-url-input").slideToggle("slow");
    });

    $("#upload-video").click(function () {
        $(".upload-video-setion").slideToggle("slow");
    });


    $(".enter-video-url").keydown(function (e) {
        if (e.keyCode == 13 || e.keyCode == 32) {
            var getValue = $(this).val();
            $('.all-video-url').append('<span class="video-urls text-truncate">' + getValue + ' <span class="cancel-url btn-close btn-close-white"></span></span>');
            $(this).val('');
        }
    });

    $(document).on('click', '.cancel-url', function () {
        $(this).parent().remove();
    });



    // $('.add-more-color').click(function () {
    //     $('.color-records').clone().appendTo('.color_records_dynamic');
    //     $('.color_records_dynamic .color-records').addClass('single remove');
    //     $('.single').append('<a href="#" class="remove-field btn btn-sm btn-secondary mt-2">Remove Fields</a>');
    //     $('.color_records_dynamic > .single').attr("class", "remove");
    // });

    // $(document).on('click', '.remove-field', function (e) {
    //     $(this).parent('.remove').remove();
    //     e.preventDefault();
    // });


    $(".add-colour-name").select2({
        tags: true,
        tokenSeparators: [',', ' ']
    });

    // $('.select2-selection__rendered').appendTo('.color_records_dynamic');



    $(document).on("click", ".add-price-row", function(){
        var clone = $('.price-row:last-child').clone();
        clone.find("input").val("0");
        clone.appendTo('.pricetable tbody');
    });



    $('.add-price-col').click(function () {
        $('.pricetable tbody tr').append('<td><span class="inner"><input class="table-input" type="number" value="00" readonly/></span></td>');
        $('.pricetable thead tr').append('<th class="text-center"><div class="d-flex align-items-center justify-content-center"><span class="inner"><input class="table-input" type="number" value="00" readonly/> </span></div></th>');
    });


    $(document).on('click', '.remove-price-row', function (e) {
        if( $(this).closest('.price-row').is('.price-row:only-child') ) {
            alert('cannot delete last row');
            $(this).closest('.price-row').find("span").text("0");
        }
        else {
            $(this).closest('.price-row').remove();
        }
        // $(this).parents('.price-row').remove();
        e.preventDefault();
    });



    $(document).on('click', '.remove-shipping-row', function (e) {
        if( $(this).closest('.shipping-row').is('.shipping-row:only-child') ) {
            alert('cannot delete last row');
            $(this).closest('.shipping-row').find("input").removeAttr('value');
        }
        else {
            $(this).closest('.shipping-row').remove();
        }
        // $(this).parents('.price-row').remove();
        e.preventDefault();
    });

    $(document).on('click', '.add-shipping-row', function (){
        var clone = $('.shipping-row:last-child').clone();
        clone.find("input").removeAttr('value');
        clone.appendTo('.shippingtable tbody');
    });



    $(document).on('click', '.remove-colour-row', function (e) {
        $(this).parents('.colour-row').remove();
        e.preventDefault();
    });




    $(document).on('click', '.remove-price-col', function(){
        var index = $(this).closest('th').index();
        $(this).closest('table.pricetable').find('tr').each(function() {
            this.removeChild(this.cells[ index ]);
        });
    });



    $(".advanced-settings").click(function () {
        $(".advanced-settings-setion").slideToggle("slow");
    });


    $(document).on("dblclick", ".table-input", function(e){
        e.stopPropagation();

        var isChange = false;
        var $this = $(this);
        var oldval = $this.val();

        $(".table-input").removeAttr('style');

        $this.removeAttr('readonly').focus().addClass('border_color').change(function(abc) {
                    var newcont = $this.val();
                    if( isChange == false ){

                    if (newcont == null || newcont == "" || newcont == "0" || newcont <= 0) {
                        alert("This field can not be blank or zero or less than zero");
                        $this.val(oldval);
                        // return false;

                    } else if ( oldval != newcont ) {
                        var authorise = confirm( "Are you sure about making this change!" );
                        if ( authorise == true ) {
                            $this.val(newcont);


                        } else if ( authorise == false ) {
                            $this.val(oldval);


                        }
                        // return false;

                    }
                        $this.attr('readonly','readonly');
                        $this.removeAttr('style');
                    }

                    isChange = true;

                });



    });

    $(document).click(function (e) {
            if( ! $(e.target).is('.table-input')){
                  var inputclick =   $(".table-input");

                  $.each(inputclick, function(){
                      var $this = $(this);
                      if($this.hasClass('border_color')){
                          $this.removeClass('border_color');
                          $this.attr('readonly','readonly');
                      }
                  });
                }
        });

        $(document).on('click', '.info-submit', function(){
            var productName = $('.clone-product-name').val();
            $('.product-management-tab .nav-link').prop("disabled", false);
            $('.add-product-name').html(productName);
            $(window).scrollTop(0);

            $('.product-management-tab > .nav-item > .active').parent().next('li').find('button').trigger('click');
        });




    //   quantity js
    $('.add').click(function () {
        var th = $(this).closest('.quantity').find('.count');
        th.val(+th.val() + 1);
    });
    $('.sub').click(function () {
        var th = $(this).closest('.quantity').find('.count');
        if (th.val() > 1) th.val(+th.val() - 1);
    });


        $('.status-pending-fild').click(function(event){
            $('.status-btn').addClass('status-pending-btn');
            $('.status-btn').removeClass('status-cancelled-btn');
            $('.status-btn').removeClass('status-confirmed-btn');
            $('.status-btn').text("Pending");
            event.preventDefault();
        });

});


$(document).ready(function () {
    $('#example').DataTable();
});

var fileTypes = ['csv'];
function readURL(input) {
    if (input.files && input.files[0]) {
        var extension = input.files[0].name.split('.').pop().toLowerCase(),
            isSuccess = fileTypes.indexOf(extension) > -1;

        if (isSuccess) {
            var reader = new FileReader();
            reader.onload = function (e) {
                if (extension == 'csv'){
                	$(input).closest('.fileUpload').find(".icon").attr('src','assets/images/csv-file-format.svg');
                }else {
                	$(input).closest('.uploadDoc').find(".docErr").slideUp('slow');
                }
            }

            reader.readAsDataURL(input.files[0]);
        }
        else {
            $(input).closest('.uploadDoc').find(".docErr").fadeIn();
            setTimeout(function() {
				   	$('.docErr').fadeOut('slow');
					}, 9000);
        }
    }
}
$(document).ready(function(){

   $(document).on('change','.up', function(){
   	var id = $(this).attr('id');
	   var profilePicValue = $(this).val();
	   var fileNameStart = profilePicValue.lastIndexOf('\\');
	   profilePicValue = profilePicValue.substr(fileNameStart + 1).substring(0,20);
	   if (profilePicValue != '') {
	      $(this).closest('.fileUpload').find('.upl').html(profilePicValue);
	   }
   });




});
