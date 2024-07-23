<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title',config('app.name'))</title>
    <link rel="icon" href="{{asset('image/icon-2.png')}}">
    <link rel="stylesheet" href="{{mix('resources/css/login-register.css')}}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://kit.fontawesome.com/26096abf41.js" crossorigin="anonymous"></script>
    <style>
        .background-image {
            background-image: url('../../public/image/background.png');
            background-repeat: no-repeat;
            background-size: cover;
            background-position: top;
            width: 100%;
            height: 100vh;
        }

        .scroll {
            overflow-y: auto;
            max-height: 600px;
        }
    </style>
</head>

<body class="background-image">
    @yield('content')
</body>

</html>