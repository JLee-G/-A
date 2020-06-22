<?php

namespace App\Http\Controllers;
use ArrayObject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Cookie;


use App\Http\Controllers\DataSheet\User;
use App\Http\Controllers\DataSheet\Department;
use App\Http\Controllers\DataSheet\ClassTable;
use App\Http\Controllers\DataSheet\routes;

use Validator; //驗證器
use DB;

use App\Http\Controllers\Controller;

class UserOperating extends Controller{

    public function store(Request $request)
    {
        $validate_v = [];
        foreach($request->all() as $key => $value){
            //確認是否有此欄位，有的話則加入規則
            if($key == 'password_v') $validate_v[$key] = 'required|Limited_num';
            if($key == 'name_v') $validate_v[$key] = 'required';
            if($key == 'post_v') $validate_v[$key] = 'required';
            if($key == 'department_id') $validate_v[$key] = 'required';
            if($key == 'user_id') $validate_v[$key] = 'required';
            $validatedData = $request->validate($validate_v);
        }
    }

    //搜尋料用
    public function GetData(){

        $this->CheckWatch();    //檢察觀看權限

        $department_id_s = '';
        $classTable_id_s = '';

        //搜尋資料表全部資料
        $posts = DataSheet\User::all();     
        //搜尋資料表部門資料，部門名稱不重複
        $departments = DataSheet\Department::groupBy('name')->orderBy('created_at', 'desc')->get(); 
       
        $classTables = DB::select('select u_c.id as id_u_c, u_d.name as n_u_d, u_c.name as n_u_c from user_class u_c, user_department u_d where u_c.department_id = u_d.id'); 
        
        //取得路徑資料
        $routes = DataSheet\routes::all(); 


        //宣告陣列
        $user_arr = [];
        $department_arr = [];
        $classTable_arr = [];
        $return_v = [];
        $route_arr = [];
        
        //使用者資料
        foreach($posts as $post){

            $Competence_v = '';
            $department_v = '';

            //權限資料
            foreach($classTables as $classTable){
                if($post->Competence == $classTable->id_u_c){
                    $Competence_v = $classTable->n_u_c;
                    $department_v = $classTable->n_u_d;
                }
            }

            //將欄位『name』每一筆資料存放到『user_arr』陣列中
            array_unshift($user_arr, array($post->id,$post->name,$Competence_v,$department_v));
        };

        //部門資料
        foreach($departments as $department){
            //將欄位『name』每一筆資料存放到『department_arr』陣列中
            array_unshift($department_arr, array($department->id, $department->name));
            $department_id_s .= $department->id.',';
        };

        //權限資料
        foreach($classTables as $classTable){
            //將欄位『部門名稱』『權限名稱』『權限ID』每一筆資料存放到『classTable_arr』陣列中
            array_unshift($classTable_arr, array($classTable->n_u_c, $classTable->n_u_d, $classTable->id_u_c)); 
            $classTable_id_s .= $classTable->id_u_c.',';
        }

        foreach($routes as $route){
            
            $Competence_arr = explode(',', $route->Competence);
            array_unshift($route_arr, array($route->id, $route->routes, $Competence_arr));
        }

        $return_v['user_arr'] = $user_arr; 
        $return_v['department_arr'] = $department_arr;
        $return_v['department_id_s'] = $department_id_s;
        $return_v['classTable_arr'] = $classTable_arr;
        $return_v['classTable_id_s'] = $classTable_id_s;
        $return_v['route_arr'] = $route_arr;
        return view('management.list', $return_v);          //跳轉到/management/list頁面，傳送陣列資料
    }

    //新增部門
    public function AddDepartment(Request $request){
        $this->store($request);
        DataSheet\Department::create(['name'=>$request->input("department_id"),'created_at'=>NOW(),'updated_at'=>NOW()]);
        return redirect('management');
    }

    //新增權限
    public function AddPermissions(Request $request){
        $this->store($request);
        DataSheet\ClassTable::create(['department_id'=>$request->input("department_id"),'name'=>$request->input("post_v"),'created_at'=>NOW(),'updated_at'=>NOW()]);
        return redirect('management');
    }

    //修改權限
    public function UserPermissions(Request $request){

        $this->store($request);

        $product = DataSheet\User::find($request->input("user_id")); 
        $product->Competence = $request->input("post_v");
        $product->save();
        
        return redirect('management');
    }

    //修改使用者名稱  密碼
    public function modify(Request $request){

        $this->store($request);

        $flight = DataSheet\User::find(1);

        $flight->name = $request->input("name_v");

        $flight->password = bcrypt($request->input("password_v"));

        $flight->save();

        session(['status' => '已修改']);

        return view('/home');
    }

    public function delete(Request $request){

        $flight = DataSheet\User::find(1);

        $flight->name = $request->input("ID_V");

        $flight->save();

        session(['status' => '已修改']);
        
        return view('/home');
    }

    //修改觀看權限
    public function ModifyWatch(Request $request){

        $SQL_arr = [];
        $Competence_v = '';

        //取得頁面允許觀看權限
        $SQLv = DB::table('allow_routes')->where('id','=', $request->input("route_id"))->pluck('Competence');
        $SQL_arr = explode(',', $SQLv[0]);

        $i = 0;
        if($request->input("isChecked")){
            if(!in_array($request->input("classTable_id"), $SQL_arr)){
                foreach($SQL_arr as $key => $value){
                    $Competence_v .= ($key!=0)?',':'';
                    $Competence_v .= $value;
                }
                $Competence_v .= ($Competence_v!='')?',':'';
                $Competence_v .= $request->input("classTable_id");

                $flight = DataSheet\routes::find($request->input("route_id"));
                $flight->Competence = $Competence_v;
                $flight->save();
            }
        }else{
            if(in_array($request->input("classTable_id"), $SQL_arr)){
                foreach($SQL_arr as $key => $value){
                    if($request->input("classTable_id") != $value){
                        $Competence_v .= ($i!=0)?',':'';
                        $Competence_v .= $value;
                        $i++;
                    }
                } 
                $flight = DataSheet\routes::find($request->input("route_id"));
                $flight->Competence = $Competence_v;
                $flight->save();
            }
        }
    }

    public function MDNpost(Request $request){
        $flight = DataSheet\Department::find($request->input("id"));
        $flight->name = $request->input("modify_v");
        $flight->save();
        return redirect('management');
    }
    
    public function DeleteAuthority(Request $request){
        $flight = DataSheet\ClassTable::find($request->input("id"));
        $flight->delete();
    }
}