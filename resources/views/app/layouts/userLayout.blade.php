<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', config('app.name'))</title>
    <link rel="icon" href="{{asset('image/icon-2.png')}}">
    <link rel="stylesheet" href="{{mix('resources/css/user.css')}}">

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
        .border{
            border: 2px solid red;
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
            <div class="d-flex flex-row">
                @if(Route::has('login'))
                @auth
                <p>Hello user</p>
                <div class="me-2">
                    <a class="btn btn-white border btn-outline-dark" href="{{route('login')}}"><i class="fa-solid fa-arrow-right-to-bracket me-2"></i>Đăng xuất</a>
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
    <div style="padding-top: 101px;">
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.js.map"></script>
    <!-- <script src="{{mix('resources/js/user.js')}}"></script> -->
    <script>
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
            // cart
            $('.checkBoxAll').click(function() {
                $('.checkBoxProduct').prop('checked', $(this).prop('checked'));
                $('.checkBoxAll').prop('checked', $(this).prop('checked'));
            })
            $('.checkBoxProduct').click(function() {
                if ($('.checkBoxProduct:checked').length != $('.checkBoxProduct').length) {
                    $('.checkBoxAll').prop('checked', false);
                } else {
                    $('.checkBoxAll').prop('checked', true);
                }
            })
            // productDetail
            var flag = 0;
            var attribute_value_ids = [];
            var current_item_id = 0;
            var product_id = $('.product_id').val();
            var total_attributes = $('.total_attributes').val();
            if ($('.attribute_item').click(function(e) {
                    var attributeValueId = $(this).data('id');
                    if ($(this).hasClass('focused')) {
                        flag--;
                        $(this).removeClass('focused');
                        attribute_value_ids = attribute_value_ids.filter(function(item) {
                            return item != attributeValueId;
                        });
                    } else {
                        var current_item = $(this).closest('.attribute_group').find('.attribute_item.focused');
                        if (current_item.hasClass('focused')) {
                            current_item.removeClass('focused');
                            current_item_id = current_item.data('id');
                            console.log('Id trước đó:' + current_item_id);
                            flag--;
                            attribute_value_ids = attribute_value_ids.filter(function(item) {
                                return item != current_item_id;
                            });
                        }
                        flag++;
                        $(this).addClass('focused');
                        attribute_value_ids.push(attributeValueId);

                        console.log('Total_attributes:' + total_attributes);
                        console.log('Flag:' + flag);
                        // Action handling
                        // notifications('success', 'Đã cập nhật thông tin sản phẩm', 'Thành công');
                        e.preventDefault();
                        $.ajax({
                            url: "{{route('userProductDetailFocused.show')}}",
                            type: "POST",
                            data: {
                                _token: "{{ csrf_token() }}",
                                attribute_value_ids: attribute_value_ids,
                                product_id: product_id
                            },
                            success: function(response) {
                                if (response.status == "success") {
                                    var imageUrl = response.data['image'];
                                    var purchase_price = response.data['purchase_price'];
                                    var sale_price = response.data['sale_price'];
                                    var stock = response.data['stock'];
                                    var percent_discount = (100 - (sale_price / purchase_price * 100)).toFixed(1);
                                    console.log(purchase_price);
                                    console.log(response.data['image'])
                                    if (imageUrl) {
                                        $('.main-image').attr('src', imageUrl);
                                    } else {
                                        console.log('Image url is null of undefind')
                                    }
                                    $('.update-purchar-price').text(purchase_price);
                                    $('.update-sale-price').text(sale_price);
                                    $('.update-stock').text(stock);
                                    $('.update-percent-discount').text(percent_discount);
                                } else {
                                    $('.update-stock').text(0);
                                    notifications('error', 'Sản phẩm không có sẵn', 'Hết hàng');
                                    console.log('Response status is not success');
                                }
                            },
                            error: function(xhr) {
                                console.error('Status:', xhr.status);
                                console.error('Status Text:', xhr.statusText);
                                console.error('Response Text:', xhr.responseText); // Nội dung phản hồi lỗi từ server
                                if (xhr.responseJSON) {
                                    console.error('Response JSON:', xhr.responseJSON);
                                }
                                alert('Đã xảy ra lỗi trong quá trình xử lý yêu cầu.');
                            }
                        })
                    }
                    console.log('Id mới được chọn:' + attributeValueId);
                    console.log('Cờ:' + flag);
                    console.log('Mảng:' + attribute_value_ids);
                }));
                if($('.sub_image_second').hover(function(){
                    $(this).addClass('border border-danger border-3');
                    var get_image_src=$(this).attr('src');
                    $('.main-image').attr('src',get_image_src);
                    console.log(get_image_src);
                }));
                // if($('.sub_image_second').hover(function(){
                //     $(this).remove('border');
                //     var get_image_src=$(this).attr('src');
                //     console.log(get_image_src);
                // }));
        })
    </script>
</body>

</html>