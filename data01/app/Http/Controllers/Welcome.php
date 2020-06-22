<?php

namespace App\Http\Controllers;
use ArrayObject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\DataSheet\User;
use App\Http\Controllers\DataSheet\Department;
use App\Http\Controllers\DataSheet\ClassTable;
use App\Http\Controllers\DataSheet\routes;
use DB;
use Auth;

use Validator; //驗證器

use App\Http\Controllers\Controller;

class Welcome extends Controller{
    
    public function ShowProcess(){
        
        $ShowSetUp = '<a href="'.url('/management').'">'.__('management').'</a>';
        $return_v = [];
        $user_id = Auth::id();
        //己查是否已登入
        if($user_id){
            $path_v = 'management';

            //取得資料庫中此使用者權限是否有觀看此路徑的權限
            $SQLv = DB::select("select u.Competence as u_C, a_r.Competence as a_r_C from users u, allow_routes a_r where u.id = '$user_id' AND a_r.routes = '$path_v' "); 
            $a_r_C_arr = explode(',', $SQLv[0]->a_r_C);
            if(!in_array($SQLv[0]->u_C, $a_r_C_arr)){
                $ShowSetUp = "";
            }
        }else{
            $ShowSetUp = "";
        }

        $return_v['ShowSetUp'] = $ShowSetUp;

        return view('welcome', $return_v);
    }
}