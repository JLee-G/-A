<?php

namespace App\Admin\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

use Huztw\Admin\Views\Content;
use Huztw\Admin\Database\Auth\Permission;       //權限資料
use Huztw\Admin\Database\Auth\Administrator;    //使用者資料
use Huztw\Admin\Database\Auth\Route;            //路由資料


class HomeController extends Controller
{
    public function index(Content $content)
    {
        return $content
            ->title('Dashboard')
            ->description('Description...');
    }

    //後台設定
    public function setting(){

        


        $Users_arr = Administrator::all();	//取得使用者資料
        $Permissions_arr = Permission::all();	//取得權限資料
        $Routes_arr = Route::all();	        //取得路由資料
        $user_arr = [];
        $Permission_arr = [];
        $Route_arr = [];
        $Permissions_id_s = ''; 
        $user_id_s = '';

        //取得此使用者底下有哪些權限
        $return_arr = [];
        $u_p_arr = Administrator::all()->map(function($item){
            $return_arr['u_id'] = $item->id;
            $return_arr['u_name'] = $item->name;

            foreach($item->Permissions as $key => $value){
                $return_arr['Permissions'][$key] = $value->id;
            }
            return $return_arr;
        })->toArray();

        //取得此權限底下可用哪些路由
        $return_arr = [];
        $p_r_arr = Permission::all()->map(function($item){

            $return_arr['p_id'] = $item->id;
            $return_arr['p_name'] = $item->name;
            
            foreach($item->routes as $key => $value){
                $return_arr['route'][$key] = $value->id;
            }
            return $return_arr;
        })->toArray();

        //取得使用者 ID、名稱
        foreach($Users_arr as $Users_get){
            array_unshift($user_arr, array($Users_get->id, $Users_get->name));
            $user_id_s .= $Users_get->id.',';
        };

        //取得權限 ID、名稱
        foreach($Permissions_arr as $Permissions_get){
            array_unshift($Permission_arr, array($Permissions_get->id, $Permissions_get->name));
            $Permissions_id_s .= $Permissions_get->id.',';
        };

        //取得路由 ID、名稱
        foreach($Routes_arr as $Routes_get){
            array_unshift($Route_arr, array($Routes_get->id, $Routes_get->name));
        };
    
        //將陣列存入return_v的陣列中
        $return_v['user_arr'] = $user_arr;
        $return_v['user_id_s'] = $user_id_s;
        $return_v['Permission_arr'] = $Permission_arr;
        $return_v['Route_arr'] = $Route_arr;
        $return_v['Permissions_id_s'] = $Permissions_id_s;
        $return_v['p_r_arr'] = $p_r_arr;
        $return_v['u_p_arr'] = $u_p_arr;
        

        return view('admin.setting', $return_v);
    }

    //修改權限所擁有路由
    public function ModifyPermissions(Request $request){

        $P_id = $request->input("P_id");
        $R_id = $request->input("R_id");

        //檢查是否已經有關連資料
        $Related = Permission::find($P_id)->routes()->find($R_id);
        
        //新增路由關聯
        if($request->input("isChecked") && !$Related){
            Permission::find($P_id)->routes()->attach($R_id);
        //刪除路由關聯
        }else if(!$request->input("isChecked") && $Related){
            Permission::find($P_id)->routes()->detach($R_id);
        }
        
        return redirect('admin/setting');
    }
    
    //修改使用者所擁有權限
    public function ModifyUser(Request $request){
        $U_id = $request->input("U_id");
        $P_id = $request->input("P_id");

        //檢查是否已經有關連資料
        $Related = Administrator::find($U_id)->Permissions()->find($P_id);
        
        //新增路由關聯
        if($request->input("isChecked") && !$Related){
            Administrator::find($U_id)->Permissions()->attach($P_id);
        //刪除路由關聯
        }else if(!$request->input("isChecked") && $Related){
            Administrator::find($U_id)->Permissions()->detach($P_id);
        }
        
        return redirect('admin/setting');
    }
}
