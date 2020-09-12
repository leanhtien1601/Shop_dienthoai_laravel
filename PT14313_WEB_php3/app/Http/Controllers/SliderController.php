<?php
namespace App\Http\Controllers;

use App\BaseSlide;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
//namespace App\Logging;
use Illuminate\Support\Facades\Log;

class SliderController extends Controller{
    public function index(){
       $dataView = [];
       $query = DB::table('slider');
       $bang = $query->get();
       $dataView['ds']=$bang;
//        $message = 'Test chuc nang log: ';
//
//
        Log::emergency($bang);
//
//        Log::alert($message);
//
//        Log::critical($message);
//
//        Log::error($message);
//
//        Log::warning($message);
//
//        Log::notice($message);
//
//        Log::info($message);
//
//        Log::debug($message);
       return view('back_end.slider.show',$dataView);
    }

    // thêm slider
    public function  add(Request $request){
        $dataView = ['errs'=> [] ];

        // kiểm tra phương thức nếu là post thì lưu csdl
        if($request->isMethod('post')){
            // là phương thức post
            // kiểm tra hợp lệ dữ liệu
            $rule = [
                'name_pro'=>'required|min:3|max:100',
                'image' =>'required|mimes:jpeg,jpg,png,gif',
                'link_product' =>'required',
                'status' =>'required'
            ];
            $msgE = [
                'name_pro.required' =>'Bạn cần nhập Name',
                'name_pro.min' =>'Name ít nhất là 5 ký tự',
                'image.required'=>'Bạn cần  chọn ảnh',
                'link_product.required'=>'Bạn cần điền link sản phẩm',
                'image.mimes'=>'Đây không phải là ảnh'

            ];


            $validator = Validator::make( $request->all(), $rule,$msgE );
            if($validator->fails()){
                // có lỗi xảy ra: dữ liệu không hợp lệ
                $dataView['errs'] = $validator->errors()->toArray();
            }else{
                // không có lỗi: Lưu CSDL
                $objModel = new BaseSlide();
                $dataSave = [];
                if($request->hasFile('image')){
                    $file = $request->file('image');
                    $folder_image ='image';
                    $file->move($folder_image,$file->getClientOriginalName());
                    $dataSave['image'] = $file->getClientOriginalName();
                }
                $dataSave['name_pro'] = $request->get('name_pro');
                $dataSave['link_product'] = $request->get('link_product');
                $dataSave['status'] = $request->get('status');

                $new_id = $objModel->SaveNew($dataSave);
                return redirect()->route('back_end.slider.index');
            }

        }

        return view('back_end.slider.form',$dataView);
    }
    // sửa slider
    public function edit($id, Request $request){
        $dataView = [];
        //1. lấy dữ liệu đưa lên form
        //2. xử lý post: kiểm tra hợp lệ
        $objDemo = BaseSlide::where('id',$id)->first();
        $dataView['objDemo'] = $objDemo;
//        if(empty())
        // xử lý post:
        if($request->isMethod('post')){
            $rule = [
                'name_pro'=>'required|min:3|max:100',

                'link_product' =>'required',
                'status' =>'required'
            ];
            $msgE = [
                'name_pro.required' =>'Bạn cần nhập Name',
                'name_pro.min' =>'Name ít nhất là 5 ký tự'
            ];

            $validator = Validator::make($request->all(),$rule,$msgE);
            // kiểm tra
            if($validator->fails()){
                $dataView['err'] = $validator->errors()->toArray();
//                $dataView['err'] = "bạn cần nhập đủ thông tin";
            }else{
                // ghi DB
                if($request->hasFile('image')){
                    $file = $request->file('image');
                    $folder_image ='image';
                    $file->move($folder_image,$file->getClientOriginalName());
                    $editimage = $file->getClientOriginalName();
                    $dataSave = [
                        'name_pro'=> $request->get('name_pro'),
                        'image' => $editimage,
                        'link_product'=>$request->get('link_product'),
                        'status'=>$request->get('status')
                    ];
                }
                $dataSave = [
                    'name_pro'=> $request->get('name_pro'),
                    'link_product'=>$request->get('link_product'),
                    'status'=>$request->get('status')
                ];


                $objModel = new BaseSlide();
                $objDemo->SaveUpdate($id,$dataSave);
                $dataView['msg'] = 'Kết thúc cập nhật!';
                // load lại dữ liệu mới đưa ra view để không bị hiển thị dữ liệu cũ
                // hoặc bạn có thể viết lệnh chuyển trang về trang danh sách.
                // Dùng 1 trong 2 lệnh sau nhé:

//                $dataView['objDemo'] =  Basecategory::where('id',$id)->first();

                return redirect()->route('back_end.slider.index');
            }

        }


        return view('back_end.slider.edit',$dataView);
    }
    //xóa slider
    public function xoa($id){
        $deleteData = DB::table('slider')
            ->where('id', '=', $id)
            ->delete();
        return redirect()->route('back_end.slider.index');
    }


}
?>
