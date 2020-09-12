@extends('layout.font_end1')
@section('home')
    <!-- menu-->
    
    <section id="menu" >
        <div class="container" style="background-color: #ffffff">
            <nav class="navbar navbar-expand-lg navbar-light">
                <a class="navbar-brand" href="{{ route('home.index') }}">
                    <img src="../public/image/logo1.png" alt="" />
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item active">
                            <a class="nav-link" href="{{ route('home.index') }}">Trang chủ <span class="sr-only">(current)</span></a>
                        </li>
                        @foreach($ds as $rowcate)
                            <li class="nav-item">
                                <a class="nav-link" href="{{route('product.showProduct',['id_cate'=>$rowcate->id_cate])}}">{{$rowcate->name_cate}}</a>
                            </li>
                        @endforeach
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('Product.GioHang')}}">Giỏ hàng</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="">Giới thiệu</a>
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
{{--     Trình chiếu   --}}
    <section id="slider" style="height: 450px;">
        <div class="container" style="height: 490px;background-color: #ffffff">
            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel" >

                <div class="carousel-inner" ;>

                    <div class="carousel-item active" style="display: block;">
                        <img src="image/banner.jpg" class="d-block w-100" style="height: 480px;" alt="..." >
                        <div class="carousel-caption d-none d-md-block">


                        </div>
                    </div>
                    @foreach($bangSlide as $rowslide)
                    <div class="carousel-item">
                        <img src="image/{{$rowslide->image}}" class="d-block w-100" style="height: 480px;" alt="...">
                        <div class="carousel-caption d-none d-md-block">
                            <h3 style="color: #313131;padding-bottom: 10px;">{{$rowslide->name_pro}}</h3>
                            <button type="button" class="btn btn-outline-danger">
                                <a href="{{$rowslide->link_product}}" style="text-decoration: none"> Xem ngay !!!</a>

                            </button>
                        </div>
                    </div>
                        @endforeach
                </div>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>


    </section>
    <!-- Sản phẩm mới nhất -->
        <section id="menuCon3" style="margin-top: 80px;">
            <div class="container" style="background-color: #ffffff;height: 60px;">
                <h3 style="padding-top: 10px;">
                    Sản phẩm mới nhất
                </h3>
            </div>
        </section>

        <section id="product">
          <div class="container" style="border-top-style: dotted;border-width: 0.5px;background-color: #ffffff">
              <br>
              <br>
              <div class="row">
                  @foreach($showProduct as $RowPro)
                      <div class="col-lg-3 col-md-auto col-sm-auto" >
                          <div class="card" style=" width:100%;height: 360px;margin-top: 30px;">
                              <img src="../public/image/{{$RowPro->image}}" height="180px;" class="card-img-top" alt="..." />
                              <div class="card-body">

                                  <a href="{{route('product.detail',['id'=>$RowPro->id])}}" style="text-decoration: none">
                                      <h5 class="card-title">{{$RowPro->name}}</h5>
                                  </a>

                                  <p class="card-text"style="color:red">
                                      <span style="text-decoration: line-through;color:#000;padding-right:15px;"> {{number_format($RowPro->price)}}</span>
                                      {{number_format($RowPro->price_km)}} VNĐ</p>
                                  <hr>
                                  <button type="button" class="btn btn-outline-primary" style="margin-bottom: 10px;">
                                      <a href="{{route('product.detail',['id'=>$RowPro->id])}}" style="text-decoration: none">Mua ngay</a>
                                  </button>

                              </div>
                          </div>
                      </div>
                  @endforeach
              </div>
              <br>
          </div>
      </section>

    <!-- Sản phẩm mới nhất -->
    <section id="menuCon3" style="margin-top: 80px;">
        <div class="container" style="background-color: #ffffff;height: 60px;">
            <h3 style="padding-top: 10px;">
                Sản phẩm rẻ nhất
            </h3>
        </div>
    </section>

    <section id="product">
        <div class="container" style="border-top-style: dotted;border-width: 0.5px;background-color: #ffffff">
            <br>
            <br>
            <div class="row">
                @foreach($showPrice as $Row)
                    <div class="col-lg-3 col-md-auto col-sm-auto" >
                        <div class="card" style=" width:100%;height: 360px;">
                            <img src="../public/image/{{$Row->image}}" height="180px;" class="card-img-top" alt="..." />
                            <div class="card-body">

                                <a href="{{route('product.detail',['id'=>$Row->id])}}" style="text-decoration: none">
                                    <h5 class="card-title">{{$Row->name}}</h5>
                                </a>

                                <p class="card-text"style="color:red">
                                    <span style="text-decoration: line-through;color:#000;padding-right:15px;"> {{number_format($Row->price)}}</span>
                                    {{number_format($Row->price_km)}} VNĐ</p>
                                <hr>
                                <button type="button" class="btn btn-outline-primary" style="margin-bottom: 10px;">
                                    <a href="{{route('product.detail',['id'=>$Row->id])}}" style="text-decoration: none">Mua ngay</a>
                                </button>

                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <br>
        </div>
    </section>
    @endsection
