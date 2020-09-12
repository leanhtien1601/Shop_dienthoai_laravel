<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\BaseCategory;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
class CartController extends Controller{
    
    public function showcart(){
        $danhsach = BaseCategory::limit(6)
            ->get();
       return view('font_end.cart',compact('danhsach'));
    }
    public function AddCart($id){

        if(Session::has('cart')){
            // đã mua sản phẩm nào đó rồi
            $cart = Session::get('cart');
            if(isset($cart[$id]))
                $cart[$id] ++;  // đã mua sản phẩm $id rồi, tăng số lượng
            else
                $cart[$id] = 1; // chưa mua sản phẩm hiện tại

            Session::put('cart',$cart);
        }else{
            // chưa mua,
            Session::put('cart',[$id=>1]);
        }


        return redirect()->route('home.index');
    }

    public function GioHang(Request $request){
        if (!Session::has('cart') || empty(Session::get('cart'))) {
            // chưa khởi tạo giỏ hàng hoặc giỏ hàng rỗng
            // hãy chuyển về trang danh sách sản phẩm hoặc hiển thị thông báo gì đó...
//            return redirect()->to('viết địa chỉ trang sản phẩm vào đây');

            return redirect()->route('cart.showCart');
        }
        $danhsach = BaseCategory::limit(6)
            ->get();
                $dataView=[];
                $dataView = ['cartGio'=> [] ];
//               print_r(Session::all() ['cart']) ;
                $cart = Session::get('cart');
        if($request->isMethod('post')){
            foreach($request->all() as $input_name =>$val){
//                echo "<br> $input_name =>$val";
                if(strpos($input_name,'qt_')!==false){
                    $id = str_replace('qt_','',$input_name); // tách lấy id trong chuỗi

                    if(intval($val) <1){
                        // số lượng nhỏ hơn 1 ==> xóa sản phẩm khỏi giỏ hàng
                        unset($cart[$id]);
                    }else
                        $cart[$id] = $val; // gán số lượng mới

                }
            }
            // cập nhật lại session giỏ hàng
            Session::put('cart',$cart);
        }
                $mang_id = array_keys($cart);
                // lấy ds sản phẩm trong giỏ hàng
                $listSP = DB::table('product')->whereIn('id',$mang_id)->get();
                $dataView['listSP']=$listSP;
                $dataView['cart']=$cart;
                $dataView['mang_id']=$mang_id;
                // truyền cái $listSP ra view
                // lệnh foreach này có thể mang ra view để hiển thị

                 return view('font_end.cart',$dataView,compact('cart','danhsach'));
            }


        public function huyGiohang(){
            Session::remove('cart');
            return redirect()->route('home.index');
        }



}
?>
