<?php

namespace App\Admin\Controllers;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use Huztw\Admin\View\Content;
// use Cookie;
use Illuminate\Support\Facades\Cookie;
use Huztw\Admin\Database\Auth\Permission;       //權限資料
use Huztw\Admin\Database\Auth\Administrator;    //使用者資料
use Huztw\Admin\Database\Auth\Route;            //路由資料


use App\Order;
use App\Mail\OrderShipped;
use Illuminate\Support\Facades\Mail;

class HomeController extends Controller
{

    public function ddd(Request $request){
        // dd(response());
        $cookie = $request->cookie('name1');
        // dd($request);
        dd($cookie);
    }

    public function kkk(Request $request)
    {
        Cookie::queue('name1', 'Hello, dayang', 30);
        $this->ddd($request);
    }

    // public function mail_test(){
    //     return view('mail');
    // }

    public function index(Content $content)
    {
        // $to = [
        //     [
        //         'email' => 'bn100013@hust.edu.tw', 
        //         'name' => 'Lee',
        //     ]
        // ];
        // Mail::to($to)->send(new OrderShipped);

        return $content
            ->layout('admin::layouts.admin', ['_title_' => trans("admin.home")])
            ->append('admin::index')
            ->style('<link href="' . admin_asset('vendor/huztw-admin/css/admin.css') . '" rel="stylesheet">')
            ->script('<script src="' . admin_asset('vendor/huztw-admin/jQuery/jquery-3.4.1.min.js') . '"></script>')
            ->script('<script src="' . admin_asset('vendor/huztw-admin/js/admin.js') . '"></script>');
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
            
            foreach($item->roles as $key => $value){
                $return_arr['route'][$key] = $value->id;
            }
            return $return_arr;
        })->toArray();
        dump($p_r_arr);
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
