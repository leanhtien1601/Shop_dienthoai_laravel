@extends('layout.font_endShow')
@section('showProduct')
        <!-- Menu -->
        <section id="menu"  >
            <div class="container" style="background-color: #ffffff">
                <nav class="navbar navbar-expand-lg navbar-light">
                    <a class="navbar-brand" href="{{ route('home.index') }}">
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
        <section class="banNER" style="width: 100%; background-color: #f7f8fb;margin-top: 10px;">
            <div class="container" style="height: 140px;">
                <div class="row">
                    <div class="col-md-6">
                        @foreach($nameCate as $rowName)
                            <h5 style="line-height: 140px">
                                Danh mục/{{$rowName->name_cate}}
                            </h5>
                        @endforeach
                    </div>
                    <div class="col-md-6"></div>
                </div>
            </div>
        </section>
        <!-- Sản phẩm mới nhất -->
        <section id="menuCon3" style="margin-top: 15px;">
            <div class="container" style="background-color: #ffffff;height: 60px;">
                <h3 style="padding-top: 10px;">
                    Sản phẩm mới nhất
                </h3>
            </div>
        </section>
        <section class="showProduct">
            <div class="container"  style="border-top-style: dotted;border-width: 0.5px;background-color: #ffffff">

                        <div class="row" style="padding-top: 50px;">
                            @foreach($ds as $rowPro)
                            <div class="col-md-3">
                                <div class="card" style="width: 100%;height: 360px;">
                                    <img src="../../public/image/{{$rowPro->image}}" style="height: 180px;" class="card-img-top" alt="..." />
                                    <div class="card-body">
                                        <a href="{{route('product.detail',['id'=>$rowPro->id])}}" style="text-decoration: none">
                                        <h5 class="card-title">{{$rowPro->name}}</h5>
                                        </a>
                                        <p class="card-text" style="color: red;">
                                            <span style="text-decoration: line-through; color: #000; padding-right: 15px;">{{number_format($rowPro->price)}}</span>
                                            {{number_format($rowPro->price_km)}} VNĐ
                                        </p>
                                        <hr>

                                        <button type="button" class="btn btn-outline-primary" style="margin-bottom: 10px;">
                                            <a href="{{route('product.detail',['id'=>$rowPro->id])}}" style="text-decoration: none">Mua ngay</a>
                                        </button>

                                    </div>
                                </div>
                            </div>
                           @endforeach
                        </div> <br><br>
                    </div>

        </section>
    @endsection

