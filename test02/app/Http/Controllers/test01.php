<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Animal;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

use App\Http\DataSheet\order_table;
use App\Http\DataSheet\amount;
use App\Http\DataSheet\order_shopping_table;
use App\Http\DataSheet\classification;
use App\Http\DataSheet\aviation_table;
use App\Http\DataSheet\supplier_aviation;
use App\Http\DataSheet\aviation_company;
use App\Http\DataSheet\users;
use App\Http\DataSheet\hotel_company;
use App\Http\DataSheet\supplier;
use App\Http\DataSheet\supplier_hotel;
use App\Http\DataSheet\room_table;
use App\Http\DataSheet\currency_table;
use App\Http\DataSheet\client_table;
use App\Http\DataSheet\hotel_shopping;
use App\Http\DataSheet\room_type;



use Requests;


class test01 extends Controller
{
    //動作,陣列層,值,原陣列
    public function array_txt($action, $position, $value, $return_v=array()){
        //添加陣列
        if($action == '0'){
            $arr_txt = '';
            $temporary_arr = [];
            $position_arr = explode('=>', $position);                   //切割為陣列
            foreach($position_arr as $v){
                $arr_txt .= '["'.$v.'"]';                               //產生陣列層字串
            }
            eval('$temporary_arr'.$arr_txt.'="'.$value.'";');           //宣告陣列
            return array_merge_recursive($return_v, $temporary_arr);    //回傳合併後的陣列
        //刪除陣列
        }else if($action == '1'){
            $arr_txt = '';
            $position_arr = explode('=>', $position);   //切割為陣列
            foreach($position_arr as $v){
                $arr_txt .= '["'.$v.'"]';               //產生陣列層字串
            }
            eval('unset($return_v'.$arr_txt.');');      //刪除指定陣列
            return $return_v;
        }
    }

    //新增資料用頁面
    public function test02(){
        $return_v['hotel_all'] = $this->hotel_company_all();
        $return_v['supplier_all'] = $this->supplier_all();
        $return_v['currency_all'] = $this->currency_all();
        $return_v['client_all'] = $this->client_all();
        $return_v['room_type_all'] = $this->room_type_all();
        
        return view('add',$return_v);
    }

    //新增飯店
    public function hotel_addpost(Request $request){

        //檢查是否已有此飯店
        $posts = hotel_company::whereRaw(" name = '".$request->input("hotel")."' ")->get()->take(1);
        
        //已經有此飯店
        if(count($posts) != 0){
            foreach($posts as $value){
                //檢查此供應商是否已經新增過此飯店
                $posts2 = supplier_hotel::whereRaw(" hotel_id = '".$value->id."' AND supplier_id = '".$request->input("supplier_id")."' ")->get()->take(1);
                if(count($posts2) == 0){
                    $supplier_hotel = new supplier_hotel;
                    $supplier_hotel->hotel_id = $value->id;
                    $supplier_hotel->supplier_id = $request->input("supplier_id");
                    $supplier_hotel->Numbering = $request->input("Numbering");
                    $supplier_hotel->save();
                }
            }

        //無此飯店資料
        }else{
            //新增飯店
            $hotel_company = new hotel_company;
            $hotel_company->name = $request->input("hotel");
            $hotel_company->phone = $request->input("hotel").'電話';
            $hotel_company->address = $request->input("hotel").'地址';
            $hotel_company->save();
            
            //新增資料到 供應商&飯店 中介
            $supplier_hotel = new supplier_hotel;
            $supplier_hotel->hotel_id = $hotel_company->id;
            $supplier_hotel->supplier_id = $request->input("supplier_id");
            $supplier_hotel->Numbering = $request->input("hotel").$hotel_company->id.$request->input("supplier_id");
            $supplier_hotel->save();
        }

        return redirect('test02');
    }

