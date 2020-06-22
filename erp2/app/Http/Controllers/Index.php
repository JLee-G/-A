<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Carbon\Carbon;

//資料表
use App\Http\DataSheet\client;

use Validator; //驗證器



class Index extends BaseController
{
    //檢查欄位規則
    public function store(Request $request)
    {
        $validate_v = [];
        foreach($request->all() as $key => $value){
            //確認是否有此欄位，有的話則加入規則
            if($key == 'name') $validate_v[$key] = 'required';
            if($key == 'name_en') $validate_v[$key] = 'required';
            if($key == 'gender') $validate_v[$key] = 'required';
            if($key == 'address') $validate_v[$key] = 'required';
            if($key == 'birthday') $validate_v[$key] = 'required';
            if($key == 'phone') $validate_v[$key] = 'required';
            if($key == 'Telephone_country_code') $validate_v[$key] = 'required';
            if($key == 'Telephone_area_code') $validate_v[$key] = 'required';
            if($key == 'Extension') $validate_v[$key] = 'required';
            if($key == 'Cell_phone') $validate_v[$key] = 'required';
            if($key == 'Emain') $validate_v[$key] = 'required';
            $validatedData = $request->validate($validate_v);
        }
    }



    public function index(){
        $return_v = [];
        $return_v['c_now'] = date('Y/m/d', strtotime('2019/01/01'));

        // $str="你好你好测试测试";
        // echo '<br />';
        // $str = iconv("GBK", "UTF-8", $str);
        // echo $str = mb_convert_encoding($str, "UTF-8", "GBK");


        return view('index', $return_v);
    }


    function curl_post_contents($url,$postdata) {
        $ch = curl_init();
        if (!is_resource($ch)) return false;
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER , 0);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION , 0);
        curl_setopt($ch, CURLOPT_URL , $url);
        curl_setopt($ch, CURLOPT_POST , 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS , $postdata );
        curl_setopt($ch, CURLOPT_RETURNTRANSFER , 1);
        curl_setopt($ch, CURLOPT_VERBOSE , 0);
        $response = curl_exec($ch);
        curl_close($ch);
        return $response;
      }


    //新增客戶資料
    public function New_customer(Request $request){
        $this->store($request);

        $client_arr = client::firstOrCreate([
            'name' => $request->input("name"),
            'name_en' => $request->input("name_en"),
            'gender' => $request->input("gender"),
            'address' => $request->input("address"),
            'birthday' => $request->input("birthday"),
            'phone' => $request->input("phone"),
            'Telephone_country_code' => $request->input("Telephone_country_code"),
            'Telephone_area_code' => $request->input("Telephone_area_code"),
            'Extension' => $request->input("Extension"),
            'Cell_phone' => $request->input("Cell_phone"),
            'Emain' => $request->input("Emain"),
        ]);

        dump($client_arr->wasRecentlyCreated);
    }

    //動作,陣列層,值,原陣列
    public function array_txt($action, $position, $value, $return_v=array()){
        //添加陣列
        if($action == '0'){
            $arr_txt = '';
            $temporary_arr = [];
            $position_arr = explode('=>', $position);					//切割為陣列
            foreach($position_arr as $v){
                $arr_txt .= '["'.$v.'"]';								//產生陣列層字串
            }
                    eval('$temporary_arr'.$arr_txt.'="'.$value.'";');			//宣告陣列
            return array_merge_recursive($return_v, $temporary_arr);	//回傳合併後的陣列
        //刪除陣列
        }else if($action == '1'){
            $arr_txt = '';
            $position_arr = explode('=>', $position);	//切割為陣列
            foreach($position_arr as $v){
                $arr_txt .= '["'.$v.'"]';				//產生陣列層字串
            }
            eval('unset($return_v'.$arr_txt.');');		//刪除指定陣列
            return $return_v;
        }
    }   
}
