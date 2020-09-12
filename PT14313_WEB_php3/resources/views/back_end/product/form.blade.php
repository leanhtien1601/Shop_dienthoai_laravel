@extends('layout.back_end')
@section('cate_form')
        <div class="right_col" role="main">
            <div class="">
                <div class="page-title">
                    <div class="title_right">
                        <div class="col-md-5 col-sm-5  form-group pull-right top_search">
                        </div>
                    </div>
                </div>
                <div class="clearfix"></div>
                <div class="row">
                    <div class="col-md-12 col-sm-12 ">
                        <div class="x_panel">
                            <div class="x_title">
                                <h2>Bảng thêm sản phẩm</h2>
                                <div class="clearfix"></div>
                            </div>

                            <div class="row">
                                <div class="col-2">
                                    @isset($errs)

                                        @foreach($errs as $e)
                                            <div style="border-radius: 10px;width: 150px; height: auto;border-style: dotted;">
                                                <p style="color: red;padding-left: 10px;padding-top: 10px;">
                                                    @if(is_array($e))
                                                        {{implode('<hr>',$e)}}
                                                    @else
                                                        {{$e}}
                                                    @endif
                                                </p></div>
                                        @endforeach

                                    @endisset </div>
                                <div class="col-10">
                            <div class="x_content">

                                <br />
                                <form  method="post" action="" enctype="multipart/form-data">
                                    @csrf
                                    <div class="item form-group">
                                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name"> Tên sản phẩm<span class="required">*</span>
                                        </label>
                                        <div class="col-md-6 col-sm-6 ">
                                            <input type="text"  class="form-control " name="name">
                                        </div>
                                    </div>
                                    <div class="item form-group">
                                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Ảnh<span class="required">*</span>
                                        </label>
                                        <div class="col-md-6 col-sm-6 ">
                                            <input type="file"  class="form-control " name="image">
                                        </div>
                                    </div>
                                    <div class="item form-group">
                                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">Tóm tắt sp <span class="required">*</span>
                                        </label>
                                        <div class="col-md-6 col-sm-6 ">
                                            <input type="text" class="form-control" name="content">
                                        </div>
                                    </div>

                                    <div class="item form-group">
                                        <label for="middle-name" class="col-form-label col-md-3 col-sm-3 label-align">Giá gốc</label>
                                        <div class="col-md-6 col-sm-6 ">
                                            <input class="form-control" type="number" name="price" min=0>
                                        </div>
                                    </div>
                                    <div class="item form-group">
                                        <label for="middle-name" class="col-form-label col-md-3 col-sm-3 label-align">Giá khuyến mãi</label>
                                        <div class="col-md-6 col-sm-6 ">
                                            <input class="form-control" type="number" name="price_km" min=0>
                                        </div>
                                    </div>
                                    <div class="item form-group">
                                        <label for="middle-name" class="col-form-label col-md-3 col-sm-3 label-align">Danh mục</label>
                                        <div class="col-md-6 col-sm-6 ">
                                            <select   name="id_category" class="form-control" >
                                                @foreach($ds as $k => $objRow)
                                                <option value="{{$objRow->id_cate}}" class="form-control">
                                                    {{$objRow->name_cate}}
                                                </option>
                                                @endforeach
                                            </select>
                                        </div>

                                    </div>

                                    <div class="x_panel">
                                        <div class="x_title">
                                            <h2>Nội dung</h2>

                                        </div>
                                        <div class="x_content">
                                            <div class="form-group">

                                                <textarea class="form-control" name="des"  rows="3"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-success">Submit</button>
                                </form>
                            </div>
                            </div>
                        </div></div>
                </div>
                    </div>
                </div>
        </div>
    @endsection

