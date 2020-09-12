<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Đăng kí</title>
  <link href="https://fonts.googleapis.com/css?family=Karla:400,700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.materialdesignicons.com/4.8.95/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="../../../../public/css/login.css">
</head>
<body>
  <main>
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-6 login-section-wrapper">
          <div class="brand-wrapper">
          <a href="{{ route('home.index') }}">
              <img src="../../../../public/image/logo1.png" alt="logo" class="logo" style="width:180px;height:auto">
            </a>
          </div>
          <div class="login-wrapper my-auto">
            <h1 class="login-title">Đổi mật khẩu</h1>
            <form action="" enctype="multipart/form-data" method="post">
            @csrf
            @isset($errs)
                
                @foreach($errs as $e)
                    <p style="color: red;padding-left: 10px;padding-top: 10px;">
                        @if(is_array($e))
                            {{implode('<hr>',$e)}}
                        @else
                            {{$e}}
                        @endif
                    </p>
                @endforeach
            @endisset
              <div class="form-group">
                <label for="email">Username</label>
                <input type="text" name="username"  class="form-control" placeholder="le van a">
              </div>
              
              <div class="form-group">
                <label for="email">Email</label>
                <input type="text" name="gmail"  class="form-control" placeholder="email@example.com">
              </div>

              <div class="form-group mb-4">
                <label for="password">Password cũ</label>
                <input type="password" name="password"  class="form-control" placeholder="enter your passsword">
              </div>
              <div class="form-group mb-4">
                <label for="password">Password mới</label>
                <input type="password" name="passwordNew"  class="form-control" placeholder="enter your passsword">
              </div>
                <button class="btn btn-block login-btn">Thực hiện</button>

            </form>
           <a href="{{route('font_end.user.login')}}" class="forgot-password-link">Đăng nhập</a>
          </div>
        </div>
        <div class="col-sm-6 px-0 d-none d-sm-block">
          <img src="../../../../public/image/34.jpg" alt="login image" class="login-img">
        </div>
      </div>
    </div>
  </main>
  <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</body>
</html>
