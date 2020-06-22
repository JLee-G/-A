<?php

namespace App\Http\Controllers;


class Welcome extends Controller
{
    public function main(){
        
        $return_v = [];
        $ShowLink = '';

        //首頁顯示連結
        $ShowLink = '<a href="'.route('admin').'">管理設定</a>';

        $return_v['ShowLink'] = $ShowLink;
        return view('welcome', $return_v);
    }
}
