@extends('layout.back_end');
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
                                <h2>Bảng thêm danh mục</h2>
                                <div class="clearfix"></div>
                            </div>
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

                            @endisset
                            <div class="x_content">
                                <br />
                                <form id="demo-form2" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="item form-group">
                                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name"> Tên danh mục
                                        </label>
                                        <div class="col-md-6 col-sm-6 ">
                                            <input type="text"  class="form-control" name="name_cate">
                                        </div>
                                    </div>
                                    <div class="item form-group">
                                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name"> Ảnh
                                        </label>
                                        <div class="col-md-6 col-sm-6 ">
                                            <input type="file"  class="form-control" name="images">
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-success">Submit</button>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    @endsection





