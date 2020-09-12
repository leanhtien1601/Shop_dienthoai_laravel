<?php
namespace App\Http\Controllers;

use App\BaseCategory;
use App\BaseProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ProductController extends Controller{
    public function index(){
        $dataView = [];
        $bang = DB::table('product')
            ->select('product.*','category.name_cate as ten_danhmuc')
            ->join('category','product.id_category','=','category.id_cate')
            ->get();

        $dataView['danhsach'] = $bang;
        return view('back_end.product.show',$dataView);
    }

    // add product
    public function  addProduct(Request $request){
        $dataView = ['errs'=> [] ];
        $dataHienThi = [];
        $bang = DB::table('category')->get();
        $dataHienThi['ds'] = $bang;


        // kiểm tra phương thức nếu là post thì lưu csdl
        if($request->isMethod('post')){
            // là phương thức post
            // kiểm tra hợp lệ dữ liệu
            $rule = [
                'name'    =>'required|min:3|max:20|unique:App\BaseProduct,name',
                'image'   =>'required|mimes:jpeg,jpg,png,gif',
                'content' =>'required',

                'id_category'=>'required',
                'price_km'   =>'required',
                'price'      =>'required',
                'des'        =>'required'

            ];
            $msgE = [
                'name.required' =>'Bạn cần nhập Name',
                'name.min' =>'Name ít nhất là 3 ký tự',
                'name.unique' =>'Tên đã tồn tại',
                'image.required' =>'Bạn cần chọn Image',
                'content.required' =>'Bạn cần điền Content',
                'price_km.required' =>'Bạn cần nhập Price_Km',
                'des.required' =>'Ban can nhap Des',
                'image.mimes'=>'Đây không phải là ảnh'

            ];

            $validator = Validator::make( $request->all(), $rule,$msgE );

            if($validator->fails()){
                // có lỗi xảy ra: dữ liệu không hợp lệ
                $dataView['errs'] = $validator->errors()->toArray();
            }else{
                // không có lỗi: Lưu CSDL
                $objModel = new BaseProduct();
                $dataSave = [];

                if($request->hasFile('image')){
                    $file = $request->file('image');
                    $folder_image ='image';
                    $file->move($folder_image,$file->getClientOriginalName());
                    $dataSave['image'] = $file->getClientOriginalName();


                }
                $dataSave['name']      = $request->get('name');
                $dataSave['content']   = $request->get('content');
                $dataSave['creat_date']  = date('Y-m-d');
                $dataSave['id_category'] = $request->get('id_category');
                $dataSave['des']       = $request->get('des');
                $dataSave['price_km']  = $request->get('price_km');
                $dataSave['price']       = $request->get('price');

                $new_id = $objModel->SaveNew($dataSave);

                return redirect()->route('back_end.product.index');
            }

        }

        return view('back_end.product.form',$dataHienThi,$dataView);
    }
    // edit product

    public function edit($id, Request $request){
        $dataView = [];
        $dataView = ['errs'=> [] ];
        $dataHienThi = [];
        $bang = DB::table('category')->get();
        $dataHienThi['ds'] = $bang;
        //1. lấy dữ liệu đưa lên form
        //2. xử lý post: kiểm tra hợp lệ
        $objDemo = BaseProduct::where('id',$id)->first();
        $dataView['objDemo'] = $objDemo;
//        if(empty())
        // xử lý post:
        if($request->isMethod('post')){
            $rule = [
                'name'    =>'required|min:3|max:20|unique:App\BaseProduct,name',
                'content' =>'required',
                'image'   =>'mimes:jpeg,jpg,png,gif',
                'id_category'=>'required',
                'price_km'   =>'required',
                'price'      =>'required',
                'des'        =>'required'

            ];
            $msgE = [
                'name.required' =>'Bạn cần nhập Name',
                'name.min' =>'Name ít nhất là 3 ký tự',
                'name.unique' =>'Tên đã tồn tại',
                'image.mimes'   =>'Đây không phải là ảnh'


            ];

            $validator = Validator::make($request->all(),$rule,$msgE);
            // kiểm tra
            if($validator->fails()){
                $dataView['errs'] = $validator->errors()->toArray();
            }else{
                // ghi DB

                if( $request->hasFile('image')){
                    $file = $request->file('image');
                    $folder_image ='image';
                    $file->move($folder_image,$file->getClientOriginalName());
                    $editimage = $file->getClientOriginalName();
                    $dataSave = [
                    'name'          => $request->get('name'),
                    'image'         => $editimage,
                    'content'       => $request->get('content'),
                    'id_category'   => $request->get('id_category'),
                    'price_km'      => $request->get('price_km'),
                    'price'         => $request->get('price'),
                    'des'           => $request->get('des')
                ];
                }else{
                    $dataSave = [
                        'name'          => $request->get('name'),
                        'content'       => $request->get('content'),
                        'id_category'   => $request->get('id_category'),
                        'price_km'      => $request->get('price_km'),
                        'price'         => $request->get('price'),
                        'des'           => $request->get('des')
                    ];
                }


                $objModel = new BaseProduct();
                $objDemo->SaveUpdate($id,$dataSave);
                $dataView['msg'] = 'Kết thúc cập nhật!';
                // load lại dữ liệu mới đưa ra view để không bị hiển thị dữ liệu cũ
                // hoặc bạn có thể viết lệnh chuyển trang về trang danh sách.
                // Dùng 1 trong 2 lệnh sau nhé:

                return redirect()->route('back_end.product.index');
            }

        }


        return view('back_end.product.edit',$dataView,$dataHienThi);
    }
    //delete product
    public function delete($id){
        $deleteData = DB::table('product')
            ->where('id', '=', $id)
            ->delete();
        return redirect()->route('back_end.product.index');
    }

    // show product font_end
    public function showProduct($id_cate){
        //show danh mục
//        Log::info('Showing user profile for user: '.$id_cate);
        $danhsach = BaseCategory::limit(6)
            ->get();

        $nameCate = BaseCategory::where('id_cate','=',$id_cate)
            ->get();

        //show sản phẩm
        $dview = [];
        $dview['id_cate']=$id_cate;
        $query = DB::table('product')
            ->where('id_category','=',$id_cate)
            ->orderBy('creat_date','desc')
            ->get();

        $dview['ds']=$query;
        return view('font_end.showProduct',$dview,compact('danhsach','nameCate'));
    }
    // search product
    public function search(Request $request){
        if (empty($request->key)){
            return redirect()->route('home.index');
        }
        $productSe = DB::table('product')
            ->where('name','like','%'.$request->key.'%')
            ->orWhere('price',$request->key)
            ->orWhere('price_km',$request->key)
            ->get();
        return view('font_end.search',compact('productSe'));
    }
    // detail product
    public function detail($id){
        $danhsach = BaseCategory::limit(6)
        ->get();
        $dataView = [];
        $dataView['id'] = $id;
        $query = BaseProduct::where('id','=',$id)
        ->get();
        return view('font_end.detailProduct',$dataView,compact('query','danhsach'));

    }


}
?>
