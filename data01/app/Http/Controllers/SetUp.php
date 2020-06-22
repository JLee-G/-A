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

class SetUp extends Controller{
    
    public function RefreshUrl(){
        
        $routes = [];
        $comments = '';
        
        foreach (Route::getRoutes()->getIterator() as $route){
            //檢查是否有此路徑資料
            $comments = DataSheet\routes::where('routes', '=', $route->uri)->count();
            //如果沒有此筆路徑資料，則新增
            if(!$comments){
                DataSheet\routes::create(['routes'=>$route->uri,'created_at'=>NOW(),'updated_at'=>NOW()]);
            }
        }
        return redirect('management');
    }
}