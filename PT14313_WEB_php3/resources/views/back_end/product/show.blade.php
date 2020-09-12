@extends('layout.back_end')
@section('pro_show')
        <div class="right_col" role="main">
            <div class="">
                <div class="page-title">
                    <div class="title_left">
                        <h3><small>Danh sách sản phẩm</small></h3>
                    </div>
                    <div class="title_right">
                        <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Tìm kiếm">
                                <span class="input-group-btn">
                                    <button class="btn btn-secondary" type="button">Ok!</button>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="x_panel">

                            <div class="x_content">

                            <table  class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>STT</th>

                                        <th>Tên sản phẩm</th>

                                        <th>Ảnh</th>
                                        <th>Ngày đăng</th>
                                        <th>Danh mục</th>
                                        <th>Giá khuyến mãi</th>
                                        <th>Giá gốc</th>

                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($danhsach as $k => $Row)
                                    <tr>
                                        <td>{{$k+1}}</td>

                                        <td>{{$Row->name}}</td>

                                        <td>
                                            <img src="../../../public/image/{{$Row->image}}" style="max-height: 150px;max-width: 150px"        alt="">
                                        </td>
                                        <td>{{$Row->creat_date}}</td>
                                        <td>{{$Row->ten_danhmuc}}</td>
                                        <td>{{$Row->price_km}}</td>
                                        <th>{{$Row->price}}</th>
                                        <th>
                                            <a href="{{route('back_end.product.edit',['id'=>$Row->id])}}">
                                                <button type="button" class="btn btn-outline-success">Sửa</button>
                                            </a>
                                        </th>
                                        <th>
                                            <a href="{{route('back_end.product.xoa',['id'=>$Row->id])}}" onclick="return confirm('Bạn muốn xóa chứ')">
                                                <button type="button" class="btn btn-outline-success">Xóa</button>
                                            </a>
                                        </th>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection
