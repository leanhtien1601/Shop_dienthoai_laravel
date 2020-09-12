<?php
namespace App\Http\Controllers;

use App\BaseCategory;
use App\BaseProduct;
use App\BaseSlide;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller{

    public function index(){

        // show sản phẩm
        $showProduct = BaseProduct::limit(12)
            ->orderBy('creat_date', 'desc')
            -> get();

        $showPrice = BaseProduct::limit(4)
            ->orderBy('price_km','asc')
            ->get();

        // show danh mục
        $ds = BaseCategory::limit(8)
            -> get();


        // show slide
        $bangSlide = BaseSlide::where('status',1)
            -> get();

        return view('font_end.index',compact('ds','bangSlide','showProduct','showPrice'));
    }

    public function sendMail(Request $request){
        $data=[
            'account'=> $request->get('account'),
            'address'=> $request->get('address'),
            'phone'=> $request->get('phone'),
            'tongTien' => $request->get('tongTien'),
            'soLuong'=> $request->get('soLuong'),
            'name'=> $request->get('name'),
            'gmail'=> $request->get('gmail')

        ];
        Mail::send('font_end.view',$data , function ($message) use($data){
                $message->to('tienlaph07928@fpt.edu.vn','Chào bạn');
                $message->from('atvip16012000@gmail.com','Shop fpt');
                $message->subject('Thư cảm ơn');
        });
       $message = "Bạn gửi thành công";
        return redirect()->route('home.index',compact('message'));
    }

    public function showSP($id){
        $dataView = [];
        $dataView['id'] = $id;
        $SP = BaseProduct::where('id','=',$id)
            ->select('product.*','category.name_cate as ten_danhmuc')
            ->join('category','product.id_category','=','category.id_cate')
            ->get();
        return view('font_end.product',compact('SP'));
    }

}
?>
