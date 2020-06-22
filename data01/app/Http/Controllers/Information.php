<?php

namespace App\Http\Controllers;
use ArrayObject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\DataSheet\User;
use App\Http\Controllers\DataSheet\Department;
use App\Http\Controllers\DataSheet\ClassTable;
use App\Http\Controllers\DataSheet\routes;
use Validator; //驗證器

use App\Http\Controllers\Controller;

class Information extends Controller{
    
    public function GetData(){

        $this->CheckWatch();    //檢察觀看權限

        $return_v = [];
        $return_v['MemberList'] = $this->MemberList(26);  //取得部門人員資料
        return view('Information.list', $return_v);
    }
}