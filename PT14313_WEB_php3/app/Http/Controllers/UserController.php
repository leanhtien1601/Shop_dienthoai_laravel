<?php
namespace App\Http\Controllers;

use App\User;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use App\Permission;


class UserController extends Controller{
    // show tài khoản
    public function index(){
        $dataView = [];
        $bang = DB::table('account')
            ->select('account.*','roles.name as nameAu')
            ->join('roles','account.id_role','=','roles.id')
            ->get();
        ;

        $dataView['ds']=$bang;
        return view('back_end.user.show',$dataView);
    }
    // thêm tài khoản
    public function  add(Request $request){
        $dataView = ['errs'=> [] ];

       // kiểm tra phương thức nếu là post thì lưu csdl
       if($request->isMethod('post')){
           // là phương thức post
           // kiểm tra hợp lệ dữ liệu
           $rule = [
               'username'=>'required|min:3|',
               'image' =>'required|mimes:jpeg,jpg,png,gif',
               'gmail' => 'required|unique:App\User,gmail|email',
               'password' =>'required'


           ];
           $msgE = [
               'username.required' =>'Bạn cần nhập Name',
               'username.min' =>'Name ít nhất là 3 ký tự',
               'gmail.unique'=>'Gmail đã đăng kí rồi',
               'image.mimes' =>'Đây không phải là ảnh',
               'gmail.email'=>'Đây không phải gmail'
           ];


           $validator = Validator::make( $request->all(), $rule,$msgE );
           if($validator->fails()){
               // có lỗi xảy ra: dữ liệu không hợp lệ

               $dataView['errs'] = $validator->errors()->toArray();


           }else{
               // không có lỗi: Lưu CSDL
               $objModel = new User();
               $dataSave = [];
               if($request->hasFile('image')){
                   $file = $request->file('image');
                   $folder_image ='image';
                   $file->move($folder_image,$file->getClientOriginalName());
                   $dataSave['image'] = $file->getClientOriginalName();
               }
               $dataSave['username'] = $request->get('username');
               $dataSave['gmail'] = $request->get('gmail');

               $dataSave['password'] = Hash::make( $request->get('password') ) ;
               $dataSave['id_role'] = 2;
               $new_id = $objModel->SaveNew($dataSave);
               return redirect()->route('font_end.user.login');
           }

       }

       return view('font_end.dangki',$dataView);
   }
    // login
    public function login(Request $request)
    {
        $dataView = [ 'errs' => [] ];
        if ($request->isMethod('post')) {
            // Hãy viết lệnh kiểm tra hợp lệ dữ liệu trước khi login nhé....
            // viết lệnh kiểm tra hợp lệ dữ liệu ở đây....
            $rule = [
                'gmail'=>'required',
                'password'=>'required'// hãy sửa thêm các luật khác để kiểm tra chặt chẽ hơn
            ];
            $validator = Validator::make($request->all(), $rule);

            if($validator->fails()){
                $dataView['errs'] = $validator->errors()->toArray();
            }else{
                //  login
                $dataLogin = [
                    'gmail' => $request->get('gmail'),
                    'password' => $request->get('password')
                ];

                if (Auth::attempt($dataLogin)) {
                    // login thanh cong
                    echo "OK dang nhap thanh cong, thong tin user: ";
                    echo '<pre>';
                    print_r(Auth::user());
                    echo '</pre>';
                    // Lấy id tài khoản đã đăng nhập;
                    echo '<br>ID tai khoan = ' . Auth::id();

                    // Chuyển về trang chủ
                    return redirect()->route('home.index');
                } else {
                    $dataView['errs'][] = 'Sai tên đăng nhập hoặc sai password!';
                }
            }
        }

        return view('font_end.login', $dataView);
    }
    // logout
    public function logout()
    {
        Auth::logout();
        Session::flush();
        return redirect()->route('font_end.user.login');
    }
    public function edit($id, Request $request){
        $dview = [];
        $objDemo = User::where('id',$id)->first();
        $dview['objDemo'] = $objDemo;
        //show quyền
        $nameAu = DB::table('roles')
            ->get();
        $dview['nameAu'] =$nameAu;

//        $checkName = DB::table('account')
//            ->get();
//        $dview['checkName'] =$checkName;
        $dview['id']=$id;
        $query = DB::table('account')
            ->where('id','=',$id)
            ->get();
        $dview['ds']=$query;
        if($request->isMethod('post')){
                    $dataSave = [
                        'id_role'=> $request->get('id_role')
                    ];
                    $objModel = new User();
                    $objDemo->SaveUpdate($id,$dataSave);
                    $dataView['msg'] = 'Kết thúc cập nhật!';

                return redirect()->route('back_end.category.showCategory');
                }
                return view('back_end.user.edit',$dview);
    }
     public function EditPass($id ,Request $request){
        $dataView = [ 'errs' => [] ];
         $objDemo = User::where('id',$id)->first();
        if ($request->isMethod('post')) {
            // Hãy viết lệnh kiểm tra hợp lệ dữ liệu trước khi login nhé....
            // viết lệnh kiểm tra hợp lệ dữ liệu ở đây....

            $rule = [
                'username' => 'required',
                'gmail'    =>'required|email',
                'password' =>'required',
                'passwordNew' =>'required'
                // hãy sửa thêm các luật khác để kiểm tra chặt chẽ hơn
            ];
            $mgE = [
                'username.required' =>'Bạn cần nhập tên',
                'gmail.email'       =>'Bạn cần nhập đúng gmail'
            ];
            $validator = Validator::make($request->all(), $rule,$mgE);

            if($validator->fails()){
                $dataView['errs'] = $validator->errors()->toArray();
            }else{
                //  login
                $dataEditPass = [
                    'username'=>$request->get('username'),
                    'gmail' => $request->get('gmail'),
                    'password' => $request->get('password'),
                    'passwordNew' => $request->get('passwordNew')
                ];

                if (Auth::attempt($dataEditPass)) {
                    // login thanh cong
                    $dataSave = [
                        'password'=> Hash::make( $request->get('passwordNew') )

                    ];
                    $objDemo->SaveUpdate($id,$dataSave);
                    // Chuyển về trang chủ
                    return redirect()->route('home.index');
                } else {
                    $dataView['errs'][] = 'Sai tên đăng nhập hoặc sai password!';
                }
            }
        }
        return view('font_end.editPass',$dataView);
    }
}

?>
