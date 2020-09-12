@extends('layout.back_end')
@section('cate_show')
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

                                        <th>Tên danh mục</th>
                                        <th>Ảnh</th>
                                        <th>Sửa</th>
                                        <th>Xóa</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($ds as $k => $objRow)
                                    <tr>
                                        <td>{{$k+1}}</td>

                                        <td>{{$objRow->name_cate}}</td>
                                        <td><img src="../../../public/image/{{$objRow->images}}"
                                                 style="max-width:100px;max-height: 100px " alt="">
                                        </td>
                                        <td>
                                            <a href="{{route('back_end.category.edit',['id_cate'=>$objRow->id_cate])}}">
                                                <button type="button" class="btn btn-outline-success">Sửa</button>
                                            </a>
                                        </td>
                                        <td>
                                            <a href="{{route('back_end.category.xoa',['id_cate'=>$objRow->id_cate])}}" onclick="return confirm('Bạn muốn xóa chứ')">
                                            <button type="button" class="btn btn-outline-danger">Xóa</button>
                                            </a>
                                        </td>
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

