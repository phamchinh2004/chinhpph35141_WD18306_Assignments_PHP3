<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Xin chào {{$fullname}}</title>
</head>

<body>
    <h2>Xin chào {{$fullname}}</h2>
    <p>Vui lòng xác thực tài khoản để tiếp sử dụng web</p>
    <button>
        <a href="{{route('verify.email',['id'=>$id,'token'=>$token])}}">Xác thực tài khoản</a>
    </button>
</body>

</html>