<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thông báo xác minh email</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>

<body class="w-auto">
    <div class="d-flex justify-content-center mt-5">
        <div class="d-flex justify-content-center flex-column align-items-center p-3 border bg-light">
            @if (session('status'))
            <div>
                <p class="text-success text-center">
                    {{session('status')}}
                </p>
            </div>
            @endif
            <p>Chúng tôi đã gửi cho bạn mã xác minh. Vui lòng kiểm tra email của bạn.</p>
            <a href="{{route('verification.resend')}}" class="btn btn-dark">Gửi lại mã</a>
        </div>
    </div>
</body>

</html>