function slugify(string) {
    const a = 'àáâäæãåāăąçćčđďèéêëēėęěğǵḧîïíīįìłḿñńǹňôöòóœøōõőṕŕřßśšşșťțûüùúūǘůűųẃẍÿýžźż·/_,:;'
    const b = 'aaaaaaaaaacccddeeeeeeeegghiiiiiilmnnnnoooooooooprrsssssttuuuuuuuuuwxyyzzz------'
    const p = new RegExp(a.split('').join('|'), 'g')

    return string.toString().toLowerCase()
        .replace(/\s+/g, '-') // Replace spaces with -
        .replace(p, c => b.charAt(a.indexOf(c))) // Replace special characters
        .replace(/&/g, '-and-') // Replace & with 'and'
        .replace(/[^\w\-]+/g, '') // Remove all non-word characters
        .replace(/\-\-+/g, '-') // Replace multiple - with single -
        .replace(/^-+/, '') // Trim - from start of text
        .replace(/-+$/, '') // Trim - from end of text
}


function maxLength(el) {
    if (!('maxLength' in el)) {
        var max = el.attr('maxLength');
        el.onkeypress = function () {
            if (this.value.length >= max) return false;
        };
    }
}

function registerSummernote(element, placeholder, max, callbackMax) {
    $(element).summernote({
        toolbar: [
            ['style', ['bold', 'italic', 'underline', 'clear']]
        ],
        placeholder,
        callbacks: {
            onKeydown: function(e) {
                var t = e.currentTarget.innerText;
                if (t.length >= max) {
                    //delete key
                    if (e.keyCode != 8)
                        e.preventDefault();
                    // add other keys ...
                }
            },
            onKeyup: function(e) {
                var t = e.currentTarget.innerText;
                if (typeof callbackMax == 'function') {
                    callbackMax(max - t.length);
                }
            },
            onPaste: function(e) {
                var t = e.currentTarget.innerText;
                var bufferText = ((e.originalEvent || e).clipboardData || window.clipboardData).getData('Text');
                e.preventDefault();
                var all = t + bufferText;
                document.execCommand('insertText', false, all.trim().substring(0, 400));
                if (typeof callbackMax == 'function') {
                    callbackMax(max - t.length);
                }
            }
        }
    });
}

jQuery.validator.setDefaults({
    debug: true,
    success: "valid"
});
$.validator.addMethod('filesize', function (value, element, param) {
    return this.optional(element) || (element.files[0].size <= param)
}, 'File size must be less than {0}');

$( "#productMeasureForm" ).validate({
    rules: {
        installation_file: {
            required: true,
            extension: "pdf|png|jpg|jpeg|mp4|mov|avi|wmv",
            filesize: 20000,
        },measure_file: {
            required: true,
            extension: "pdf|png|jpg|jpeg|mp4|mov|avi|wmv",
            filesize: 20000,
        },motorization_file: {
            required: true,
            extension: "pdf|png|jpg|jpeg|mp4|mov|avi|wmv",
            filesize: 20000,
        },
    }
});
$(document).on('keyup', ".phone_number", function (e) {
        e.preventDefault();
        let phone = this.value;
        $(this).val(phoneFormat(phone));
})
function phoneFormat(input) {
    input = input.replace(/\D/g, '');
    input = input.substring(0, 10);
    var size = input.length;
    if (size == 0) {
        input = input;
    } else if (size < 4) {
        input = '(' + input;
    } else if (size < 7) {
        input = '(' + input.substring(0, 3) + ') ' + input.substring(3, 6);
    } else {
        input = '(' + input.substring(0, 3) + ') ' + input.substring(3, 6) + ' - ' + input.substring(6, 10);
    }
    return input;
}
$(document).on('keyup', ".postal_code", function (e) {
        e.preventDefault();
        let number = this.value;
        $(this).val(postalFormat(number));
})
 function postalFormat(input) {
    if(input.length > 3){
        return input.toUpperCase().replace(/\W/g, '').replace(/(...)/, '$1 ');
    }
    else{
        return input;
    }
}

