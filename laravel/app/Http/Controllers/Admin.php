<?php

namespace App\Http\Controllers;

use App\Http\Controllers\DataSheet\department;


class Admin extends Controller
{
    public function main(){
        
        $return_v = [];
        $ShowLink = '';
        return view('admin.list');
    }

    //部門管理
    public function department(){

        $posts = DataSheet\department::all();		//搜尋資料表全部資料
        $return_v = [];							    
        $department_arr = [];
    
        foreach($posts as $post){
            //取得部門名稱&ID
            array_unshift($department_arr, array($post->id, $post->name));
        };
    
        $return_v['department_arr'] = $department_arr;		//將陣列存入return_v的user_arr陣列中
        dump($return_v);
        return view('admin.department');
    }

    //新增部門
    public function AddDepartment(){

    }

    //權限管理
    public function competence(){
        return view('admin.competence');
        
    }

    //會員管理
    public function member(){
        return view('admin.member');

    }
}
