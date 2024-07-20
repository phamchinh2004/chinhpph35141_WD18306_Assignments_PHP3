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
</head>

<body>
    <!-- partial:index.partial.html -->
    <div id="nav-bar">
        <input id="nav-toggle" type="checkbox" />
        <div id="nav-header">
            <a id="nav-title" href="#">eSports-Jacket</a>
            <label for="nav-toggle"><span id="nav-toggle-burger"></span></label>
            <hr />
        </div>
        <div id="nav-content">
            <div class="nav-button"><a class="w-100" href="{{route('adminHome')}}"><i class="fas fa-palette"></i><span>Home</span></a></div>
            <div class="nav-button"><a class="w-100" href="{{route('adminProductsMagager')}}"><i class="fas fa-images"></i><span>Product</span></a></div>
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
                    <a href="#" class="btn btn-danger">Logout</a>
                </div>
            </div>
        </div>
    </div>
    <!-- partial -->
    <!-- CONTAINER -->
    <div class="margin-menu mt-3">
        @yield('content')
    </div>
    <!-- FOOTER -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>