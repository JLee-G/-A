<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

use Auth;
use DB;
use URL;

class Controller extends BaseController
{
    //檢察觀看權限
    public function CheckWatch(){
        $user_id = Auth::id();
        if($user_id){
            $path_arr = [];
            $path_arr = explode('/', $_SERVER['REQUEST_URI']);
            $path_v = $path_arr[count($path_arr)-1];

            //取得資料庫中此使用者權限是否有觀看此路徑的權限
            $SQLv = DB::select("select u.Competence as u_C, a_r.Competence as a_r_C from users u, allow_routes a_r where u.id = '$user_id' AND a_r.routes = '$path_v' "); 
            $a_r_C_arr = explode(',', $SQLv[0]->a_r_C);
            if(!in_array($SQLv[0]->u_C, $a_r_C_arr)){
                echo "<script>alert('無權限觀看此頁面！');location.href = './'</script>";
            }
        }else{
            echo "<script>alert('請先登入');location.href = './login'</script>";
        }
    }

    //部門人員
    public function MemberList($department_id){
        $SQLv = DB::select("select * from user_class u_c, users u where u.Competence = u_c.id AND u_c.department_id = '$department_id' ");
        return $SQLv;
    }
}
