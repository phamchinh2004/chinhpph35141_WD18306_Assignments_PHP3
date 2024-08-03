<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', config('app.name'))</title>
    <link rel="icon" href="{{asset('image/icon-2.png')}}">
    <!-- <link rel="stylesheet" href="{{mix('resources/css/user.css')}}"> -->
    <link rel="stylesheet" href="{{mix('resources/css/xzoom.css')}}">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <script src="https://kit.fontawesome.com/26096abf41.js" crossorigin="anonymous"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet" />

    <style>
        /* Giao dien nguoi dung */
        .cus-input>.form-control,
        .cus-input>.btn {
            border-radius: 0%;
        }

        .fix-height {
            height: 300px;
        }

        .strikethough::before {
            content: "";
            position: absolute;
            width: 100%;
            height: 1px;
            background-color: black;
            top: 50%;
            left: 0;
            transform: translateY(-50%);
        }

        .cs-pt {
            cursor: pointer;
        }

        .text-align-center {
            text-align: center;
        }

        .centered {
            vertical-align: middle;
        }

        .attribute-value-hover:hover {
            border-color: black !important;
            /* color: white !important; */
            /* font-weight: bold; */
        }

        .focused {
            background-color: black !important;
            color: white !important;
            font-weight: bold;
        }

        .border {
            border: 2px solid red;
        }

        .customise-radio {
            padding: 3px !important;
            border-radius: 50%;
        }

        .disable {
            color: rgba(51, 63, 72, .5) !important;
            text-decoration-line: line-through !important;
            cursor: no-drop !important;
            position: relative;
            /* Đảm bảo phần tử có thể chứa nội dung được thêm */
            overflow: hidden;
        }

        .rotate {
            top: 24px;
            left: 4px;
        }

        .border-bonus {
            border: 3px solid transparent;
        }

        .blink-border {
            border: 3px solid transparent;
        }

        .blink-border-text {
            border: 3px solid transparent;
        }

        .animation-blink-border {
            border-color: red;
            animation: blink 1s ease-in-out;

        }

        @keyframes blink {

            0%,
            100% {
                border-color: transparent;
            }

            50% {
                border-color: red;
            }
        }

        .form_voucher_css {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 600px;
            height: 500px;
            overflow-y: scroll;
            scrollbar-color: transparent transparent;
            z-index: 1000;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            /* Màu nền mờ */
            z-index: 999;
        }

        .form_voucher_css::-webkit-scrollbar {
            display: none;
        }

        .btn_close_form_css {
            cursor: pointer;
        }

        .item_voucher,
        .freeship_item_voucher {
            height: 160px;
        }
    </style>
</head>