    //新增房間
    public function room_addpost(Request $request){

        if($request->input("hotel_Options") != '' && $request->input("supplier_id") != ''){
            //檢查此供應商提供的飯店是否已有此房間
            $r_t = [];
            $s_h = supplier_hotel::whereRaw("hotel_id = '".$request->input("hotel_Options")."' AND supplier_id = '".$request->input("supplier_id")."' ")->get()->take(1);
            $r_t = room_table::whereRaw("supplier_hotel_id = '".$s_h[0]['id']."' AND room_test = '".$request->input("room_test")."' ")->get();

            //無此房間
            if(count($r_t) == 0){
                $room_table = new room_table;
                $room_table->supplier_hotel_id = $s_h[0]['id'];
                $room_table->room_test = $request->input("room_test");
                $room_table->amount = $request->input("amount");
                $room_table->currency = $request->input("currency");
                $room_table->room_type = $request->input("Room_type");
                $room_table->save();
            }
        }
        
        return redirect('test02');
    }

    //新增幣別
    public function currency_addpost(Request $request){

        //檢查是否已有此幣別
        $currency_table_arr = currency_table::whereRaw("currency_name = '".$request->input("currency_name")."' ")->get();
        
        //無此幣別
        if(count($currency_table_arr)==0){
            //新增幣別
            $currency_table = new currency_table;
            $currency_table->Currency_name = $request->input("currency_name");
            $currency_table->save();
        }        
        return redirect('test02');
    }

    //新增供應商
    public function supplier_addpost(Request $request){

        //檢查是否已有此供應商
        $supplier_arr = supplier::whereRaw("name = '".$request->input("supplier_name")."' ")->get();
        
        //無此供應商
        if(count($supplier_arr)==0){
            //新增供應商
            $supplier = new supplier;
            $supplier->name = $request->input("supplier_name");
            $supplier->phone = $request->input("supplier_phone");
            $supplier->address = $request->input("supplier_address");
            $supplier->save();
        }        
        return redirect('test02');
    }

    //新增房型
    public function Room_type_addpost(Request $request){
        //檢查房型是否存在
        $room_type_arr = room_type::whereRaw("name = '".$request->input("Room_type")."' ")->get();

        //無此房型
        if(count($room_type_arr)==0){
            //新增房型
            $currency_table = new room_type;
            $currency_table->name = $request->input("Room_type");
            $currency_table->save();
        }        
        return redirect('test02');
    }

    //新增訂單
    public function order_addpost(Request $request){
        //產生訂單號碼
        $order_number_v = $this->order_number_add();

        //新增訂單
        $order_table = new order_table;
        $order_table->number = $order_number_v;
        $order_table->save();

        // dump($order_table->id);

        //取得房間資訊
        $room_type_all = room_table::all();
        foreach ($room_type_all as $key=>$room_type){
            if($room_type->id == $request->input("Room_Options")){
                $room_id = $room_type->room_type;
                $room_amount = $room_type->amount;
                $room_currency = $room_type->currency;
                $room_supplier_hotel_id = $room_type->supplier_hotel_id;
                break;
            }
        }

        //查詢供應商&飯店 取得供應商ID用
        $supplier_hotel_v = supplier_hotel::find($room_supplier_hotel_id)->toArray();

        //取得房型名稱
        $room_type_v = room_type::find($room_id)->toArray();

        //新增購買資訊
        $hotel_shopping = new hotel_shopping;
        $hotel_shopping->Store_Hotel_id = $request->input("hotel_id");
        $hotel_shopping->client_id = $request->input("client_id");
        $hotel_shopping->clients_id = $request->input("client_id").'先不理';
        $hotel_shopping->Room_name = $room_type_v['name'];
        $hotel_shopping->save();

        // dump($hotel_shopping->id);

        //新增資料到『訂單&購買 中介』表
        $order_shopping_table = new order_shopping_table;
        $order_shopping_table->Order_id = $order_table->id;
        $order_shopping_table->shopping_id = $hotel_shopping->id;
        $order_shopping_table->Type = 1;
        $order_shopping_table->test = $room_type_v['name'].$order_table->id.$hotel_shopping->id;
        $order_shopping_table->save();

        // dump($order_shopping_table->id);


        //新增金額資訊
        $amount = new amount;
        $amount->amount = $room_amount;
        $amount->Currency = $room_currency;
        $amount->Hotel_id = $request->input("hotel_id");
        $amount->supplier_id = $supplier_hotel_v['supplier_id'];
        $amount->save();
        
        // dump($amount->id);

        order_shopping_table::find($order_shopping_table->id)->amounts()->attach($amount->id, ['Type' => '']);

        return redirect('test02');
    }

