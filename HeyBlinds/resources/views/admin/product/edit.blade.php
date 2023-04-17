@extends('layouts.Backend.admin.admin')
@section('style')
    <link rel="stylesheet" href="{{ asset('admin/css/dropzone.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('admin/css/slick.css') }}"/>
@endsection
@section('content')
    <div class="container-fluid px-lg-5 px-md-4 pb-5 pt-lg-3">
        <div class="row pt-4">
            <div class="col-12">
                <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='white'/%3E%3C/svg%3E&#34;);"
                    aria-label="breadcrumb">
                    <ol class="breadcrumb mb-2">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Product Management</li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="row pb-4">
            <div class="col-sm-6 text-white my-auto">
                <h3 class="mb-0 add-product-name">Edit: {{$product->name}}</h3>
            </div>
            <div class="col-sm-6 pt-3 pt-lg-0 my-auto d-flex justify-content-sm-end">
                <!-- <button class="btn btn-light">New view</button> -->
                <a href="{{ route('frontend.product.details', $product->slug) }}" target="_blank"
                    class="btn btn-primary d-flex align-items-center">
                    <span class="">View product</span>
                </a>
                <a href="{{ route('admin.product.index') }}" class="btn btn-primary d-flex align-items-center ms-2">
                    <span class="">All product</span>
                </a>
            </div>
        </div>
        <div class="bg-white rounded page-height mt-3 shadow position-relative pb-5">
            <div class="p-lg-4 p-3 pb-5">
                <ul class="nav nav-tabs __tabslide product-management-tab" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="basic-tab" data-bs-toggle="tab" data-bs-target="#basic"
                            type="button" role="tab" aria-controls="basic" aria-selected="true">Basic
                            Information</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="color-tab" data-bs-toggle="tab" data-bs-target="#color" type="button"
                            role="tab" aria-controls="color" aria-selected="false">Product
                            Colour</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="option-tab" data-bs-toggle="tab" data-bs-target="#option" type="button"
                            role="tab" aria-controls="option" aria-selected="false">Product
                            Option</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="headrail-tab" data-bs-toggle="tab" data-bs-target="#headrail" type="button"
                            role="tab" aria-controls="headrail" aria-selected="false">Headrail</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="price-tab" data-bs-toggle="tab" data-bs-target="#price" type="button"
                            role="tab" aria-controls="price" aria-selected="false">Price</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="measure-tab" data-bs-toggle="tab" data-bs-target="#measure"
                            type="button" role="tab" aria-controls="measure" aria-selected="false">Measure & Install
                            Guide</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="shipping-tab" data-bs-toggle="tab" data-bs-target="#shipping"
                            type="button" role="tab" aria-controls="shipping" aria-selected="false">Shipping &
                            Production</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="warranty-tab" data-bs-toggle="tab" data-bs-target="#warranty"
                            type="button" role="tab" aria-controls="warranty" aria-selected="false">Warranty</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="review-tab" data-bs-toggle="tab" data-bs-target="#review" type="button"
                            role="tab" aria-controls="review" aria-selected="false">Customer Review</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="photos-tab" data-bs-toggle="tab" data-bs-target="#photos" type="button"
                            role="tab" aria-controls="photos" aria-selected="false">Customer Photos</button>
                    </li>
                      <li class="nav-item" role="presentation">
                        <button class="nav-link" id="tooltip-tab" data-bs-toggle="tab" data-bs-target="#tooltip" type="button"
                            role="tab" aria-controls="tooltip" aria-selected="false">Tooltip</button>
                    </li>
                   
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="seo-tab" data-bs-toggle="tab" data-bs-target="#seo" type="button"
                            role="tab" aria-controls="seo" aria-selected="false">SEO</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="filter-tab" data-bs-toggle="tab" data-bs-target="#filter" type="button"
                            role="tab" aria-controls="filter" aria-selected="false">Filter</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="filter-other" data-bs-toggle="tab" data-bs-target="#other" type="button"
                            role="tab" aria-controls="other" aria-selected="false">Other</button>
                    </li>

                </ul>

                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="basic" role="tabpanel" aria-labelledby="basic-tab">
                        @include('admin.product.partials.__basic')
                    </div>
                    <div class="tab-pane fade" id="color" role="tabpanel" aria-labelledby="color-tab">
                        @include('admin.product.partials.__colors')
                    </div>
                    <div class="tab-pane fade" id="option" role="tabpanel" aria-labelledby="option-tab">
                        @include('admin.product.partials.__options')
                    </div>
                    <div class="tab-pane fade" id="headrail" role="tabpanel" aria-labelledby="headrail-tab">
                        @include('admin.product.partials.__headrail')
                    </div>
                    <div class="tab-pane fade" id="price" role="tabpanel" aria-labelledby="price-tab">
                        @include('admin.product.partials.__price')
                    </div>
                    <div class="tab-pane fade" id="measure" role="tabpanel" aria-labelledby="measure-tab">
                        @include('admin.product.partials.__measure')
                    </div>
                    <div class="tab-pane fade" id="shipping" role="tabpanel" aria-labelledby="shipping-tab">
                        @include('admin.product.partials.__shipping')
                    </div>
                    <div class="tab-pane fade" id="warranty" role="tabpanel" aria-labelledby="warranty-tab">
                        <h1> Coming Soon..</h1>
                    </div>
                    <div class="tab-pane fade" id="review" role="tabpanel" aria-labelledby="review-tab">
                        @include('admin.product.partials.review')
                    </div>
                    <div class="tab-pane fade" id="photos" role="tabpanel" aria-labelledby="photos-tab">
                        <h1> Coming Soon..</h1>
                    </div>
                    <div class="tab-pane fade" id="tooltip" role="tabpanel" aria-labelledby="tooltip-tab">
                        <div class="pt-3">
                            <form action="#" enctype="multipart/form-data">
                                <input type="hidden" name="id" value="{{$productID}}">
                            @csrf
                                @include('admin.product.partials.tooltip')
                            </form>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="seo" role="tabpanel" aria-labelledby="seo-tab">
                        <div class="pt-3">
                            <form action="{{route('admin.main.product.seo.store')}}" enctype="multipart/form-data">
                                <input type="hidden" name="id" value="{{$productID}}">
                            @csrf
                                @include('admin.common.__seo')
                            </form>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="filter" role="tabpanel" aria-labelledby="filter-tab">
                        <div class="pt-3">
                            <form action="#"  method="post" id="filterForm" enctype="multipart/form-data">
                                <input type="hidden" name="product_id" value="{{$productID}}">
                            @csrf
                                @include('admin.product.partials._filter')
                            </form>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="other" role="tabpanel" aria-labelledby="filter-other">
                        <div class="pt-3">
                            @include('admin.product.partials.home-page-image')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="{{ asset('admin/js/dropzone.min.js') }}"></script>
    <script src="{{ asset('admin/js/slick.min.js') }}"></script>
    <script>
        Dropzone.autoDiscover = false;
        axios.defaults.withCredentials = true;
        jQuery(function($) {
           
            $('input[name="name"], input[name="slug"]').on('keyup', function() {
                let $this = $(this);
                let slug = slugify($this.val());
                $("#basic-url").val(slug);
            })
        
            $('#uploadPriceSheet').on("click", function(e) {
                e.preventDefault();
                var formData = new FormData();
                formData.append('file', $('#upExcelFile')[0].files[0])
                formData.append('id', {{ $productID }})
                axios.post("{{ route('admin.product.price.store') }}",
                        formData, {
                            headers: {
                                'Content-Type': 'multipart/form-data'
                            }
                        })
                    .then(function(response) {
                        let data = response.data
                        if (data.error) {
                            toastr.error(data.error)
                        } else {
                            document.location.reload();
                        }
                    })
                    .catch(function(error) {
                        let errors = error.response.data.errors;
                        $.each(errors, function(key, value) {
                            toastr.error(value)
                        })
                    });
                    
            })

            $("#floatingSelectGrid, #color_id").select2()

            $("#colorGroups").on("select2:select", function(e) {
                let data = e.params.data;
                axios.post('{{ route('admin.product.get.colors') }}', data)
                    .then(function(response) {
                        let data = response.data;
                        let html = '';
                        $.each(data, function(i, value) {
                            html +=
                                `<option value="${value.id}">${value.name} - ${value.color_id} </option>`;
                        })
                        $("#color_id").removeAttr('disabled').empty().append(html);
                    })
                    .catch(function(error) {
                     
                    });
            })

            $("#floatingSelectGrid").on("select2:select", function(e) {
                let data = e.params.data;
                axios.post('{{ route('admin.product.get.sub.category') }}', data)
                    .then(function(response) {
                        
                        let data = response.data;
                        let html = '';
                        $.each(data, function(i, value) {
                         
                            html +=
                                `<option value="">Select a subcategory</option><option value="${value.id}">${value.name}</option>`;
                        })
                        $("#subCategory").removeAttr('disabled').empty().append(html);
                    })
                    .catch(function(error) {
                    });
            })

            $(document).on("click", ".add-more-color", function(e) {
                e.preventDefault();
                $("#loader").show();
                let data = {
                    id: {{ $productID }},
                    group: $("#colorGroups").val(),
                    color: $("#color_id").val(),
                    amount_percentage: $("input[name='amount_percentage']").val(),
                }
                axios.post('{{ route('admin.product.store.colors') }}', data)
                    .then(function(response) {
                        $("#loader").hide();
                        let data = response.data;
                        let colorRow = $(".colour-row");
                        let html = '';
                        for (let i = 0; i < data.length; i++) {
                            if (data[i].msg === "success") {
                                html += `
                                        <tr class="colour-row ui-state-default align-middle" data-id="${data.id}">
                                            <th scope="row">${parseInt(colorRow.length) + 1}</th>
                                            <td>${data[i].vendor_name}</td>
                                            <td>${data[i].vendor_color_id}</td>
                                            <td>${data[i].name}</td>
                                            <td>${data[i].color_id}</td>
                                            <td><div class="table-colour-imge"><img src="${data[i].color_image_id}" alt=""/> </div></td>
                                            <td>${data[i].color_group_name}</td>
                                            <td><div class="table-colour-imge"><img src="${data[i].feature_image_id}" alt=""/> </div></td>
                                             <td class="text-center"><input type="number" class="border-0 bg-white edit-color-percentage" value="${data[i].amount_percentage}" data-id="${data[i].id}" disabled></td>
                                            <td>
                                                <button class="btn btn-sm remove-colour-row" data-id="${data[i].main_color_id}">
                                                    <div class="text-secondary">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                                            <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"></path>
                                                            <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"></path>
                                                        </svg>
                                                    </div>
                                                </button>
                                            </td>
                                        </tr>
                                    `
                                $("#color_id").val(null).trigger('change');
                                $("#colorGroups").val(null).trigger('change');
                                toastr.success("Added!")
                            } else {
                                toastr.error(data[i].msg)
                            }
                        }
                        $("#productColorTable tbody").append(html)

                    })
                    .catch(function(error) {
                        $("#loader").hide();
                        let errors = error.response.data.errors;
                        $.each(errors, function(key, value) {
                            toastr.error(value)
                        })
                    });
            })

            // $(document).on("dblclick", ".edit-color-percentage", function (e) {
            //     e.preventDefault();
            //     let $this = $(this);
            //     $this.removeAttr("disabled").after('<span><a href="javascript:void(0)" class="bnt"> Save </a></span>');
            //
            // })

            $(" #enter-video-url").select2({
                theme: "classic",
                tags: "true",
                placeholder: "Select an option",
                allowClear: true
            })
            $("#video_id").dropzone({
                url: "{{ route('upload.media') }}",
                chunking: true,
                method: "POST",
                maxFilesize: 100,
                chunkSize: 4000000,
                maxFiles: 5,
                thumbnailWidth: 100,
                parallelChunkUploads: true,
                dictDefaultMessage: 'Drop Video here (or click) to capture/upload',
                maxfilesexceeded: function(file) {
                    this.removeAllFiles();
                    this.addFile(file);
                },
                success: function(file, response) {
                    if (response != 0) {
                        var inputEl = document.createElement('INPUT');
                        inputEl.setAttribute('type', 'hidden');
                        inputEl.setAttribute('name', 'video_id[]');
                        inputEl.setAttribute('value', response.id);
                        file.previewTemplate.appendChild(inputEl);
                    }
                }
            });
            $("#display_image").dropzone({
                url: "{{ route('upload.media') }}",
                acceptedFiles: ".jpeg,.jpg,.png,.gif,.webp",
                maxFiles: 1,
                dictDefaultMessage: 'Drop image here (or click) to capture/upload',
                maxFilesize: 2,
                dictInvalidFileType: "Only image files like jpeg, jpg, png,webp etc are allowed.",
                dictFileTooBig : "File is too big. Max file size: 2MB.",
                maxfilesexceeded: function(file) {
                    this.removeAllFiles();
                    this.addFile(file);
                },
                success: function(file, response) {
                    if (response != 0) {
                        $(document).find('input[name="display_media_id"]').val(response.id)
                    }
                }
            });
            $("#slider_image").dropzone({
                url: "{{ route('upload.media') }}",
                acceptedFiles: ".jpeg,.jpg,.png,.gif,.webp",
                maxFiles: 10,
                maxFilesize: 3,
                addRemoveLinks: true,
                dictDefaultMessage: 'Drop image here (or click) to capture/upload',
                dictInvalidFileType: "Only image files like jpeg, jpg, png,webp etc are allowed.",
                dictFileTooBig : "File is too big. Max file size: 2MB.",
                maxfilesexceeded: function(file) {
                    this.removeAllFiles();
                    this.addFile(file);
                },
                success: function(file, response) {
                    if (response != 0) {
                        var inputEl = document.createElement('INPUT');
                        inputEl.setAttribute('type', 'hidden');
                        inputEl.setAttribute('name', 'slider_id[]');
                        inputEl.setAttribute('value', response.id);
                        file.previewTemplate.appendChild(inputEl);
                    }
                }
            })

            $("#seo_og_image").dropzone({
                url: "{{ route('upload.media') }}",
                acceptedFiles: ".jpeg,.jpg,.png,.gif,.webp",
                maxFiles: 1,
                dictDefaultMessage: 'Drop image here (or click) to capture/upload',
                maxFilesize: 2,
                maxfilesexceeded: function(file) {
                    this.removeAllFiles();
                    this.addFile(file);
                },
                success: function(file, response) {
                   
                    if (response != 0) {
                        var inputEl = document.createElement('INPUT');
                        inputEl.setAttribute('type', 'hidden');
                        inputEl.setAttribute('name', 'seo_og_media_id');
                        inputEl.setAttribute('value', response.id);
                        file.previewTemplate.appendChild(inputEl);
                    }
                }
            });
            $(".productBasicForm").on("click", function(e) {
                e.preventDefault();
                let $this = $(this);
                let form = $this.parents('form');
                let url = form.attr('action');

                if (form.attr('data-from') === "option"){
                    let checkMin = $("input[name='option_min_width[]']")
                    let check = true;
                    jQuery.each(checkMin, function (){
                        let $this = $(this);
                        if (($this.val() !== "" && $this.parent().next().find('.form-control').val() === "") || ($this.val() === "" && $this.parent().next().find('.form-control').val() !== "")){
                            check = false;
                        }
                    })
                    if (check === false){
                        toastr.error("Please choose both Mix and Max size for a option, if you select any of the mix/max field");
                        return false;
                    }
                }

                $("#loader").show();
                var formData = new FormData(form[0]);
                //console.log(formData);
                formData.append('type', $this.attr('data-type'));
                axios.post(url, formData)
                    .then(function(response) {                  
                        toastr.success('Saved Successfully!');
                        $("#loader").hide();
                        //window.location.reload();
                        //window.location.assign("{{route('admin.product.index')}}");
                    }).catch(function(error) {
                        $("#loader").hide();
                        let errors = error.response.data.errors;
                        $.each(errors, function(key, value) {
                            toastr.error(value)
                        })
                    });
            })

            $(document).on("dblclick", ".table-input", function(e) {
                e.stopPropagation();

                var isChange = false;
                var $this = $(this);
                var oldval = $this.val();
                $(".table-input").removeAttr('style');
                $this.removeAttr('readonly').addClass('border_color').on('change', function(abc) {
                    var newcont = $this.val();
                    if (isChange == false) {
                        if (newcont == null || newcont == "" || newcont == "0" || newcont <= 0) {
                            alert("This field can not be blank or zero or less than zero");
                            $this.val(oldval);
                        } else if (oldval != newcont) {
                            var authorise = confirm("Are you sure about making this change!");
                            if (authorise == true) {
                                var request = $.ajax({
                                    url: "{{ route('admin.main.product.price.single.update', $productID) }}",
                                    method: "POST",
                                    data: {
                                        id: $this.attr('data-id'),
                                        value: newcont,
                                        type: $this.attr('data-type'),
                                        dataValue: $this.attr('data-value'),
                                        productId: {{ $productID }},
                                    },
                                });
                                request.done(function(msg) {
                               
                                    $this.val(newcont);
                                });
                                request.fail(function(jqXHR, textStatus) {
                                    alert("Request failed: " + textStatus);
                                });
                            } else if (authorise == false) {
                                $this.val(oldval);
                            }

                        }
                        $this.attr('readonly', 'readonly');
                        $this.removeAttr('style');
                    }

                    isChange = true;
                });
            });

            $(document).on('click', function(e) {
                if (!$(e.target).is('.table-input')) {
                    var inputclick = $(".table-input");

                    $.each(inputclick, function() {
                        var $this = $(this);
                        if ($this.hasClass('border_color')) {
                            $this.removeClass('border_color');
                            $this.attr('readonly', 'readonly');
                        }
                    });
                }
            });

            $(document).on('click', '.remove-colour-row', function(e) {
                e.preventDefault();
                $("#loader").show();
                let $this = $(this);
                if ($this.attr('data-id') !== "") {
                    axios.delete("/admin/product/destroy/colors", {
                        data: {
                            id: $this.attr('data-id')
                        }
                    }).then(function(response) {
                        toastr.error('Removed!')
                        $this.parents('.colour-row').remove();
                        $("#loader").hide();
                    }).catch(function(error) {
                        $("#loader").hide();
                        let errors = error.response.data.errors;
                        $.each(errors, function(key, value) {
                            toastr.error(value)
                        })
                    });
                } else {
                    $(this).parents('.colour-row').remove();
                }
            });

            $(document).on('click', '.remove-product-image-badge', function (e) {
                e.preventDefault()
                $("#loader").show();
                let $this = $(this);
                if ($this.attr('data-id') !== "") {
                    axios.delete("{{route('admin.main.product.remove.media')}}", {
                        data: {
                            id: $this.attr('data-id'),
                            pId: $this.attr('data-pid'),
                            type: $this.attr('data-type'),
                        }
                    }).then(function(response) {
                        toastr.error('Removed!')
                        $this.parents('.image-link').remove();
                        $("#loader").hide();
                    }).catch(function(error) {
                        $("#loader").hide();
                        let errors = error.response.data.errors;
                        $.each(errors, function(key, value) {
                            toastr.error(value)
                        })
                    });
                } else {
                    $(this).parents('.colour-row').remove();
                }
            })

            $(document).on('click', ".remove-option-rules-price", function(e) {
                e.preventDefault();
                let $this = $(this);

                if ($this.attr('data-id') !== "" && $this.attr('data-id') != undefined) {
                    axios.delete("{{ route('admin.main.product.option.remove') }}", {
                        data: {
                            id: $this.attr('data-id')
                        }
                    }).then(function(response) {
                        toastr.error('Removed!')
                        // $(this).parents('.remove').remove();
                        $this.parents('.rules-row').remove();
                        $("#loader").hide();
                    }).catch(function(error) {
                        $("#loader").hide();
                        let errors = error.response.data.errors;
                        $.each(errors, function(key, value) {
                            toastr.error(value)
                        })
                    });
                } else {
                    $this.parents('.rules-row').remove();
                }
            })

            jQuery.each($('.product-option-is-active-checkbox'), function() {
                if (!$(this).is(':checked')) {
                    $(this).after("<input type='hidden' value='0' name='is_active[]'>")
                }
            })
            $(document).on('click', '.product-option-is-active-checkbox', function() {
                let $this = $(this);
                if (!$this.is(':checked')) {
                    $this.after("<input type='hidden' value='0' name='is_active[]'>")
                } else if ($this.is(':checked')) {
                    $this.next("input[type='hidden']").remove();
                }
            })

            $('input[name="features[]"]').on('keyup', function(e) {
                let $this = $(this);
                let charCount = $this.val().length;
                $this.siblings().find('.text-counter').text(`(${charCount})`)
                maxLength($this)
            })

            $('.__tabslide').slick({
                arrows: true,
                speed: 500,
                slidesToShow: 5,
                slidesToScroll: 1,
                variableWidth: true,
                infinite: false,
            });

            $(".__tabslide li .nav-link").click(function() {
                $('.__tabslide li .nav-link').removeClass("active");
                $(this).addClass("active");
            });

            $(document).on('click', '.group-based-check-all', function() {
                let $this = $(this);
                let $checkbox = $this.parents('.card-header').next().find(
                    'input:checkbox'); //.not(this).prop('checked', this.checked);
                jQuery.each($checkbox, function(index, val) {
                    if ($this.is(':checked')) {
                        $(this).attr('checked', true)
                        $(this).siblings("input[name='is_active[]']").remove();
                    } else if (!$this.is(':checked')) {
                  
                        $(this).removeAttr('checked');
                        $(this).siblings("input[name='is_active[]']").remove();
                        $(this).after("<input type='hidden' value='0' name='is_active[]'>")
                    }
                })
                // $('input:checkbox').not(this).prop('checked', this.checked);
            });

            // var url = window.location.href;
            $(document).on('click', '.__tabslide li .nav-link', function(e) {
                e.preventDefault();
                var newurl = window.location.protocol + "//" + window.location.host + window.location.pathname + '?tab=' + this.id;
                window.history.pushState({ path: newurl }, '', newurl);
            });

            $(window).on('load', function() {
                var queryString = window.location.search;
                var urlParams = new URLSearchParams(queryString);

                var id = urlParams.get('tab')
             

                if(urlParams.has('tab')== true){
                    $('.product-management-tab ')
                    $('.tab-content .tab-pane').removeClass('active show');
                    $(".tab-content").find("[aria-labelledby="+id+"]").addClass('active show');
                    $('.product-management-tab li').find('#'+id).trigger('click');
                }
            });

            // $( ".sortable" ).sortable({
            //     stop: function (event, ui) {
            //         var data = $(this).sortable('serialize');
            //         $.ajax({
            //             data: {
            //                 "data" : data,
            //                 "where" : "option_id",
            //                 "t" : "product_options",
            //             },
            //             type: 'POST',
            //             url: '{{route('global.sort')}}'
            //         });
            //     }
            // });
        });


        function get_hostname(url) {
            var m = url.match(/^http:\/\/[^/]+/);
            return m ? m[0] : null;
        }

        function addRules(id, $this) {
            let html = `<div class="rules-row  pb-3 "><input type="hidden" value="${id}" name="product_option_id[]"><input type="hidden" name="product_option_rules_id[]">
                            <div class="row gx-2"><div class="col-md-2"><label class="pb-2">Operator</label><select class="form-select" name="option_operator[]" aria-label="Default select example bg-transparent">
                            <option selected="" value="">Open this menu</option><option value="disabled">disabled</option></select></div>
                            <div class="col-md-3"><label for="" class="pb-2">List Option/Group Option</label><select class="form-select bg-transparent" name="option_list[]"><option value="">Select</option>
                            @foreach ($Options as $option)
                                <option value="option:{{ $option->id }}">{{ $option->name }} (Option)</option>
                            @endforeach </select></div>

                           <div class="col-md-2 mt-auto"> <button class="btn remove-option-rules-price btn-secondary btn-sm pe-3 d-flex align-items-center ms-auto"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                           <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                           <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                           </svg><span class="d-none d-md-block ps-2">Remove</span></button> </div> </div>
                        `
            // <div class="col-md-2"><label for="" class="pb-2">Min Width</label><input type="text" name="option_rule_min_width[]" class="form-control" placeholder="Enter min width" ></div>
            //     <div class="col-md-2"><label for="" class="pb-2">Max Width</label><input type="text" name="option_rule_max_width[]" class="form-control" placeholder="Enter max width" ></div>
            $($this).parents('.accordion-item').find(".option_rules_dynamic").append(html)

        }

    </script>
@endsection

