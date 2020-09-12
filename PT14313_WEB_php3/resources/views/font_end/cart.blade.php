<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Giỏ hàng</title>
        <link rel="stylesheet" type="text/css" href="../../public/css/bootstrap.min.css" />
        <script type="text/javascript" href="../../public/js/bootstrap.min.js"></script>
        <link rel="stylesheet" type="text/css" href="../../public/css/main.css" />
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
        <meta />
        <link rel="stylesheet" href="font_icon/css/all.css" />
    </head>
    <body>
    <section class="menu_con">
        <div class="container" style="background-color: #0c9a9a; height: 80px;">
            @if (Auth::check())

                <p id="textChao">Chào bạn {{Auth::user()->gmail}}</p>
                <a href="{{ route('font_end.user.logout')}}" id="textChao">Đăng xuất</a>

            @else

                <a href="{{route('font_end.user.login')}}" id="textChao">Đăng nhập</a>

            @endif
        </div>
    </section>
        <!-- Menu -->
        <section id="menu">
            <div class="container">
                <nav class="navbar navbar-expand-lg navbar-light">
                    <a class="navbar-brand" href="#">
                        <img src="../../public/image/logo1.png" alt="" />
                    </a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav mr-auto">
                            <li class="nav-item active">
                                <a class="nav-link" href="{{ route('home.index') }}">Trang chủ <span class="sr-only">(current)</span></a>
                            </li>
                            @foreach($danhsach as $rowcate)
                                <li class="nav-item">
                                    <a class="nav-link" href="{{route('product.showProduct',['id_cate'=>$rowcate->id_cate])}}">{{$rowcate->name_cate}}</a>
                                </li>
                            @endforeach

                            <li class="nav-item">
                                <a class="nav-link" href="#">Giới thiệu</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{route('Product.GioHang')}}">Giỏ hàng</a>
                            </li>
                        </ul>
                        <form class="form-inline my-2 my-lg-0" method="get" action="{{route('product.search')}}">
                            <input class="form-control mr-sm-2" type="search" placeholder="Nhập tên sản phẩm" name="key" />
                            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Tìm kiếm</button>
                        </form>
                    </div>
                </nav>
            </div>
        </section>
        <!-- banner -->
        <section class="banNer" style="width: 100%; background-color: #f7f8fb;">
            <div class="container" style="height: 140px;">
                <div class="row">
                    <div class="col-md-6">
                        <h3><span class="badge badge-success">Chi tiết giỏ hàng</span></h3>
                    </div>
                    <div class="col-md-6"></div>
                </div>
            </div>
        </section>

        <!-- header -->

        <section class="cart">
            <div class="container">


                @php
                    $tongTien = 0;
                @endphp
                @isset($listSP)
                    <div class="row">
                        <div class="col-md-2">
                            <p>Ảnh sản phẩm</p>
                        </div>
                        <div class="col-md-2">
                            <p>Tên sản phẩm</p>
                        </div>
                        <div class="col-md-2">
                            <p>Giá tiền</p>
                        </div>
                        <div class="col-md-2">
                            <p>Số lượng</p>
                        </div>
                        <div class="col-md-2">
                            <p>Thành tiền</p>
                        </div>
                    </div>
                    <hr/>
                @foreach($listSP as $k => $row)
                        @php
                            $thanhTien = $row->price_km * $cart[$row->id];
                            $tongTien += $thanhTien;
                        @endphp
                        <form action="" method="post">
                <div class="row" style="margin-bottom: 20px; line-height: 60px;">

{{--                    <div class="col-md-2">--}}
{{--                        <p>STT : {{$k+1}}</p>--}}
{{--                    </div>--}}
                    <div class="col-md-2">
                        <img src="../../public/image/{{$row->image}}" alt="" style="max-width: 120px; max-height: 120px;" />
                    </div>
                    <div class="col-md-2">
                        <p>{{$row->name}}</p>
                    </div>
                    <div class="col-md-2">
                        <p>{{$row->price_km}}</p>
                    </div>
                    <div class="col-md-2" >

                        <input type="number" value="{{$cart[$row->id]}}" name="qt_{{$row->id}}"style="height: 30px;" min=0>


                    </div>
                    <div class="col-md-2">
                        <p>{{$thanhTien}}</p>
                    </div>

                </div>
                <hr />
                @endforeach
            @endisset
                <br>
                            @csrf

                <h5>Tổng tiền đơn hàng: {{number_format($tongTien)}}</h5>
                            <br>
                            <button class="btn btn-outline-danger"> Cập nhật giỏ hàng</button>
                            <br>
                </form>
            </div>

        </section>
    <br>
        <section class="detailCart">
            <div class="container">
            <form action="{{route('admin.sendMail')}}" method="post">
                @csrf
                <div class="form-group">
                    <label for="exampleInputPassword1">Tên tài khoản</label>
                    <input type="text" class="form-control" name="account" / required="">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Nhập địa chỉ</label>
                    <input type="text" class="form-control" name="address" / required="">
                    <small id="emailHelp" class="form-text text-muted">Mời bạn nhập địa chỉ chính xác.</small>
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Số điện thoại</label>
                    <input type="number" class="form-control" name="phone" min=0 required="">
                </div>
                <div class="form-group">Gmail</label>
                    <input type="email" class="form-control" name="gmail" min=0 required="">
                </div>
                <input type="hidden" value="{{number_format($tongTien)}}" name="tongTien">
                @isset($listSP)
                    @foreach($listSP as $row)
                        <input type="hidden" value="{{$row->name}}" name="name">
                        <input type="hidden" value="{{$cart[$row->id]}}" name="soLuong">
                        @endforeach
                    @endisset

                <!-- <input type="text" value="" name="gmail"> -->
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Thanh Toán</button>
                <a href="{{route('Product.huy')}}" class="btn btn-primary">
                Hủy đơn hàng
                </a>
                <br>
                <hr>
            </form>

            </div>

        </section>
    </body>
</html>
