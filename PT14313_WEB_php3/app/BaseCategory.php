<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class BaseCategory extends Model
{
    protected $table = 'category';
    public $timestamps = false;
    // thêm dữ liệu
    public function SaveNew($data = []){
        DB::table($this->table)->insertGetId($data);
//        return view('back_end.category.show');

    }
    // sửa dữ liệu
    public function SaveUpdate($id_cate,$dataSave){
        //........
        DB::table($this->table)
            ->where('id_cate',$id_cate)
            ->update($dataSave);
    }



}