<body>
    <!-- HEADER -->
    <header class="border-bottom position-fixed z-3 w-100 bg-white">
        <div class="container pt-3 pb-3 d-flex justify-content-between align-items-center">
            <a href="#">
                <img src="{{asset('image/logo-removebg.png')}}" alt="" width="100px">
            </a>
            <ul class="navbar navbar-nav d-flex flex-row">
                <li class="nav-item me-3">
                    <a class="nav-link text-black fw-bold" href="{{route('userHome.index')}}/#home">Trang chủ</a>
                </li>
                <li class="nav-item me-3">
                    <a class="nav-link text-black fw-bold" href="{{route('userHome.index')}}/#categories">Danh mục</a>
                </li>
                <li class="nav-item me-3">
                    <a class="nav-link text-black fw-bold" href="{{route('userHome.index')}}/#products">Sản phẩm</a>
                </li>
                <li class="nav-item me-3">
                    <a class="nav-link text-black fw-bold" href="">Giới thiệu</a>
                </li>
                <li class="nav-item me-3">
                    <a class="nav-link text-black fw-bold" href="">Liên hệ</a>
                </li>
                <li class="nav-item me-3">
                    <a class="nav-link text-black fw-bold" href="">Sale</a>
                </li>
            </ul>
            <div>
                <form action="" class="d-flex flex-row cus-input">
                    <input class="rounded-start form-control" type="text" placeholder="Tìm kiếm">
                    <button class="btn btn-white rounded-end border btn-outline-dark"><i class="fa-solid fa-search fa-xl"></i></button>
                </form>
            </div>
            <div class="d-flex flex-row align-items-center">
                @if(Route::has('login'))
                @auth
                <div class="dropdown">
                    <a href="#" class="btn btn-dark dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-expanded="false">Hello {{Auth::user()->informations->first()->full_name}}</a>
                    <ul class="dropdown-menu">
                        <li class="dropdown-item cs-pt"><a href="{{route('cart')}}" class="text-decoration-none text-dark"><i class="fas fa-cart-shopping me-2"></i>Giỏ hàng</a></li>
                        <li class="dropdown-item"><a href="{{route('logout')}}" class="text-decoration-none text-dark"><i class="fas fa-arrow-right-to-bracket me-2"></i>Đăng xuất</a></li>
                    </ul>
                </div>
                @else
                <div class="me-2">
                    <a class="btn btn-white border btn-outline-success" href="{{route('login')}}">Đăng nhập</a>
                </div>
                @if(Route::has('register'))
                <div class="me-2">
                    <a class="btn btn-white border btn-outline-primary" href="{{route('register')}}">Đăng ký</a>
                </div>
                @endif
                @endauth
                @endif
            </div>
        </div>
    </header>
    <!-- CONTAINER -->
    <div style="padding-top: 101px;" class="text-nowrap">
        @yield('content')
    </div>
    <!-- FOOTER -->
    <footer class="border-top">
        <div class="text-center d-flex justify-content-center flex-column border-bottom pb-5 pt-5 bg-light">
            <h3>Đăng ký để được tư vấn</h3>
            <p>Cùng e-SportsJacket cập nhật những thông tin mới nhất về trang phục của các tuyển thủ.</p>
            <form action="" class="">
                <div class="d-flex justify-content-center flex-row">
                    <input class="form-control w-50 p-3" type="email" placeholder="Nhập email đăng ký nhận tư vấn của bạn">
                    <button class="btn btn-light ps-5 pe-5 fw-bold btn-outline-dark" type="submit">Đăng ký</button>
                </div>
            </form>
        </div>
    </footer>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.js.map"></script>
    <script src="{{mix('resources/js/xzoom.js')}}"></script>
    <!-- <script src="{{mix('resources/js/user.js')}}"></script> -->
    <script>
        //-----------------------------------------------------------Notification function-----------------------------------------------------------
        $(document).ready(function(e) {
            function notifications(type, data, title) {
                $(function() {
                    Command: toastr[type](data, title);
                    toastr.options = {
                        closeButton: true,
                        debug: false,
                        newestOnTop: true,
                        progressBar: true,
                        positionClass: "toast-top-right",
                        preventDuplicates: true,
                        onclick: null,
                        showDuration: "300",
                        hideDuration: "1000",
                        timeOut: "10000",
                        extendedTimeOut: "1000",
                        showEasing: "swing",
                        hideEasing: "linear",
                        showMethod: "fadeIn",
                        hideMethod: "fadeOut",
                    };
                });
            };
            //-----------------------------------------------------------currency-----------------------------------------------------------
            function currency() {
                var status = true;
                try {
                    $('.currency').each(function() {
                        var value = $(this).text();
                        // Loại bỏ các ký tự không phải số
                        var numericValue = parseFloat(value.replace(/[^0-9]/g, ''));
                        // Định dạng số theo định dạng tiền tệ
                        var formattedValue = new Intl.NumberFormat('vi-VN', {
                            style: 'currency',
                            currency: 'VND'
                        }).format(numericValue);

                        // Cập nhật giá trị định dạng vào phần tử
                        $(this).text(formattedValue);
                    });
                } catch (e) {
                    status = false;
                }
                return status;
            }
            currency();
            // -----------------------------------------------------------productDetail-----------------------------------------------------------
            var variants;
            @if(!empty($array_variants))
            var variants = @json($array_variants);
            @else
            var variants = [];
            @endif
            var flag = 0;
            var flag_image = false;
            var attribute_value_ids = [];
            var current_item_id = 0;
            var product_id = $('.product_id').val();
            var total_attributes = $('.total_attributes').val();
            var get_main_image_src = $('.main-image').attr('src');
            var get_main_image_src2 = $('.main-image').attr('src');
            var total_stock = $('.update-stock').text();
            var purchase_price = $('.update-purchase-price').text();
            var sale_price = $('.update-sale-price').text();
            var percent_discount = $('.update-percent-discount').text();
            var variant_selected = false;
            var variant_id = null;
            var get_stock_variant_clicked = null;
            //Xử lý sự kiện chọn thuộc tính
            $('.attribute_item').click(function(e) {
                if ($(this).hasClass('able')) {
                    var array_allow_click_attribute_values_id = [];
                    var attributeValueId = $(this).data('id');
                    if ($(this).hasClass('focused')) {
                        flag--;
                        $(this).removeClass('focused');
                        attribute_value_ids = attribute_value_ids.filter(function(item) {
                            return item != attributeValueId;
                        });
                        if (attribute_value_ids.length == 0 || variant_selected == true) {
                            variant_selected = false;
                            variant_id = null;
                        }
                        if (attribute_value_ids.length == 0) {
                            $('.reset_selected').hide();
                        }
                        $('.attribute_group').each(function() {
                            var group = $(this);
                            var groupId = group.data('id');
                            if (groupId == 1) {
                                var group_attribute_values_id_1 = [];
                                attributeValues = group.find('.attribute_item');
                                attributeValues.each(function() {
                                    attributeValuesId = $(this).data('id');
                                    group_attribute_values_id_1.push(attributeValuesId);
                                })
                                if (group_attribute_values_id_1.includes(attributeValueId)) {
                                    flag_image = false;
                                    $('.main-image').attr('src', get_main_image_src2);
                                    $('.main-image').attr('xoriginal', get_main_image_src2);
                                    get_main_image_src = get_main_image_src2;
                                }
                            }
                        });

                        $('.update-purchase-price').text(purchase_price);
                        $('.update-sale-price').text(sale_price);
                        $('.update-stock').text(total_stock);
                        $('.update-percent-discount').text(percent_discount);
                        get_stock_variant_clicked = null;
                        console.log(get_stock_variant_clicked);

                        $('.attribute_item').each(function() {
                            if (!$(this).hasClass('able')) {
                                $(this).removeClass('disable');
                                $(this).addClass('able attribute-value-hover cs-pt');
                                if ($(this).hasClass('disableRadio')) {
                                    $(this).removeClass('disableRadio');
                                }
                            }
                        });

                        variants.forEach(function(variant) {
                            var isSubset = attribute_value_ids.every(function(item) {
                                return variant['attribute_values'].includes(item);
                            });
                            if (isSubset && variant['stock'] > 0) {
                                variant['attribute_values'].forEach(function(item_variant_attribute_value_id) {
                                    if (!array_allow_click_attribute_values_id.includes(item_variant_attribute_value_id)) {
                                        array_allow_click_attribute_values_id.push(item_variant_attribute_value_id);
                                    }
                                });
                            }
                        });
                        array_allow_click_attribute_values_id.forEach(function(item) {
                            $('.able').each(function() {
                                var id_item_btn_click = $(this).data('id');
                                if (!array_allow_click_attribute_values_id.includes(id_item_btn_click)) {
                                    $(this).removeClass('able attribute-value-hover cs-pt');
                                    $(this).addClass('disable');
                                    if ($(this).closest('.attribute_group').data('type') == 'radio') {
                                        $(this).find('.slashRadio').append('<i class="fa-solid fa-slash position-absolute rotate fa-2xl" style="color: #ff0000;"></i>');
                                    }
                                }
                            });
                        });
                    } else {
                        var current_item = $(this).closest('.attribute_group').find('.attribute_item.focused');
                        if (current_item.hasClass('focused')) {
                            current_item.removeClass('focused');
                            current_item_id = current_item.data('id');
                            // console.log('Id trước đó:' + current_item_id);
                            flag--;
                            attribute_value_ids = attribute_value_ids.filter(function(item) {
                                return item != current_item_id;
                            });
                        }
                        flag++;
                        $(this).addClass('focused');
                        attribute_value_ids.push(attributeValueId); //Thêm id của thuộc tính được click vào Mảng
                        if (attribute_value_ids.length > 0) {
                            $('.reset_selected').show();
                        }
                        //Xử lý lọc thuộc tính khi người dùng chọn thuộc tính
                        variants.forEach(function(variant) {
                            var isSubset = attribute_value_ids.every(function(item) {
                                return variant['attribute_values'].includes(item);
                            });
                            if (isSubset && variant['stock'] > 0) {
                                variant['attribute_values'].forEach(function(item_variant_attribute_value_id) {
                                    if (!array_allow_click_attribute_values_id.includes(item_variant_attribute_value_id)) {
                                        array_allow_click_attribute_values_id.push(item_variant_attribute_value_id);
                                    }
                                });
                            }
                        });

                        function arraysEqualUnordered(arr1, arr2) {
                            if (arr1.length !== arr2.length) return false;
                            let sortedArr1 = arr1.slice().sort();
                            let sortedArr2 = arr2.slice().sort();
                            return sortedArr1.every((value, index) => value === sortedArr2[index]);
                        }
                        variants.some(function(variant) {
                            variant_selected = arraysEqualUnordered(variant['attribute_values'], attribute_value_ids);
                            if (variant_selected) {
                                variant_id = variant['variant_id'];
                            }
                            console.log('Trạng thái của variant_selected là: ' + variant_selected);
                            return variant_selected;
                        });
                        array_allow_click_attribute_values_id.forEach(function(item) {
                            $('.able').each(function() {
                                var id_item_btn_click = $(this).data('id');
                                if (!array_allow_click_attribute_values_id.includes(id_item_btn_click)) {
                                    $(this).removeClass('able attribute-value-hover cs-pt');
                                    $(this).addClass('disable');
                                    if ($(this).closest('.attribute_group').data('type') == 'radio') {
                                        $(this).find('.slashRadio').append('<i class="fa-solid fa-slash position-absolute rotate fa-2xl" style="color: #ff0000;"></i>');
                                    }
                                }
                            });
                        });
                        // Action handling
                        e.preventDefault();
                        $('.attribute_group').each(function() {
                            var group = $(this);
                            var groupId = group.data('id');
                            if (groupId == 1) {
                                attributeValues = group.find('.attribute_item');
                                attributeValues.each(function() {
                                    attributeValuesId = $(this).data('id');
                                    if (attribute_value_ids.includes(attributeValuesId)) {
                                        $.ajax({
                                            url: "{{route('userProductDetailFocused')}}",
                                            type: "POST",
                                            data: {
                                                _token: "{{ csrf_token() }}",
                                                attribute_value_ids: attribute_value_ids,
                                                product_id: product_id
                                            },
                                            success: function(response) {
                                                if (response.status == "success") {
                                                    // notifications('success', 'Đã cập nhật sản phẩm', 'Success');
                                                    var imageUrl = response.data['image'];
                                                    var purchase_price = response.data['purchase_price'];
                                                    var sale_price = response.data['sale_price'];
                                                    var stock = response.data['stock'];
                                                    var percent_discount = (100 - (sale_price / purchase_price * 100)).toFixed(1);
                                                    if (imageUrl) {
                                                        $('.main-image').attr('src', imageUrl);
                                                        $('.main-image').attr('xoriginal', imageUrl);
                                                        get_main_image_src = imageUrl;
                                                        flag_image = true;
                                                    } else {
                                                        console.log('Image url is null of undefind')
                                                    }
                                                    if (variant_selected) {
                                                        $('.update-purchase-price').text(purchase_price);
                                                        $('.update-sale-price').text(sale_price);
                                                        $('.update-stock').text(stock);
                                                        $('.update-percent-discount').text(percent_discount);
                                                        get_stock_variant_clicked = stock;
                                                        currency();
                                                    }
                                                } else {
                                                    $('.update-stock').text(0);
                                                    notifications('error', 'Sản phẩm không có sẵn', 'Hết hàng');
                                                    console.log('Response status is not success');
                                                }
                                            },
                                            error: function(xhr) {
                                                alert('Đã xảy ra lỗi trong quá trình xử lý yêu cầu.');
                                            }
                                        })
                                    }
                                })
                            }
                        });
                    }
                }
            });
            //-----------------------------------------------------------Handle images-----------------------------------------------------------
            //Handle when hover sub images
            $('.sub_image_second').hover(
                function() {
                    $(this).addClass('border border-danger border-3 cs-pt');
                    var get_image_src = $(this).attr('src');
                    $('.main-image').attr('src', get_image_src);
                    $('.main-image').attr('xoriginal', get_image_src);
                    console.log(get_image_src);
                },
                function() {
                    if (!$(this).hasClass('clicked')) {
                        $('.main-image').attr('src', get_main_image_src);
                        $('.main-image').attr('xoriginal', get_main_image_src);
                        $(this).removeClass('border border-danger border-3 cs-pt');
                    }
                });
            //Handle when click
            $('.sub_image_second').click(
                function() {
                    if (!$(this).hasClass('clicked')) {
                        $('.sub_image_second').removeClass('clicked border border-danger border-3 cs-pt');
                        $(this).addClass('clicked border border-danger border-3 cs-pt');
                        var get_image_src = $(this).attr('src');
                        $('.main-image').attr('src', get_image_src);
                        $('.main-image').attr('xoriginal', get_image_src);
                        console.log('Đã click vào được');
                    } else {
                        $(this).removeClass('clicked');
                        $('.main-image').attr('src', get_main_image_src);
                        $('.main-image').attr('xoriginal', get_main_image_src);
                    }
                }
            );
            //-----------------------------------------------------------Handle when hover main image-----------------------------------------------------------
            $('.xzoom, .xzoom-gallery').xzoom({
                tint: "#333",
                Xoffset: 15,
            });
            //-----------------------------------------------------------Handle increment and reduce quantity-----------------------------------------------------------
            $('.reduce').click(function() {
                if (!variant_selected) {
                    $('.blink-border').addClass('animation-blink-border');
                    setTimeout(() => {
                        $('.blink-border').removeClass('animation-blink-border');
                    }, 950);
                    notifications('warning', 'Vui lòng chọn sản phẩm!', 'Cảnh báo!');
                } else {
                    if ($('.quantity').val() <= 1) {
                        $('.quantity').val(1);
                    } else {
                        $('.quantity').val($('.quantity').val() - 1);
                    }
                }
            })
            $('.quantity').on('input', function() {
                if (!variant_selected) {
                    $(this).val(1);
                    $('.blink-border').addClass('animation-blink-border');
                    setTimeout(() => {
                        $('.blink-border').removeClass('animation-blink-border');
                    }, 950);
                    notifications('warning', 'Vui lòng chọn sản phẩm!', 'Cảnh báo!');
                } else {
                    if (!Number($(this).val())) {
                        $(this).val(1);
                        notifications('error', 'Vui lòng nhập số!', 'Lỗi');
                    }
                }
            })
            $('.increment').click(function() {
                if (!variant_selected) {
                    $('.blink-border').addClass('animation-blink-border');
                    setTimeout(() => {
                        $('.blink-border').removeClass('animation-blink-border');
                    }, 950);
                    notifications('warning', 'Vui lòng chọn sản phẩm!', 'Cảnh báo!');
                } else {
                    if ($('.quantity').val() >= get_stock_variant_clicked) {
                        $('.blink-border-text').addClass('animation-blink-border');
                        setTimeout(() => {
                            $('.blink-border-text').removeClass('animation-blink-border');
                        }, 950);
                        notifications('warning', 'Đã đạt đến số lượng tối đa trong kho!', 'Cảnh báo!');
                    } else if ($('.quantity').val() >= 10) {
                        notifications('warning', 'Mỗi lần chỉ được phép mua tối đa 10 sản phẩm!', 'Cảnh báo!');
                    } else {
                        $('.quantity').val(function(i, val) {
                            return parseInt(val) + 1;
                        });
                    }
                }
            })
            $('.add-to-cart').click(function() {
                if (!variant_selected) {
                    $('.blink-border').addClass('animation-blink-border');
                    setTimeout(() => {
                        $('.blink-border').removeClass('animation-blink-border');
                    }, 950);
                    notifications('warning', 'Vui lòng chọn sản phẩm!', 'Cảnh báo!');
                } else {
                    var quantity = $('.quantity').val();
                    const url = "{{route('addToCart',['variant_id'=>':variant_id','quantity'=>':quantity'])}}"
                        .replace(':variant_id', variant_id)
                        .replace(':quantity', quantity);
                    window.location.href = url;
                }
            })
            //-----------------------------------------------------------Xử lý reset selected-----------------------------------------------------------
            if (attribute_value_ids.length == 0) {
                $('.reset_selected').hide();
            }
            $('.reset_selected').click(function() {
                attribute_value_ids = [];
                $('.attribute_item').each(function() {
                    if (!$(this).hasClass('able')) {
                        $(this).removeClass('disable');
                        $(this).addClass('able attribute-value-hover cs-pt');
                        if ($(this).hasClass('disableRadio')) {
                            $(this).removeClass('disableRadio');
                        }
                    }
                    if ($(this).hasClass('focused')) {
                        $(this).removeClass('focused');
                    }
                });
                $('.update-purchase-price').text(purchase_price);
                $('.update-sale-price').text(sale_price);
                $('.update-stock').text(total_stock);
                $('.update-percent-discount').text(percent_discount);
                get_stock_variant_clicked = null;
                flag_image = false;
                $('.main-image').attr('src', get_main_image_src2);
                $('.main-image').attr('xoriginal', get_main_image_src2);
                get_main_image_src = get_main_image_src2;
                $('.reset_selected').hide();
                variant_selected = false;
            })

            //-----------------------------------------------------------CART-----------------------------------------------------------
            $('.reduceCart').click(function() {
                var quantityVariantCart = $(this).closest('.variantInfor').find('.quantityCart');
                var cartVariantId = $(this).closest('.variantInfor').data('id');
                var total_price = $(this).closest('.item_cart').find('.total_price');
                var total_payment = $('.total_payment');
                if (quantityVariantCart.val() <= 1) {
                    quantityVariantCart.val(1);
                } else {
                    quantityVariantCart.val(quantityVariantCart.val() - 1);
                }
                $.ajax({
                    url: "{{route('updateCart')}}",
                    type: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        variant_id: cartVariantId,
                        quantity: quantityVariantCart.val()
                    },
                    success: function(response) {
                        if (response.status == "success") {
                            quantityVariantCart.val(response.new_quantity);
                            total_price.text(response.total_price);
                            total_payment.text(response.total_payment);
                            currency();
                        }
                    },
                    error: function(xhr) {
                        console.error(xhr.responseText);
                        notifications('error', 'Có lỗi xảy ra khi cập nhật số lượng!', 'Lỗi');
                    }
                })
            })
            $('.quantityCart').click(function() {
                var valueQuantityCart = $(this).val();
                var total_price = $(this).closest('.item_cart').find('.total_price');
                var total_payment = $('.total_payment');
                $(this).on('input', function() {
                    var cartVariantId = $(this).closest('.variantInfor').data('id');
                    var checkValid = true;
                    if (!Number($(this).val())) {
                        $(this).val(valueQuantityCart);
                        notifications('error', 'Vui lòng nhập số!', 'Lỗi');
                        checkValid = false;
                    } else if ($(this).val() >= 10) {
                        $(this).val(10);
                        notifications('warning', 'Mỗi lần chỉ được mua tối đa 10 sản phẩm!', 'Cảnh báo!');
                    } else {
                        $variantStock = $(this).closest('.variantInfor').data('stock');
                        if ($(this).val() >= $variantStock) {
                            $(this).val($variantStock);
                            notifications('warning', 'Đã đạt đến số lượng tối đa trong kho!', 'Cảnh báo!');
                            checkValid = false;
                        }
                    }
                    if (checkValid) {
                        $.ajax({
                            url: "{{route('updateCart')}}",
                            type: "POST",
                            data: {
                                _token: "{{ csrf_token() }}",
                                variant_id: cartVariantId,
                                quantity: $(this).val()
                            },
                            success: function(response) {
                                if (response.status == "success") {
                                    if (response.status == "success") {
                                        $(this).val(response.new_quantity);
                                        total_price.text(response.total_price);
                                        total_payment.text(response.total_payment);
                                        currency();
                                    }
                                }
                            },
                            error: function(xhr) {
                                console.error(xhr.responseText);
                                notifications('error', 'Có lỗi xảy ra khi cập nhật số lượng!', 'Lỗi');
                            }
                        })
                    }
                    if ($(this).val() >= 10) {
                        $(this).val(valueQuantityCart);
                    }
                })
            })
            $('.incrementCart').click(function() {
                var quantityVariantCart = $(this).closest('.variantInfor').find('.quantityCart');
                var valueQuantityCart = $(this).closest('.variantInfor').data('stock');
                var cartVariantId = $(this).closest('.variantInfor').data('id');
                var total_price = $(this).closest('.item_cart').find('.total_price');
                var total_payment = $('.total_payment');
                if (quantityVariantCart.val() >= valueQuantityCart) {
                    notifications('warning', 'Đã đạt đến số lượng tối đa trong kho!', 'Cảnh báo!');
                } else if (quantityVariantCart.val() >= 10) {
                    notifications('warning', 'Mỗi lần chỉ được phép mua tối đa 10 sản phẩm!', 'Cảnh báo!');
                } else {
                    quantityVariantCart.val(function(i, val) {
                        return parseInt(val) + 1;
                    });
                }
                $.ajax({
                    url: "{{route('updateCart')}}",
                    type: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        variant_id: cartVariantId,
                        quantity: quantityVariantCart.val()
                    },
                    success: function(response) {
                        if (response.status == "success") {
                            if (response.status == "success") {
                                quantityVariantCart.val(response.new_quantity);
                                total_price.text(response.total_price);
                                total_payment.text(response.total_payment);
                                currency();
                            }
                        }
                    },
                    error: function(xhr) {
                        console.error(xhr.responseText);
                        notifications('error', 'Có lỗi xảy ra khi cập nhật số lượng!', 'Lỗi');
                    }
                })
            })
            $('.deleteItemCart').click(function() {
                var cart_id = $(this).data('id');
                $.ajax({
                    url: "{{route('destroyCart')}}",
                    type: "DELETE",
                    data: {
                        _token: "{{csrf_token()}}",
                        cart_id: cart_id
                    },
                    success: function(response) {
                        if (!response.status == 'success') {
                            notifications('error', response.message, 'Lỗi')
                        } else {
                            location.reload();
                        }
                    },
                    error: function(xhr) {
                        console.log(xhr.responseText);
                    }
                })
            })

            var total_item_cart = [];

            function cartCheckBox() {
                $('.checkBoxAll').click(function() {
                    $('.checkBoxProduct').prop('checked', $(this).prop('checked'));
                    $('.checkBoxAll').prop('checked', $(this).prop('checked'));
                    if ($(this).prop('checked')) {
                        $('.checkBoxProduct').each(function() {
                            total_item_cart.push($(this).closest('.item_cart').data('id'));
                        })
                    } else {
                        total_item_cart = [];
                    }
                    console.log(total_item_cart);
                })
                $('.checkBoxProduct').click(function() {
                    var cart_id = $(this).closest('.item_cart').data('id');
                    if ($(this).prop('checked')) {
                        total_item_cart.push(cart_id);
                    } else {
                        total_item_cart = total_item_cart.filter(function(item) {
                            return item != cart_id;
                        });
                    }
                    console.log(total_item_cart);
                    if ($('.checkBoxProduct:checked').length != $('.checkBoxProduct').length) {
                        $('.checkBoxAll').prop('checked', false);
                    } else {
                        $('.checkBoxAll').prop('checked', true);
                    }
                })
            }
            cartCheckBox();

            $('#deleteAllSelectRecord').click(function() {
                if (total_item_cart.length > 0) {
                    $.ajax({
                        url: "{{route('destroyCart')}}",
                        type: "DELETE",
                        data: {
                            _token: "{{csrf_token()}}",
                            cart_array: total_item_cart
                        },
                        success: function(response) {
                            if (!response.status == 'success') {
                                notifications('error', response.message, 'Lỗi')
                            } else {
                                location.reload();
                            }
                        },
                        error: function(xhr) {
                            console.log(xhr.responseText);
                        }
                    })
                } else {
                    notifications('warning', 'Vui lòng chọn sản phẩm cần xóa!', 'Chưa chọn sản phẩm!');
                }
            })
            $('#payment').click(function() {
                if (total_item_cart.length > 0) {
                    const url = "{{route('payment',['items'=>':total_item_cart'])}}"
                        .replace(':total_item_cart', total_item_cart)
                    window.location.href = url;
                } else {
                    notifications('warning', 'Vui lòng chọn sản phẩm cần thanh toán!', 'Chưa chọn sản phẩm!');
                }
            })
            //-------------------------------------------VOUCHER-------------------------------------------
            var voucher_click = false;
            var freeship_voucher_click = false;

            var voucher_id_focused = null;
            var freeship_voucher_id_focused = null;

            var amount_reduce_voucher = 0;
            var amount_reduce_freeship_voucher = 0;

            var total_payment_base = $('.total_payment').text(); //Tổng tiền cần thanh toán gốc

            var value_voucher_base = $('.value_voucher_base').text(); //Phần hiển thị tên mã giảm giá
            var value_shipping_voucher_base = $('.value_shipping_voucher_base').text();
            console.log(value_shipping_voucher_base);
            

            var reduce_voucher_costs = $('.reduce_voucher_costs').text(); //Phần hiển thị giảm được bao nhiêu tiền/%
            var reduce_shipping_costs = $('.reduce_shipping_costs').text();

            $('.detail_reduce_voucher_costs').hide(); //Ẩn chỉ tiết giảm được bao nhiêu tiền

            $('.close_form_voucher').click(function() { //Phần đóng
                $('.form_voucher').hide();
                $('.overlay').hide();
            })
            $('.close_form_freeship_voucher').click(function() {
                $('.form_freeship_voucher').hide();
                $('.overlay').hide();
            })

            $('.voucher-click').click(function() { //Phần mở
                $('.form_voucher').show();
                $('.overlay').show();
            })
            $('.freeship-voucher-click').click(function() {
                $('.form_freeship_voucher').show();
                $('.overlay').show();
            })

            $(document).on('click', '.use_voucher', function() {
                // alert('abc');
                var voucher_id = $(this).data('id');
                var voucher_type = $(this).data('type');
                var voucher_amount = $(this).data('amount');
                var voucher_name = $(this).data('name');
                var voucher_minimum_order_value = $(this).data('minimum_order_value');
                var value_total_payment = total_payment_base;
                value_total_payment = parseFloat(value_total_payment.replace(/[^0-9]/g, ''));
                if (!voucher_click) {
                    if (value_total_payment > voucher_minimum_order_value) {
                        if (voucher_type == 'percent') {
                            amount_reduce_voucher = value_total_payment * voucher_amount / 100;

                            $('.detail_reduce_voucher_costs').text(value_total_payment * voucher_amount / 100).show();

                            value_total_payment = value_total_payment - (value_total_payment * voucher_amount / 100) - amount_reduce_freeship_voucher;

                            $('.reduce_voucher_costs').text('-' + voucher_amount + '%').removeClass('currency');

                            $('.total_payment').text(value_total_payment);
                            currency();

                            var detail_reduce_voucher_costs = $('.detail_reduce_voucher_costs').text();
                            $('.detail_reduce_voucher_costs').text('(-' + detail_reduce_voucher_costs + ')');
                            if (freeship_voucher_click) {
                                var detail_reduce_shipping_costs = $('.reduce_shipping_costs').text();
                                $('.reduce_shipping_costs').text('(-' + detail_reduce_shipping_costs + ')');
                            }


                        } else {
                            amount_reduce_voucher = voucher_amount;

                            value_total_payment = value_total_payment - amount_reduce_voucher - amount_reduce_freeship_voucher;

                            $('.detail_reduce_voucher_costs').text(amount_reduce_voucher);

                            $('.total_payment').text(value_total_payment);
                            currency();

                            var detail_reduce_voucher_costs = $('.detail_reduce_voucher_costs').text();
                            $('.detail_reduce_voucher_costs').text('(-' + detail_reduce_voucher_costs + ')').show();
                            if (freeship_voucher_click) {
                                var detail_reduce_shipping_costs = $('.reduce_shipping_costs').text();
                                $('.reduce_shipping_costs').text('(-' + detail_reduce_shipping_costs + ')');
                            }

                            $('.reduce_voucher_costs').hide();
                        }

                        $('.value_voucher_base').text(voucher_name).addClass('text-success');

                        voucher_click = true;
                        voucher_id_focused = voucher_id;
                        $(this).removeClass('btn btn-dark text-dark bg-white use_voucher').addClass('btn btn-danger text-white bg-danger cancel_use_voucher').text('Bỏ chọn');

                        $('.form_voucher').hide();
                        $('.overlay').hide();

                        notifications('success', 'Áp dụng mã giảm giá thành công!', 'Thành công!');
                    } else {
                        notifications('warning', 'Số tiền thanh toán tối thiểu là: ' + voucher_minimum_order_value + ' mới có thể dùng voucher này!', 'Cảnh báo!')
                    }
                } else {
                    if ($('.cancel_use_voucher').data('id') == voucher_id_focused) {
                        $('.cancel_use_voucher').addClass('use_voucher');
                        $('.cancel_use_voucher').removeClass('btn btn-danger text-white bg-danger');
                        $('.cancel_use_voucher').addClass('btn btn-dark text-dark bg-white');
                        $('.cancel_use_voucher').text('Áp dụng');
                        $('.cancel_use_voucher').removeClass('cancel_use_voucher');
                    }
                    if (value_total_payment > voucher_minimum_order_value) {
                        if (voucher_type == 'percent') {
                            amount_reduce_voucher = value_total_payment * voucher_amount / 100;
                            $('.reduce_voucher_costs').text('-' + voucher_amount + '%');
                            $('.reduce_voucher_costs').removeClass('currency');
                            $('.reduce_voucher_costs').show();

                            $('.detail_reduce_voucher_costs').text(value_total_payment * voucher_amount / 100).show();
                            $('.detail_reduce_voucher_costs')
                            value_total_payment = value_total_payment - (value_total_payment * voucher_amount / 100) - amount_reduce_freeship_voucher;

                            $('.total_payment').text(value_total_payment);

                            currency();

                            var detail_reduce_voucher_costs = $('.detail_reduce_voucher_costs').text();
                            $('.detail_reduce_voucher_costs').text('(-' + detail_reduce_voucher_costs + ')');
                            if (freeship_voucher_click) {
                                var detail_reduce_shipping_costs = $('.reduce_shipping_costs').text();
                                $('.reduce_shipping_costs').text('(-' + detail_reduce_shipping_costs + ')');
                            }

                            $('.value_voucher_base').text(voucher_name).show();
                        } else {
                            amount_reduce_voucher = voucher_amount;
                            $('.detail_reduce_voucher_costs').text(amount_reduce_voucher);

                            value_total_payment = value_total_payment - amount_reduce_voucher - amount_reduce_freeship_voucher;
                            $('.total_payment').text(value_total_payment);

                            $('.value_voucher_base').show().text(voucher_name);

                            currency();

                            var detail_reduce_voucher_costs = $('.detail_reduce_voucher_costs').text();
                            $('.detail_reduce_voucher_costs').text('(-' + detail_reduce_voucher_costs + ')').show();
                            if (freeship_voucher_click) {
                                var detail_reduce_shipping_costs = $('.reduce_shipping_costs').text();
                                $('.reduce_shipping_costs').text('(-' + detail_reduce_shipping_costs + ')');
                            }

                            $('.reduce_voucher_costs').hide();
                        }
                        $('.value_voucher_base').text(voucher_name).addClass('text-success');
                        voucher_click = true;
                        voucher_id_focused = voucher_id;
                        $(this).removeClass('btn btn-dark text-dark bg-white use_voucher').addClass('btn btn-danger text-white bg-danger cancel_use_voucher').text('Bỏ chọn');

                        $('.form_voucher').hide();
                        $('.overlay').hide();

                        notifications('success', 'Áp dụng mã giảm giá thành công!', 'Thành công!');
                    } else {
                        notifications('warning', 'Số tiền thanh toán tối thiểu là: ' + voucher_minimum_order_value + ' mới có thể dùng voucher này!', 'Cảnh báo!')
                    }
                }
            })
            $(document).on('click', '.cancel_use_voucher', function() {
                if ($(this).data('id') == voucher_id_focused) {
                    $(this).removeClass('btn btn-danger text-white bg-danger cancel_use_voucher').addClass('btn btn-dark text-dark bg-white use_voucher').text('Áp dụng');
                }
                var value_total_payment = total_payment_base;
                value_total_payment = parseFloat(value_total_payment.replace(/[^0-9]/g, ''));
                $('.total_payment').text(value_total_payment - amount_reduce_freeship_voucher);
                $('.reduce_voucher_costs').text(reduce_voucher_costs);
                $('.value_voucher_base').text(value_voucher_base);
                currency();
                if (freeship_voucher_click) {
                    var detail_reduce_shipping_costs = $('.reduce_shipping_costs').text();
                    $('.reduce_shipping_costs').text('(-' + detail_reduce_shipping_costs + ')');
                }
                voucher_click = false;
                voucher_id_focused = null;
                amount_reduce_voucher = 0;

                $('.detail_reduce_voucher_costs').text(null);
                $('.reduce_voucher_costs').show();

                $('.form_voucher').hide();
                $('.overlay').hide();
            });

            $(document).on('click', '.use_freeship_voucher', function() {
                var voucher_id = $(this).data('id');
                var voucher_amount = $(this).data('amount');
                var voucher_name = $(this).data('name');
                var voucher_minimum_order_value = $(this).data('minimum_order_value');
                var value_total_payment = total_payment_base;
                value_total_payment = parseFloat(value_total_payment.replace(/[^0-9]/g, ''));
                amount_reduce_freeship_voucher = voucher_amount;
                if (!freeship_voucher_click) {
                    if (value_total_payment > voucher_minimum_order_value) {

                        $('.total_payment').text(value_total_payment - amount_reduce_voucher - voucher_amount);

                        $('.reduce_shipping_costs').text(amount_reduce_freeship_voucher).addClass('text-success');

                        currency();

                        var detail_reduce_shipping_costs = $('.reduce_shipping_costs').text();
                        $('.reduce_shipping_costs').text('(-' + detail_reduce_shipping_costs + ')');
                        if (voucher_click) {
                            var detail_reduce_voucher_costs = $('.detail_reduce_voucher_costs').text();
                            $('.detail_reduce_voucher_costs').text('(-' + detail_reduce_voucher_costs + ')').show();
                        }

                        $('.value_shipping_voucher_base').text(voucher_name).addClass('text-success');

                        freeship_voucher_click = true;
                        freeship_voucher_id_focused = voucher_id;

                        $(this).removeClass('btn btn-dark text-dark bg-white use_freeship_voucher').addClass('btn btn-danger text-white bg-danger cancel_use_freeship_voucher').text('Bỏ chọn');

                        $('.form_freeship_voucher').hide();
                        $('.overlay').hide();

                        notifications('success', 'Áp dụng mã giảm phí vận chuyển thành công!', 'Thành công!');

                    } else {
                        notifications('warning', 'Số tiền thanh toán tối thiểu là: ' + voucher_minimum_order_value + ' mới có thể dùng voucher này!', 'Cảnh báo!')
                    }
                } else {
                    if ($('.cancel_use_freeship_voucher').data('id') == freeship_voucher_id_focused) {
                        $('.cancel_use_freeship_voucher').addClass('use_freeship_voucher');
                        $('.cancel_use_freeship_voucher').removeClass('btn btn-danger text-white bg-danger');
                        $('.cancel_use_freeship_voucher').addClass('btn btn-dark text-dark bg-white');
                        $('.cancel_use_freeship_voucher').text('Áp dụng');
                        $('.cancel_use_freeship_voucher').removeClass('cancel_use_freeship_voucher');
                    }
                    if (value_total_payment > voucher_minimum_order_value) {

                        $('.total_payment').text(value_total_payment - amount_reduce_voucher - voucher_amount);

                        $('.reduce_shipping_costs').text(amount_reduce_freeship_voucher).addClass('text-success');

                        currency();

                        var detail_reduce_shipping_costs = $('.reduce_shipping_costs').text();
                        $('.reduce_shipping_costs').text('(-' + detail_reduce_shipping_costs + ')');
                        if (voucher_click) {
                            var detail_reduce_voucher_costs = $('.detail_reduce_voucher_costs').text();
                            $('.detail_reduce_voucher_costs').text('(-' + detail_reduce_voucher_costs + ')').show();
                        }

                        $('.value_shipping_voucher_base').text(voucher_name).addClass('text-success');

                        freeship_voucher_click = true;
                        freeship_voucher_id_focused = voucher_id;

                        $(this).removeClass('btn btn-dark text-dark bg-white use_freeship_voucher').addClass('btn btn-danger text-white bg-danger cancel_use_freeship_voucher').text('Bỏ chọn');

                        $('.form_freeship_voucher').hide();
                        $('.overlay').hide();

                        notifications('success', 'Áp dụng mã giảm phí vận chuyển thành công!', 'Thành công!');

                    } else {
                        notifications('warning', 'Số tiền thanh toán tối thiểu là: ' + voucher_minimum_order_value + ' mới có thể dùng voucher này!', 'Cảnh báo!')
                    }
                }
            });

            $(document).on('click', '.cancel_use_freeship_voucher', function() {
                if ($(this).data('id') == freeship_voucher_id_focused) {
                    $(this).removeClass('btn btn-danger text-white bg-danger cancel_use_freeship_voucher').addClass('btn btn-dark text-dark bg-white use_freeship_voucher').text('Áp dụng');
                }
                var value_total_payment = total_payment_base;
                value_total_payment = parseFloat(value_total_payment.replace(/[^0-9]/g, ''));
                $('.total_payment').text(value_total_payment - amount_reduce_voucher);
                $('.reduce_shipping_costs').text(reduce_shipping_costs).removeClass('text-success');
                $('.value_shipping_voucher_base').text(value_shipping_voucher_base);
                currency();
                if (voucher_click) {
                    var detail_reduce_voucher_costs = $('.detail_reduce_voucher_costs').text();
                    $('.detail_reduce_voucher_costs').text('(-' + detail_reduce_voucher_costs + ')').show();
                }
                freeship_voucher_click = false;
                freeship_voucher_id_focused = null;
                amount_reduce_freeship_voucher = 0;

                $('.form_freeship_voucher').hide();
                $('.overlay').hide();
            });

            $('.payment_click').click(function() {
                location.reload();
            })
        })
    </script>
</body>

</html>