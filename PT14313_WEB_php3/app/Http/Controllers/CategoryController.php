<?php
namespace App\Http\Controllers;

use App\BaseCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;


class CategoryController extends Controller{

    //lấy ra danh sách danh mục
    public function showCategory(){

        $dataView = [];
        $bang = DB::table('category') -> get();
        $dataView['ds'] = $bang;
        return view('back_end.category.show',$dataView);
    }

    // thêm danh mục
    public function  add(Request $request){

            $dataView = ['errs'=> [] ];

        // kiểm tra phương thức nếu là post thì lưu csdl
        if($request->isMethod('post')){
            // là phương thức post
            // kiểm tra hợp lệ dữ liệu
            $rule = [
                'name_cate'=>'required|min:3|unique:App\BaseCategory,name_cate',
                'images' =>'required|mimes:jpeg,jpg,png,gif'
            ];
            $msgE = [
                'name_cate.required' =>'Bạn cần nhập Name',
                'name_cate.min' =>'Name ít nhất là 5 ký tự',
                'images.required' =>'Bạn cần chọn ảnh',
                'images.mimes'=>'Đây không phải là ảnh',
                'name_cate.unique'=>'Tên đã tồn tại'

            ];
            $validator = Validator::make( $request->all(), $rule,$msgE );
            if($validator->fails()){
                // có lỗi xảy ra: dữ liệu không hợp lệ
                $dataView['errs'] = $validator->errors()->toArray();

            }else{
                // không có lỗi: Lưu CSDL
                $objModel = new BaseCategory();
                $dataSave = [];
                if($request->hasFile('images')){
                    $file = $request->file('images');
                    $folder_image ='image';
                    $file->move($folder_image,$file->getClientOriginalName());
                    $dataSave['images'] = $file->getClientOriginalName();
                }
                $dataSave['name_cate'] = $request->get('name_cate');
                $new_id = $objModel->SaveNew($dataSave);
                return redirect()->route('back_end.category.showCategory');
            }

        }

        return view('back_end.category.form',$dataView);
    }
    // sửa danh mục
    public function edit($id_cate, Request $request){
        $dataView = [];
        $dataView = ['errs'=> [] ];
        //1. lấy dữ liệu đưa lên form
        //2. xử lý post: kiểm tra hợp lệ
        $objDemo = BaseCategory::where('id_cate',$id_cate)->first();
        $dataView['objDemo'] = $objDemo;
//        if(empty())
        // xử lý post:
        if($request->isMethod('post')){
            $rule = [
                'name_cate'=>'required|min:2|max:20|unique:App\BaseCategory,name_cate',
                'images'=> 'mimes:jpeg,jpg,png,gif'

            ];
            $msgE = [
                'name_cate.required' =>'Bạn cần nhập Name',
                'name_cate.min' =>'Name ít nhất là 5 ký tự',
                'images.mimes' =>'Bạn cần chọn ảnh',
                'name_cate.unique'=>'Tên đã tồn tại'

            ];

            $validator = Validator::make($request->all(),$rule,$msgE);
            // kiểm tra
            if($validator->fails()){
                $dataView['errs'] = $validator->errors()->toArray();
//                return view();
            }else{
                // ghi DB
                if($request->hasFile('images')){
                    $file = $request->file('images');
                    $folder_image ='image';
                    $file->move($folder_image,$file->getClientOriginalName());
                    $editimage = $file->getClientOriginalName();
                     $dataSave = [
                    'name_cate'=> $request->get('name_cate'),
                    'images' => $editimage
                ];
                } else{
                    $dataSave = [
                        'name_cate'=> $request->get('name_cate')

                    ];
                }


                $objModel = new BaseCategory();
                $objDemo->SaveUpdate($id_cate,$dataSave);
                $dataView['msg'] = 'Kết thúc cập nhật!';
                // load lại dữ liệu mới đưa ra view để không bị hiển thị dữ liệu cũ
                // hoặc bạn có thể viết lệnh chuyển trang về trang danh sách.
                // Dùng 1 trong 2 lệnh sau nhé:

//                $dataView['objDemo'] =  Basecategory::where('id',$id)->first();

                return redirect()->route('back_end.category.showCategory');
            }

        }


        return view('back_end.category.edit',$dataView);
    }
    //xóa danh mục
    public function delete($id_cate){
        $deleteData = DB::table('category')
            ->where('id_cate', '=', $id_cate)
            ->delete();
        return redirect()->route('back_end.category.showCategory');
    }

}
?>
