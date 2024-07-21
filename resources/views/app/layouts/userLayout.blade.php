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

    <style>
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
                <div class="me-2">
                    <a class="btn btn-white border btn-outline-success" href="{{route('login')}}">Đăng nhập</a>
                </div>
                <div class="me-2">
                    <a class="btn btn-white border btn-outline-primary" href="{{route('register')}}">Đăng ký</a>
                </div>
                <div class="me-2">
                    <a class="btn btn-white border btn-outline-dark" href="{{route('login')}}"><i class="fa-solid fa-arrow-right-to-bracket me-2"></i>Đăng xuất</a>
                </div>
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
    <script src="{{mix('resources/js/user.js')}}"></script>
    <script>
        $(document).ready(function(e) {
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
        })
    </script>
</body>

</html>