    //產生訂單號碼
    public function order_number_add(){
        for($i = 1;$i <= 9999;$i++){
            //檢查是否已有此訂單編號
            $order_table_arr = order_table::whereRaw("number = '".date("Ymd").str_pad($i,4,'0',STR_PAD_LEFT)."'")->get()->take(1);
            //沒有此訂單號碼
            if(count($order_table_arr) == 0){
                return date("Ymd").str_pad($i,4,'0',STR_PAD_LEFT);
            }
        }
    }

    //取得幣別資料
    public function currency_all(){
        $return_v = [];
        $currency_all = currency_table::all();
        foreach ($currency_all as $key=>$currency){
            $return_v[$key]['name'] = $currency->currency_name;
        }

        return $return_v;
    }

    //取得所有飯店資料
    public function hotel_company_all(){
      $return_v = [];
      $hotel_all = hotel_company::all();
      foreach ($hotel_all as $key=>$hotel){
        $return_v[$key]['name'] = $hotel->name;
        $return_v[$key]['id'] = $hotel->id;
      }

      return $return_v;
    }


    //取得所有供應商資料
    public function supplier_all(){
        $return_v = [];
        $hotel_all = supplier::all();
        foreach ($hotel_all as $key=>$hotel){
          $return_v[$key]['name'] = $hotel->name;
          $return_v[$key]['id'] = $hotel->id;
        }
  
        return $return_v;
    }

    //取得客戶名稱
    public function client_all(){
        $return_v = [];
        $client_all = client_table::all();
        foreach ($client_all as $key=>$client){
            $return_v[$key]['name'] = $client->name;
            $return_v[$key]['id'] = $client->id;
            $return_v[$key]['phone'] = $client->phone;
            $return_v[$key]['Emain'] = $client->Emain;
        }
  
        return $return_v;
    }

    //取得房型名稱
    public function room_type_all(){
        $return_v = [];
        $room_type_all = room_type::all();
        foreach ($room_type_all as $key=>$room_type){
            $return_v[$key]['name'] = $room_type->name;
            $return_v[$key]['id'] = $room_type->id;
        }
  
        return $return_v;
    }
    
    //取得供應商關聯飯店
    public function Related_Hotelpost(Request $request){

        $return_v = '';
        $supplier_id = $request->input("supplier_id");
        if($supplier_id != ''){

            $supplier_arr = supplier::find($supplier_id)->hotel_companys()->get()->toArray();

            foreach($supplier_arr as $key=>$value){
                if($key!=0) $return_v .= ',';
                if($value['id']!='') $return_v .= $value['id'].':'.$value['name'];
            }
        }

        dump('@!@'.$return_v.'@!@');
    }

    //取得飯店相關房間
    public function Related_Roompost(Request $request){

        $return_v = '';
        $hotel_id = $request->input("hotel_id");
        if($hotel_id != ''){

            $supplier_hotel_arr = supplier_hotel::whereRaw("hotel_id = '".$hotel_id."'")->get()->toArray();

            foreach($supplier_hotel_arr as $key=>$value){

                $room_arr = room_table::whereRaw("supplier_hotel_id = '".$value['id']."'")->get()->toArray();
                foreach($room_arr as $key_1=>$value_1){
                    if($return_v!='') $return_v .= ',';
                    if($value_1['id']!='') $return_v .= $value_1['id'].':'.$value_1['room_test'];
                }
            }
        }

        dump('@!@'.$return_v.'@!@');
    }

    //取得房間資訊
    public function Room_Informationpost(Request $request){

        $return_v = '';

        $room_table_arr = room_table::find($request->input("Room_id"))->toArray();

        $return_v = "房間資訊：房間金額：".$room_table_arr['amount'].",幣別：".$room_table_arr['currency'];

        dump('@!@'.$return_v.'@!@');
    }

