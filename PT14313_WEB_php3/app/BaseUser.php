<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class BaseUser extends Model
{
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



}