<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', config('app.name'))</title>
    <link rel="icon" href="{{asset('image/icon-2.png')}}">
    <link rel="stylesheet" href="{{mix('resources/css/admin.css')}}">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <script src="https://kit.fontawesome.com/26096abf41.js" crossorigin="anonymous"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet" />
</head>

<body>
    <!-- partial:index.partial.html -->
    <div id="nav-bar">
        <input id="nav-toggle" type="checkbox" />
        <div id="nav-header">
            <a id="nav-title" href="#">eSports-Jacket</a>
            <label for="nav-toggle" class="roll_in"><span id="nav-toggle-burger"></span></label>
            <hr />
        </div>
        <div id="nav-content">
            <div class="nav-button"><a class="w-100" href="{{route('adminHome')}}"><i class="fas fa-palette"></i><span>Home</span></a></div>
            <div class="nav-button"><a class="w-100" href="{{route('productsManagerIndex')}}"><i class="fas fa-images"></i><span>Product</span></a></div>
            <div class="nav-button"><a class="w-100" href="{{route('adminCategoriesMagager')}}"><i class="fas fa-thumbtack"></i><span>Category</span></a></div>
            <hr />
            <div class="nav-button"><a class="w-100" href="{{route('adminVouchersMagager')}}"><i class="fas fa-ticket"></i><span>Voucher</span></a></div>
            <div class="nav-button"><a class="w-100" href="{{route('adminOrdersMagager')}}"><i class="fas fa-images"></i><span>Order</span></a></div>
            <div class="nav-button"><a class="w-100" href="{{route('adminBannersMagager')}}"><i class="fas fa-fire"></i><span>Banner</span></a></div>
            <div class="nav-button"><a class="w-100" href="#"><i class="fas fa-magic"></i><span>Spark</span></a></div>
            <hr />
            <div class="nav-button"><i class="fas fa-gem"></i><span>Codepen Pro</span></div>
            <div id="nav-content-highlight"></div>
        </div>
        <input id="nav-footer-toggle" type="checkbox" />
        <div id="nav-footer">
            <div id="nav-footer-heading">
                <div id="nav-footer-avatar"><img src="https://gravatar.com/avatar/4474ca42d303761c2901fa819c4f2547" /></div>
                <div id="nav-footer-titlebox"><a id="nav-footer-title" href="#" class="w-auto">PhạmChình</a><span id="nav-footer-subtitle">Admin</span></div>
                <label for="nav-footer-toggle"><i class="fas fa-caret-up"></i></label>
            </div>
            <div id="nav-footer-content">
                <div class="text-center text-white">
                    <a href="{{route('logout')}}" class="btn btn-danger">Logout</a>
                </div>
            </div>
        </div>
    </div>
    <!-- partial -->
    <!-- CONTAINER -->
    <div class="margin-menu mt-3 text-nowrap">
        @yield('content')
    </div>
    <!-- FOOTER -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.js.map"></script>
    <script src="{{mix('resources/js/admin/product.js')}}"></script>
    <script>
        $(document).ready(function(e) {
            //-----------------------------------------------------------Notification function-----------------------------------------------------------
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
            //-----------------------------------------------------Thu gọn / mở rộng menu-----------------------------------------------------
            var roll_in = false;
            $('.roll_in').click(function() {
                if (!roll_in) {
                    $('.margin-menu').animate({
                        'margin-left': '113px'
                    }, 400);
                    roll_in = true;
                } else {
                    $('.margin-menu').animate({
                        'margin-left': '285px'
                    }, 400);
                    roll_in = false;
                }
            });
            @if(session('statusSuccess'))
            var message = @json(session('statusSuccess'));
            notifications('success', message, 'Successfully');
            @endif
            @if(session('statusError'))
            var message = @json(session('statusError'));
            notifications('error', message, 'Error');
            @endif
        })
    </script>
</body>

</html>