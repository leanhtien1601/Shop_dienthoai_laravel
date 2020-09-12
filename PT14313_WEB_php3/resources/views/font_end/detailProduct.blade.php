<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Chi tiết sản phẩm</title>
        <link rel="stylesheet" type="text/css" href="../../../public/css/bootstrap.min.css" />
        <script type="text/javascript" href="../../public/js/bootstrap.min.js"></script>
        <link rel="stylesheet" type="text/css" href="../../../public/css/main.css" />
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
        <meta />
        <link rel="stylesheet" href="../../../public/font_icon/css/all.css">
    </head>
    <body>
        <!-- Menu -->
        <section id="menu">
            <div class="container" id="navbarResponsive">
                <nav class="navbar navbar-expand-lg navbar-light ">
                    <a class="navbar-brand" href="{{route('home.index')}}">
                        <img src="../../../public/image/logo1.png" alt="" />
                    </a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav mr-auto">
                            <li class="nav-item active">
                                <a class="nav-link" href="{{route('home.index')}}">Trang chủ <span class="sr-only">(current)</span></a>
                            </li>
                            @foreach($danhsach as $rowcate)
                            <li class="nav-item">
                                <a class="nav-link" href="{{route('product.showProduct',['id_cate'=>$rowcate->id_cate])}}">{{$rowcate->name_cate}}</a>
                            </li>
                            @endforeach
                            <li class="nav-item">
                                <a class="nav-link" href="#">Giới thiệu</a>
                            </li>
                        </ul>
                        <form class="form-inline my-2 my-lg-0">
                            <input class="form-control mr-sm-2" type="search" placeholder="Nhập tên sản phẩm" aria-label="Search" />
                            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Tìm kiếm</button>
                        </form>
                    </div>
                </nav>
            </div>
        </section>
         <!-- banner -->
         <section class="banNer" style="width:100%;background-color: #f7f8fb;">
            <div class="container" style="height: 140px;">
                <div class="row">

                    <div class="col-md-6">
                        <h3><span class="badge badge-success">Chi tiết sản phẩm</span></h3>
                    </div>
                    <div class="col-md-6"></div>

                </div>
            </div>
        </section>
        <!-- chi tiết sản phẩm -->
        <section class="detaiProduct">
            <div class="container">
                <div class="row">
                    @foreach($query as $row)
                    <div class="col-6">
                        <img src="../../../public/image/{{$row->image}}" alt="">
                    </div>
                    <div class="col-6">
                        <a href=""><h4 >Điện thoại {{$row->name}}</h4></a>
                        <h4 id="colH4">{{number_format($row->price_km)}} VNĐ</h4>
                        <p>{{$row->content}}</p>
                        <i class="fa fa-award"><span style="padding-left: 15px;">Cam kết chất lượng</span></i><br>
                       <i class="fas fa-check-circle"><span style="padding-left: 15px;">Đổi trả miễn phí 30 ngày</span></i><br>
                       <i class="fas fa-angle-double-right"><span style="padding-left: 15px;">Phục vụ tận tình</span></i> <br>
                       <button type="button" class="btn btn-outline-success">Mua ngay</button>
                        <a href="{{route('Product.AddCart',['id'=>$row->id])}}">
                            <button type="button" class="btn btn-outline-danger">Thêm vào giỏ hàng</button>
                        </a>
                    </div>

            </div>
            </div>
        </section>
        <!-- Nội dung -->
        <section class="content">
            <div class="container">
                <h4>Chi tiết</h4><br>

                <p>{{$row->des}}</p>
            @endforeach
                <br>
                <!-- comment -->
            <h5>Comment</h5>
            <hr>
                <form method="post">
            <div class="row">
                <div class="col-md-2 col-sm-auto">
                    <img src="../../public/image/21.jpg" alt="" style="max-width: 100px;max-height: 100px;padding-bottom: 15px ;">
                    <p>Le Anh Tien</p>
                </div>
                <div class="col-md-10 col-sm-auto">
                    <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Magni itaque beatae fuga
                        praesentium recusandae nostrum libero assumenda minus sunt dolor
                        vero optio illum quae eius hic in, veritatis perferendis inventore.</p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-2 col-sm-auto">
                </div>
                <div class="col-md-10 col-sm-auto">
                    <div class="form-group" style="max-width: 100%;">
                        <textarea class="form-control" rows="3"
                        name="content">
                            
                        </textarea><br>

                        <button type="button" class="btn btn-outline-danger">Submit</button>
                      </div>
                </div>
            </div>
                </form>
            </div>
        </section>
        <!-- Lời cảm ơn -->
        <section class="thank" style="height: 350px;background-color:#FFF1F1;text-align: center;">
            <div class="container-fluid">
                    <h3 >Cảm ơn quý khách </h3>
                    <p>Đã tin tưởng sử dụng sản phẩm của chúng tôi suốt thời gian vừa qua :))</p>
            </div>

        </section>
        <!-- footer -->
        <footer>
            <div class="container-fluid" style="background-color: #FF324D;color: cornsilk;">
                <div class="row">
                    <div class="col-md-3 " style="width:100%">
                        <h5 style="padding-top: 15px;padding-left: 20px;;">Cam kết chất lượng</h5>
                        <p style="padding-top: 15px;padding-left: 20px;;">0123456789</p>
                    </div>
                    <div class="col-md-3 "style="width:100%">
                        <h5 style="padding-top: 15px;padding-left: 20px;;">Số điện thoại</h5>
                        <p style="padding-top: 15px;padding-left: 20px;;"> 0123456789</p>
                    </div>
                    <div class="col-md-3 "style="width:100%">
                        <h5 style="padding-top: 15px;padding-left: 20px;;">Địa chỉ</h5>
                        <p style="padding-top: 15px;padding-left: 20px;;">Thái Bình</p>

                    </div>
                    <div class="col-md-3 "style="width:100%">
                        <h5 style="padding-top: 15px;padding-left: 20px;;">Địa chỉ</h5>
                        <p style="padding-top: 15px;padding-left: 20px;;">Thái Bình</p>

                    </div>

                </div>
            </div>
        </footer>
    </body>
</html>