    //取得訂單相關資訊
    public function order_inquirepost(Request $request){

        $return_v = "";

        //取得訂單ID
        $order_table_arr = order_table::whereRaw("number = '".$request->input("order_number")."'")->get()->take(1)->toArray();

        //有此訂單
        if(count($order_table_arr) != 0){
            foreach($order_table_arr as $key=>$value){
                //取得購買資訊
                $order_table_arr = order_table::find($value['id'])->hotel_shoppings()->get()->toArray();

                foreach($order_table_arr as $value_2){
                    if($return_v!='') $return_v .= ',';

                    //取得金額資訊
                    $order_shopping_table_arr = order_shopping_table::find($value_2['pivot']['id'])->amounts()->get()->toArray();
                    foreach($order_shopping_table_arr as $value3){}

                    if($value_2['id']!='') $return_v .= $value_2['id'].':::'.$value_2['Store_Hotel_id'].':::'.$value_2['client_id'].':::'.$value_2['Room_name'].':::'.$value3['amount'].':::'.$value3['Currency'];
                    
                }
                dump('@!@'.$return_v.'@!@');
            }
        }else{
            dump('@!@無此訂單@!@');
        }
    }


    



    public function index()
    {
        // $array_v = array(1,2);      //原陣列值
        // $array_v = $this->array_txt(0,'A=>B','test',$array_v);  
        // dump($array_v);


        // $data_v = $this->Hypothetical_data();
        // dump($data_v);




        // $order_arr = order_table::all()->map(function($item){
        //     $add_arr = [];
        //     $add_arr['id'] = $item->id;
        //     $Type_txt = 'Type';       //組別開頭
        //     $NoType_txt = '無組別';    //無組別開頭
        //     $shopping_txt = '購物資料';
        //     $Amount_txt = '金額';   

        //     foreach($item->aviations as $key => $value){
        //         foreach($item->order_shopping_tables as $key2 => $value2){
        //             // dump($value2->pivot->Amount);
        //         }
                
        //         // dump($value);
        //         $class_v = classification::find($value->pivot->Type);
        //         // $this->array_txt(0,'無組別',$value);

        //         if($value->pivot->Group_number != ''){
        //             $num = 0;
                    
        //             $a_g_arr = $item->find($item->id)->order_shopping_tables()->find($value->pivot->Group_number)->toArray();
        //             $add_arr[$class_v->class_name][$Type_txt.$value->pivot->Group_number][$Amount_txt] = $a_g_arr['pivot']['Amount'];
                    
        //             //改陣列數字
        //             if(!empty($add_arr[$class_v->class_name][$Type_txt.$value->pivot->Group_number][$shopping_txt]))
        //                 $num = count($add_arr[$class_v->class_name][$Type_txt.$value->pivot->Group_number][$shopping_txt])-1;
                    
        //             $add_arr[$class_v->class_name][$Type_txt.$value->pivot->Group_number][$shopping_txt][$num] = $value->id;
                    
        //         }else{
        //             $num = 0;
        //             //改陣列數字
        //             if(!empty($add_arr[$class_v->class_name][$NoType_txt][$shopping_txt]))
        //                 $num = count($add_arr[$class_v->class_name][$NoType_txt][$shopping_txt]);

        //             $add_arr[$class_v->class_name][$NoType_txt][$shopping_txt][$num] = $value->id;
        //         }
        //     }

        //     $return_arr['訂單'.$item->number] = $add_arr;

        //     return $return_arr;
        // })->toArray();


        // $return_v['所有訂單'] = $order_arr;
        // dump($return_v);

        dump('從金額往回推出訂單ID↓↓↓---------------');
        //從金額資料表取資料
        $order2_arr = amount::all()->map(function($item){
            //金額資料表 => 金額 & (訂單&購買資訊) 中介資料表 => 訂單&購買資訊 中介 資料表
            foreach($item->order_shopping_tables as $key => $value){
              
              // 取金額資料表中ID = 2的資料，對應到的test為?
              if($item->id == '2'){
                dump('房間金額ID='.$item->id.',金額='.$item->amount.'元,對應的購買資訊ID='.$value->shopping_id.',test='.$value->test.',對應的訂單ID='.$value->Order_id);  //順便顯示一下金額確認
              }
                
            }
        })->toArray();
        












        
        dump('取得訂單001的金額資訊↓↓↓---------------');
        //取得訂單編號001的金額資訊
          $order_arr = order_shopping_table::all()->map(function($item){
            
            $orders = order_table::where('number', '=', 0001)->get();
            foreach ($orders as $order){}

            foreach($item->amounts as $key => $value){
                if($order->id == $item->Order_id){
                  dump('訂單ID='.$item->Order_id.',訂單&購買_id='.$item->id.',test='.$item->test.',房間金額ID='.$value->id.',金額='.$value->amount.'元');
                }
            }
          })->toArray();

        
        



    }


}