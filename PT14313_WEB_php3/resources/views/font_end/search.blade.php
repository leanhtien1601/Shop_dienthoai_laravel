@extends('layout.font_end2')
<!-- Sản phẩm xem nhiều -->

@section('search')
    <div class="container" style="margin-bottom: 40px;">
        <h5><span class="badge badge-success">Tìm thấy {{count($productSe)}} sản phẩm</span></h5>
    </div>
    <section id="product">
        <div class="container">
            <div class="row">
                @foreach($productSe as $RowPro)
                    <div class="col-lg-3 col-md-auto col-sm-auto" >
                        <div class="card" style=" width:100%;height: 360px;">
                            <img src="../../../public/image/{{$RowPro->image}}" height="180px;" class="card-img-top" alt="..." />
                            <div class="card-body">

                                <a href="{{route('product.detail',['id'=>$RowPro->id])}}" style="text-decoration: none">
                                    <h5 class="card-title">{{$RowPro->name}}</h5>
                                </a>

                                <p class="card-text"style="color:red">
                                    <span style="text-decoration: line-through;color:#000;padding-right:15px;"> {{number_format($RowPro->price)}}</span>
                                    {{number_format($RowPro->price_km)}} VNĐ</p>
                                <hr>
                                <button type="button" class="btn btn-outline-primary" style="margin-bottom:10px">Mua ngay</button>

                            </div>
                        </div>
                    </div>
                    @endforeach
            </div>
        </div>
    </section>
@endsection

