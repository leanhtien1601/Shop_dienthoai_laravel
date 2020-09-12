<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Permission;

class User extends Authenticatable
{
    use Notifiable;
    protected $table = 'account';
    public $timestamps = false;
    // thêm dữ liệu
    public function SaveNew($data = []){
        DB::table($this->table)->insertGetId($data);
//        return view('back_end.product.index');

    }
    // sửa dữ liệu
    public function SaveUpdate($id,$dataSave){
        //........
        DB::table($this->table)
            ->where('id',$id)
            ->update($dataSave);
    }
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function role(){
        return $this->belongsTo(Role::class, 'id_role','id');
    }

    // hàm kiểm tra user hiện tại có được gán 1 quyền nào đó hay không,
    // nếu có thì trả về true
    public function hasPermission(Permission $permission){
//        echo $permission->name;

        $check = !!optional(optional($this->role)->permission)->contains($permission);
//        var_dump($check);
//        die();
        return $check;
    }
}
