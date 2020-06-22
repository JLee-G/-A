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
use Requests;


class test24 extends Controller
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

        
        














          //----------------------XX
        //取得001訂單,的航空客戶的金額
        // $orders = order_table::where('number', '=', 001)->get();
        // foreach ($orders as $order){
        //     $order_shoppings = order_shopping_table::where('Order_id', '=', $order->id)->get();
        //     foreach($order_shoppings as $order_shopping){
        //         $aa = order_shopping_table::find($order_shopping->id)->clients_tables()->get()->toArray();
        //         dump($aa);
        //     }
        // }

        //取得訂單002總金額
        // $total_amount = 0;
        // $orders = order_table::where('number', '=', 002)->get();
        // foreach ($orders as $order){
        //     $order_shoppings = order_shopping_table::whereRaw("Order_id = ".$order->id." AND Group_number = '' ")->get();
        //     foreach($order_shoppings as $order_shopping){
        //         $aa = order_shopping_table::find($order_shopping->id)->clients_tables()->get()->toArray();
        //         foreach($aa as $key2 => $value2){
        //             $total_amount += $value2['Amount'];
        //             dump($value2['Amount']);
        //         }
        //     }
        //     foreach($order->order_shopping_tables as $key => $value){
        //         $total_amount += $value->pivot->Amount;
        //         dump($value->pivot->Amount);
        //     }
        // }
        // dump('總金額:'.$total_amount);
        //----------------------XX 

        //取得訂單001的航空公司資料
        // $orders = order_table::where('number', '=', 001)->get();
        // $a_s_id_arr = [];
        // foreach ($orders as $order){
        //     foreach($order->aviations as $value){
        //         // dump($value->aviation_supplier_id);
        //         array_unshift($a_s_id_arr, $value->aviation_supplier_id);	//添加陣列
        //     }
        // }
        // $a_ts = supplier_aviation::distinct()->select('aviation_id')->whereIn('id', $a_s_id_arr)->get();
        // foreach ($a_ts as $a_t){
        //     // dump($a_t->aviation_id);
        //     $a_cs = aviation_company::find($a_t->aviation_id);
        //     dump($a_cs->toArray());
        // }




        //有問題
        //Hotel Search
        //Hotel Search Offer information
        //Trip Parser Get Status
        //Trip Purpose Prediction
        //Seatmap Display

        //GET 取資料方式
        // $endpoint = "https://test.api.amadeus.com/v2/shopping/flight-offers?originLocationCode=SYD&destinationLocationCode=BKK&departureDate=2020-08-01&returnDate=2020-08-05&adults=2&includedAirlineCodes=TG&max=3";
        // $this->GetApi('',$endpoint);

        // //POST 取資料方式
        // $this->PostApi( "",
        //                 "https://test.api.amadeus.com/v1/booking/flight-orders",
        //                 "{\n  \"data\": {\n    \"type\": \"flight-order\",\n    \"flightOffers\": [\n      {\n        \"type\": \"flight-offer\",\n        \"id\": \"1\",\n        \"source\": \"GDS\",\n        \"instantTicketingRequired\": false,\n        \"nonHomogeneous\": false,\n        \"paymentCardRequired\": false,\n        \"lastTicketingDate\": \"2020-03-01\",\n        \"itineraries\": [\n          {\n            \"segments\": [\n              {\n                \"departure\": {\n                  \"iataCode\": \"GIG\",\n                  \"terminal\": \"2\",\n                  \"at\": \"2020-03-01T21:05:00\"\n                },\n                \"arrival\": {\n                  \"iataCode\": \"CDG\",\n                  \"terminal\": \"2E\",\n                  \"at\": \"2020-03-02T12:20:00\"\n                },\n                \"carrierCode\": \"KL\",\n                \"number\": \"2410\",\n                \"aircraft\": {\n                  \"code\": \"772\"\n                },\n                \"operating\": {\n                  \"carrierCode\": \"AF\"\n                },\n                \"duration\": \"PT11H15M\",\n                \"id\": \"40\",\n                \"numberOfStops\": 0\n              },\n              {\n                \"departure\": {\n                  \"iataCode\": \"CDG\",\n                  \"terminal\": \"2F\",\n                  \"at\": \"2020-03-02T14:30:00\"\n                },\n                \"arrival\": {\n                  \"iataCode\": \"AMS\",\n                  \"at\": \"2020-03-02T15:45:00\"\n                },\n                \"carrierCode\": \"KL\",\n                \"number\": \"1234\",\n                \"aircraft\": {\n                  \"code\": \"73H\"\n                },\n                \"operating\": {\n                  \"carrierCode\": \"KL\"\n                },\n                \"duration\": \"PT1H15M\",\n                \"id\": \"41\",\n                \"numberOfStops\": 0\n              },\n              {\n                \"departure\": {\n                  \"iataCode\": \"AMS\",\n                  \"at\": \"2020-03-02T17:05:00\"\n                },\n                \"arrival\": {\n                  \"iataCode\": \"MAD\",\n                  \"terminal\": \"2\",\n                  \"at\": \"2020-03-02T19:35:00\"\n                },\n                \"carrierCode\": \"KL\",\n                \"number\": \"1705\",\n                \"aircraft\": {\n                  \"code\": \"73J\"\n                },\n                \"operating\": {\n                  \"carrierCode\": \"KL\"\n                },\n                \"duration\": \"PT2H30M\",\n                \"id\": \"42\",\n                \"numberOfStops\": 0\n              }\n            ]\n          },\n          {\n            \"segments\": [\n              {\n                \"departure\": {\n                  \"iataCode\": \"MAD\",\n                  \"terminal\": \"2\",\n                  \"at\": \"2020-03-05T20:25:00\"\n                },\n                \"arrival\": {\n                  \"iataCode\": \"AMS\",\n                  \"at\": \"2020-03-05T23:00:00\"\n                },\n                \"carrierCode\": \"KL\",\n                \"number\": \"1706\",\n                \"aircraft\": {\n                  \"code\": \"73J\"\n                },\n                \"operating\": {\n                  \"carrierCode\": \"KL\"\n                },\n                \"duration\": \"PT2H35M\",\n                \"id\": \"81\",\n                \"numberOfStops\": 0\n              },\n              {\n                \"departure\": {\n                  \"iataCode\": \"AMS\",\n                  \"at\": \"2020-03-06T10:40:00\"\n                },\n                \"arrival\": {\n                  \"iataCode\": \"GIG\",\n                  \"terminal\": \"2\",\n                  \"at\": \"2020-03-06T18:35:00\"\n                },\n                \"carrierCode\": \"KL\",\n                \"number\": \"705\",\n                \"aircraft\": {\n                  \"code\": \"772\"\n                },\n                \"operating\": {\n                  \"carrierCode\": \"KL\"\n                },\n                \"duration\": \"PT11H55M\",\n                \"id\": \"82\",\n                \"numberOfStops\": 0\n              }\n            ]\n          }\n        ],\n        \"price\": {\n          \"currency\": \"USD\",\n          \"total\": \"8514.96\",\n          \"base\": \"8314.00\",\n          \"fees\": [\n            {\n              \"amount\": \"0.00\",\n              \"type\": \"SUPPLIER\"\n            },\n            {\n              \"amount\": \"0.00\",\n              \"type\": \"TICKETING\"\n            },\n            {\n              \"amount\": \"0.00\",\n              \"type\": \"FORM_OF_PAYMENT\"\n            }\n          ],\n          \"grandTotal\": \"8514.96\",\n          \"billingCurrency\": \"USD\"\n        },\n        \"pricingOptions\": {\n          \"fareType\": [\n            \"PUBLISHED\"\n          ],\n          \"includedCheckedBagsOnly\": true\n        },\n        \"validatingAirlineCodes\": [\n          \"AF\"\n        ],\n        \"travelerPricings\": [\n          {\n            \"travelerId\": \"1\",\n            \"fareOption\": \"STANDARD\",\n            \"travelerType\": \"ADULT\",\n            \"price\": {\n              \"currency\": \"USD\",\n              \"total\": \"4849.48\",\n              \"base\": \"4749.00\",\n              \"taxes\": [\n                {\n                  \"amount\": \"31.94\",\n                  \"code\": \"BR\"\n                },\n                {\n                  \"amount\": \"14.68\",\n                  \"code\": \"CJ\"\n                },\n                {\n                  \"amount\": \"5.28\",\n                  \"code\": \"FR\"\n                },\n                {\n                  \"amount\": \"17.38\",\n                  \"code\": \"JD\"\n                },\n                {\n                  \"amount\": \"0.69\",\n                  \"code\": \"OG\"\n                },\n                {\n                  \"amount\": \"3.95\",\n                  \"code\": \"QV\"\n                },\n                {\n                  \"amount\": \"12.12\",\n                  \"code\": \"QX\"\n                },\n                {\n                  \"amount\": \"14.44\",\n                  \"code\": \"RN\"\n                }\n              ]\n            },\n            \"fareDetailsBySegment\": [\n              {\n                \"segmentId\": \"40\",\n                \"cabin\": \"BUSINESS\",\n                \"fareBasis\": \"CFFBR\",\n                \"brandedFare\": \"BUSINESS\",\n                \"class\": \"C\",\n                \"includedCheckedBags\": {\n                  \"quantity\": 2\n                }\n              },\n              {\n                \"segmentId\": \"41\",\n                \"cabin\": \"BUSINESS\",\n                \"fareBasis\": \"CFFBR\",\n                \"brandedFare\": \"BUSINESS\",\n                \"class\": \"J\",\n                \"includedCheckedBags\": {\n                  \"quantity\": 2\n                }\n              },\n              {\n                \"segmentId\": \"42\",\n                \"cabin\": \"BUSINESS\",\n                \"fareBasis\": \"CFFBR\",\n                \"brandedFare\": \"BUSINESS\",\n                \"class\": \"J\",\n                \"includedCheckedBags\": {\n                  \"quantity\": 2\n                }\n              },\n              {\n                \"segmentId\": \"81\",\n                \"cabin\": \"ECONOMY\",\n                \"fareBasis\": \"YFFBR\",\n                \"brandedFare\": \"FULLFLEX\",\n                \"class\": \"Y\",\n                \"includedCheckedBags\": {\n                  \"quantity\": 1\n                }\n              },\n              {\n                \"segmentId\": \"82\",\n                \"cabin\": \"ECONOMY\",\n                \"fareBasis\": \"YFFBR\",\n                \"brandedFare\": \"FULLFLEX\",\n                \"class\": \"Y\",\n                \"includedCheckedBags\": {\n                  \"quantity\": 1\n                }\n              }\n            ]\n          },\n          {\n            \"travelerId\": \"2\",\n            \"fareOption\": \"STANDARD\",\n            \"travelerType\": \"CHILD\",\n            \"price\": {\n              \"currency\": \"USD\",\n              \"total\": \"3665.48\",\n              \"base\": \"3565.00\",\n              \"taxes\": [\n                {\n                  \"amount\": \"31.94\",\n                  \"code\": \"BR\"\n                },\n                {\n                  \"amount\": \"14.68\",\n                  \"code\": \"CJ\"\n                },\n                {\n                  \"amount\": \"5.28\",\n                  \"code\": \"FR\"\n                },\n                {\n                  \"amount\": \"17.38\",\n                  \"code\": \"JD\"\n                },\n                {\n                  \"amount\": \"0.69\",\n                  \"code\": \"OG\"\n                },\n                {\n                  \"amount\": \"3.95\",\n                  \"code\": \"QV\"\n                },\n                {\n                  \"amount\": \"12.12\",\n                  \"code\": \"QX\"\n                },\n                {\n                  \"amount\": \"14.44\",\n                  \"code\": \"RN\"\n                }\n              ]\n            },\n            \"fareDetailsBySegment\": [\n              {\n                \"segmentId\": \"40\",\n                \"cabin\": \"BUSINESS\",\n                \"fareBasis\": \"CFFBR\",\n                \"brandedFare\": \"BUSINESS\",\n                \"class\": \"C\",\n                \"includedCheckedBags\": {\n                  \"quantity\": 2\n                }\n              },\n              {\n                \"segmentId\": \"41\",\n                \"cabin\": \"BUSINESS\",\n                \"fareBasis\": \"CFFBR\",\n                \"brandedFare\": \"BUSINESS\",\n                \"class\": \"J\",\n                \"includedCheckedBags\": {\n                  \"quantity\": 2\n                }\n              },\n              {\n                \"segmentId\": \"42\",\n                \"cabin\": \"BUSINESS\",\n                \"fareBasis\": \"CFFBR\",\n                \"brandedFare\": \"BUSINESS\",\n                \"class\": \"J\",\n                \"includedCheckedBags\": {\n                  \"quantity\": 2\n                }\n              },\n              {\n                \"segmentId\": \"81\",\n                \"cabin\": \"ECONOMY\",\n                \"fareBasis\": \"YFFBR\",\n                \"brandedFare\": \"FULLFLEX\",\n                \"class\": \"Y\",\n                \"includedCheckedBags\": {\n                  \"quantity\": 1\n                }\n              },\n              {\n                \"segmentId\": \"82\",\n                \"cabin\": \"ECONOMY\",\n                \"fareBasis\": \"YFFBR\",\n                \"brandedFare\": \"FULLFLEX\",\n                \"class\": \"Y\",\n                \"includedCheckedBags\": {\n                  \"quantity\": 1\n                }\n              }\n            ]\n          }\n        ]\n      }\n    ],\n    \"travelers\": [\n      {\n        \"id\": \"1\",\n        \"dateOfBirth\": \"1982-01-16\",\n        \"name\": {\n          \"firstName\": \"JORGE\",\n          \"lastName\": \"GONZALES\"\n        },\n        \"gender\": \"MALE\",\n        \"contact\": {\n          \"emailAddress\": \"jorge.gonzales833@telefonica.es\",\n          \"phones\": [\n            {\n              \"deviceType\": \"MOBILE\",\n              \"countryCallingCode\": \"34\",\n              \"number\": \"480080076\"\n            }\n          ]\n        },\n        \"documents\": [\n          {\n            \"documentType\": \"PASSPORT\",\n            \"birthPlace\": \"Madrid\",\n            \"issuanceLocation\": \"Madrid\",\n            \"issuanceDate\": \"2015-04-14\",\n            \"number\": \"00000000\",\n            \"expiryDate\": \"2025-04-14\",\n            \"issuanceCountry\": \"ES\",\n            \"validityCountry\": \"ES\",\n            \"nationality\": \"ES\",\n            \"holder\": true\n          }\n        ]\n      },\n      {\n        \"id\": \"2\",\n        \"dateOfBirth\": \"2012-10-11\",\n        \"gender\": \"FEMALE\",\n        \"contact\": {\n          \"emailAddress\": \"jorge.gonzales833@telefonica.es\",\n          \"phones\": [\n            {\n              \"deviceType\": \"MOBILE\",\n              \"countryCallingCode\": \"34\",\n              \"number\": \"480080076\"\n            }\n          ]\n        },\n        \"name\": {\n          \"firstName\": \"ADRIANA\",\n          \"lastName\": \"GONZALES\"\n        }\n      }\n    ],\n    \"remarks\": {\n      \"general\": [\n        {\n          \"subType\": \"GENERAL_MISCELLANEOUS\",\n          \"text\": \"ONLINE BOOKING FROM INCREIBLE VIAJES\"\n        }\n      ]\n    },\n    \"ticketingAgreement\": {\n      \"option\": \"DELAY_TO_CANCEL\",\n      \"delay\": \"6D\"\n    },\n    \"contacts\": [\n      {\n        \"addresseeName\": {\n          \"firstName\": \"PABLO\",\n          \"lastName\": \"RODRIGUEZ\"\n        },\n        \"companyName\": \"INCREIBLE VIAJES\",\n        \"purpose\": \"STANDARD\",\n        \"phones\": [\n          {\n            \"deviceType\": \"LANDLINE\",\n            \"countryCallingCode\": \"34\",\n            \"number\": \"480080071\"\n          },\n          {\n            \"deviceType\": \"MOBILE\",\n            \"countryCallingCode\": \"33\",\n            \"number\": \"480080072\"\n          }\n        ],\n        \"emailAddress\": \"support@increibleviajes.es\",\n        \"address\": {\n          \"lines\": [\n            \"Calle Prado, 16\"\n          ],\n          \"postalCode\": \"28014\",\n          \"cityName\": \"Madrid\",\n          \"countryCode\": \"ES\"\n        }\n      }\n    ]\n  }\n}");


    }

    //GET取得資料方法
    public function GetApi($access_token='',$endpoint=''){

        if(!empty($access_token)){
            $curl = curl_init();    //初始化cURL

            //查令牌訊息用
            if(strpos($endpoint,'token') !== false){
                $endpoint = $endpoint.'/'.$access_token;
            }

            //cURL設置選項
            curl_setopt_array($curl, array(
            CURLOPT_URL => $endpoint,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "Authorization:Bearer $access_token",
            ),
            ));

            $response = curl_exec($curl);   //執行cURL

            curl_close($curl);  //關閉cURL
            echo $response;
        }else{
            $this->GetToken($endpoint,'GET');
        }
    }

    //POST取得資料方法
    public function PostApi($access_token='', $endpoint='',$BODY_raw=''){

        if(!empty($access_token)){
            $curl = curl_init();    //初始化cURL

            //cURL設置選項
            curl_setopt_array($curl, array(
                CURLOPT_URL => $endpoint,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS =>$BODY_raw,
                CURLOPT_HTTPHEADER => array(
                    "Content-Type: application/json",
                    "Authorization:Bearer $access_token",
                ),
            ));
            
            $response = curl_exec($curl);   //執行cURL
            
            curl_close($curl);  //關閉cURL
            echo $response;
        }else{
            $this->GetToken($endpoint,'POST',$BODY_raw);
        }
    }

    //取得令牌方法
    public function GetToken($endpoint='',$method='',$BODY_raw=''){
        //取得令牌
        $curl = curl_init();    //初始化cURL

        //cURL設置選項
        curl_setopt_array($curl, array(
        CURLOPT_URL => "https://test.api.amadeus.com/v1/security/oauth2/token",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => "client_id=jOvmYHChfBjSzvljPAYdEnN5elkjS0Nh&client_secret=wcVidPfRV2iqywFb&grant_type=client_credentials",
        ));

        $response = curl_exec($curl);   //執行cURL

        curl_close($curl);  //關閉cURL

        $response_j = json_decode($response);   //處理JSON轉為變數資料以便程式處理
        $access_token = $response_j->access_token;
        
        //傳給GET或POST方法
        if($method == 'GET')
            $this->GetApi($access_token,$endpoint);
        else if($method == 'POST')
            $this->PostApi($access_token,$endpoint,$BODY_raw);
    }

    public function Hypothetical_data(){
        $txt_v = '{
            “數據”{
              “ type”“飛行順序”，
              “ id”“ MlpZVkFMfFdBVFNPTnwyMDE1LTExLTAy”，
              “ queuingOfficeId”“ NCE1A0950”，
              “ associatedRecords”[
                {
                  “ reference”“ 2ZYVAL”，
                  “ creationDateTime”“ 2018-07-13T201700”，
                  “ originSystemCode”“ 1A”，
                  “ flightOfferId”“ 1”
                }
              ]，
              “旅行者”[
                {
                  “ id”“ 1”，
                  “ dateOfBirth”“ 1982-01-16”，
                  “名稱” {
                    “ firstName”“ STEPHANE”，
                    “ lastName”“ MARTIN”
                  }，
                  “聯繫” {
                    “電話”[
                      {
                        “ countryCallingCode”“ 33”，
                        “ number”“ 487692704”
                      }
                    ]
                  }，
                  “文檔”[
                    {
                      “ documentType”“ PASSPORT”，
                      “ number”“ 012345678”，
                      “ expiryDate”“ 2009-04-14”，
                      “ issuanceCountry”“ GB”，
                      “國籍”“ GB”，
                      “持有人”true
                    }
                  ]
                }，
                {
                  “ id”“ 3”，
                  “ dateOfBirth”“ 2018-03-24”，
                  “名稱” {
                    “ firstName”“ JULES”，
                    “ lastName”“ MARTIN”
                  }
                }，
                {
                  “ id”“ 2”，
                  “ dateOfBirth”“ 2007-10-11”，
                  “名稱” {
                    “ firstName”“ EMILIE”，
                    “ lastName”“ MARTIN”
                  }
                }
              ]，
              “航班優惠”[
                {
                  “ id”“ 1”，
                  “ type”“航班優惠”，
                  “來源”“ GDS”，
                  “入門人員”[
                    {
                      “持續時間”“ PT2H”，
                      “細分”[
                        {
                          “ id”“ 1”，
                          “持續時間”“ PT2H”，
                          “飛機” {
                            “代碼”“ 320”
                          }，
                          “ numberOfStops”0，
                          “ blacklistedInEU”否，
                          “ carrierCode”“ IB”，
                          “運營中”{
                            “ carrierCode”“ IB”
                          }，
                          “ number”“ 3403”，
                          “出發”{
                            “ at”“ 2018-09-22T101500”，
                            “ terminal”“ W”，
                            “ iataCode”“ ORY”
                          }，
                          “到達”{
                            “ at”“ 2018-09-22T121500”，
                            “ terminal”“ 4”，
                            “ iataCode”“ MAD”
                          }，
                          “二氧化碳排放量”[
                            {
                              “ weight”“ 100”，
                              “ weightUnit”“ KG”，
                              “客艙”“經濟”
                            }
                          ]
                        }
                      ]
                    }，
                    {
                      “持續時間”“ PT1H20M”，
                      “細分”[
                        {
                          “ id”“ 20”，
                          “持續時間”“ PT1H20M”，
                          “飛機” {
                            “代碼”“ 320”
                          }，
                          “ numberOfStops”0，
                          “ blacklistedInEU”否，
                          “ carrierCode”“ IB”，
                          “運營中”{
                            “ carrierCode”“ IB”
                          }，
                          “ number”“ 3118”，
                          “出發”{
                            “ at”“ 2018-09-26T230500”，
                            “ terminal”“ 4”，
                            “ iataCode”“ MAD”
                          }，
                          “到達”{
                            “ at”“ 2018-09-26T232500”，
                            “1號航站樓”，
                            “ iataCode”“ LIS”
                          }，
                          “二氧化碳排放量”[
                            {
                              “ weight”“ 100”，
                              “ weightUnit”“ KG”，
                              “客艙”“經濟”
                            }
                          ]
                        }
                      ]
                    }，
                    {
                      “持續時間”“ PT4H30M”，
                      “細分”[
                        {
                          “ id”“ 30”，
                          “持續時間”“ PT2H”，
                          “飛機” {
                            “代碼”“ 320”
                          }，
                          “ numberOfStops”0，
                          “ blacklistedInEU”否，
                          “ carrierCode”“ IB”，
                          “運營中”{
                            “ carrierCode”“ IB”
                          }，
                          “ number”“ 3109”，
                          “出發”{
                            “ at”“ 2018-10-04T123500”，
                            “1號航站樓”，
                            “ iataCode”“ LIS”
                          }，
                          “到達”{
                            “ at”“ 2018-10-04T145500”，
                            “ terminal”“ 4”，
                            “ iataCode”“ MAD”
                          }，
                          “二氧化碳排放量”[
                            {
                              “ weight”“ 100”，
                              “ weightUnit”“ KG”，
                              “客艙”“經濟”
                            }
                          ]
                        }，
                        {
                          “ id”“ 31”，
                          “持續時間”“ PT2H30M”，
                          “飛機” {
                            “代碼”“ 320”
                          }，
                          “ numberOfStops”0，
                          “ blacklistedInEU”否，
                          “ carrierCode”“ IB”，
                          “運營中”{
                            “ carrierCode”“ IB”
                          }，
                          “ number”“ 3444”，
                          “出發”{
                            “ at”“ 2018-10-04T160500”，
                            “ terminal”“ 4”，
                            “ iataCode”“ MAD”
                          }，
                          “到達”{
                            “ at”“ 2018-10-04T180500”，
                            “ terminal”“ W”，
                            “ iataCode”“ ORY”
                          }，
                          “二氧化碳排放量”[
                            {
                              “ weight”“ 100”，
                              “ weightUnit”“ KG”，
                              “客艙”“經濟”
                            }
                          ]
                        }
                      ]
                    }
                  ]，
                  “價錢” {
                    “ grandTotal”“ 689.21”，
                    “ total”“ 423.21”，
                    “ base”“ 242.00”，
                    “ currency”“ EUR”，
                    “ billingCurrency”“ EUR”，
                    “費用” [
                      {
                        “ type”“供應商”，
                        “數量”“ 0”
                      }，
                      {
                        “ type”“ FORM_OF_PAYMENT”，
                        “數量”“ 6”
                      }，
                      {
                        “ type”“ TICKETING”，
                        “數量”“ 0”
                      }
                    ]，
                    “額外服務” [
                      {
                        “ type”“ CHECKED_BAGS”，
                        “數量”“ 100”
                      }，
                      {
                        “ type”“ SEATS”，
                        “ amount”“ 166”
                      }
                    ]
                  }，
                  “ pricingOptions”{
                    “ fareType”[
                      “已協商”，
                      “公司”
                    ]，
                    “ corporateCodes”[
                      “ 123456”
                    ]，
                    “ includedCheckedBags”false
                  }，
                  “ validatingAirlineCodes”[
                    “ IB”
                  ]，
                  “ travelerPricings”[
                    {
                      “ travelerId”“ 1”，
                      “ fareOption”“ STANDARD”，
                      “ travelerType”“ ADULT”，
                      “價錢” {
                        “ currency”“ EUR”，
                        “ total”“ 200.94”，
                        “ base”“ 126”，
                        “稅金”[
                          {
                            “ code”“ YQ”，
                            “數量”“ 0.94”
                          }，
                          {
                            “ code”“ CJ”，
                            “ amount”“ 41.67”
                          }，
                          {
                            “ code”“ FR”，
                            “ amount”“ 31.33”
                          }
                        ]
                      }，
                      “ fareDetailsBySegment”[
                        {
                          “ segmentId”“ 1”，
                          “客艙”“經濟”，
                          “ fareBasis”“ ANNNNF4K”，
                          “ brandedFare”“ LIGHTONE”，
                          “ class”“ A”，
                          “ isAllotment”是的，
                          “ allotmentDetails”{
                            “ tourName”“遊覽”，
                            “ tourReference”“參考”
                          }，
                          “ sliceDiceIndicator”“ ABCDEF”，
                          “ includedCheckedBags”{
                            “數量”0
                          }
                        }，
                        {
                          “ segmentId”“ 20”，
                          “客艙”“經濟”，
                          “ fareBasis”“ ANNNNF4K”，
                          “ brandedFare”“ LIGHTONE”，
                          “ class”“ A”，
                          “ isAllotment”是的，
                          “ allotmentDetails”{
                            “ tourName”“遊覽”，
                            “ tourReference”“參考”
                          }，
                          “ sliceDiceIndicator”“ ABCDEF”，
                          “ includedCheckedBags”{
                            “數量”0
                          }
                        }，
                        {
                          “ segmentId”“ 30”，
                          “客艙”“經濟”，
                          “ fareBasis”“ ANNNNF4K”，
                          “ brandedFare”“ LIGHTONE”，
                          “ class”“ A”，
                          “ isAllotment”是的，
                          “ allotmentDetails”{
                            “ tourName”“遊覽”，
                            “ tourReference”“參考”
                          }，
                          “ sliceDiceIndicator”“ ABCDEF”，
                          “ includedCheckedBags”{
                            “數量”0
                          }
                        }，
                        {
                          “ segmentId”“ 31”，
                          “客艙”“經濟”，
                          “ fareBasis”“ ANNNNF4K”，
                          “ brandedFare”“ LIGHTONE”，
                          “ class”“ A”，
                          “ isAllotment”是的，
                          “ allotmentDetails”{
                            “ tourName”“遊覽”，
                            “ tourReference”“參考”
                          }，
                          “ sliceDiceIndicator”“ ABCDEF”，
                          “ includedCheckedBags”{
                            “數量”0
                          }
                        }
                      ]
                    }，
                    {
                      “ travelerId”“ 2”，
                      “ fareOption”“ STANDARD”，
                      “ travelerType”“兒童”，
                      “價錢” {
                        “ currency”“ EUR”，
                        “ total”“ 180.94”，
                        “ base”“ 106”，
                        “稅金”[
                          {
                            “ code”“ YQ”，
                            “數量”“ 0.94”
                          }，
                          {
                            “ code”“ CJ”，
                            “ amount”“ 41.67”
                          }，
                          {
                            “ code”“ FR”，
                            “ amount”“ 31.33”
                          }
                        ]
                      }，
                      “ fareDetailsBySegment”[
                        {
                          “ segmentId”“ 1”，
                          “客艙”“經濟”，
                          “ fareBasis”“ ANNNNF4K”，
                          “ brandedFare”“ LIGHTONE”，
                          “ class”“ A”，
                          “ isAllotment”是的，
                          “ allotmentDetails”{
                            “ tourName”“遊覽”，
                            “ tourReference”“參考”
                          }，
                          “ sliceDiceIndicator”“ ABCDEF”，
                          “ includedCheckedBags”{
                            “數量”0
                          }，
                          “額外服務” {
                            “ chargeableCheckedBags”{
                              “數量”1，
                              “重量”20
                            }，
                            “ chargeableSeatNumber”“ 33D”
                          }
                        }，
                        {
                          “ segmentId”“ 20”，
                          “客艙”“經濟”，
                          “ fareBasis”“ ANNNNF4K”，
                          “ brandedFare”“ LIGHTONE”，
                          “ class”“ A”，
                          “ isAllotment”是的，
                          “ allotmentDetails”{
                            “ tourName”“遊覽”，
                            “ tourReference”“參考”
                          }，
                          “ sliceDiceIndicator”“ ABCDEF”，
                          “ includedCheckedBags”{
                            “數量”0
                          }，
                          “額外服務” {
                            “ chargeableCheckedBags”{
                              “數量”1，
                              “重量”20
                            }，
                            “ chargeableSeatNumber”“ 28A”
                          }
                        }，
                        {
                          “ segmentId”“ 30”，
                          “客艙”“經濟”，
                          “ fareBasis”“ ANNNNF4K”，
                          “ brandedFare”“ LIGHTONE”，
                          “ class”“ A”，
                          “ isAllotment”是的，
                          “ allotmentDetails”{
                            “ tourName”“遊覽”，
                            “ tourReference”“參考”
                          }，
                          “ sliceDiceIndicator”“ ABCDEF”，
                          “ includedCheckedBags”{
                            “數量”0
                          }，
                          “額外服務” {
                            “ chargeableCheckedBags”{
                              “數量”1，
                              “重量”20
                            }，
                            “ chargeableSeatNumber”“ 12C”
                          }
                        }，
                        {
                          “ segmentId”“ 31”，
                          “客艙”“經濟”，
                          “ fareBasis”“ ANNNNF4K”，
                          “ brandedFare”“ LIGHTONE”，
                          “ class”“ A”，
                          “ isAllotment”是的，
                          “ allotmentDetails”{
                            “ tourName”“遊覽”，
                            “ tourReference”“參考”
                          }，
                          “ sliceDiceIndicator”“ ABCDEF”，
                          “ includedCheckedBags”{
                            “數量”0
                          }，
                          “額外服務” {
                            “ chargeableCheckedBags”{
                              “數量”1，
                              “重量”20
                            }，
                            “ chargeableSeatNumber”“ 33D”
                          }
                        }
                      ]
                    }，
                    {
                      “ travelerId”“ 3”，
                      “ fareOption”“ STANDARD”，
                      “ travelerType”“ HELD_INFANT”，
                      “ associatedAdultId”“ 1”，
                      “價錢” {
                        “ currency”“ EUR”，
                        “ total”“ 41.33”，
                        “ base”“ 10”，
                        “稅金”[
                          {
                            “ code”“ FR”，
                            “ amount”“ 31.33”
                          }
                        ]
                      }，
                      “ fareDetailsBySegment”[
                        {
                          “ segmentId”“ 1”，
                          “客艙”“經濟”，
                          “ fareBasis”“ ANNNNF4K”，
                          “ brandedFare”“ LIGHTONE”，
                          “ class”“ A”，
                          “ isAllotment”是的，
                          “ allotmentDetails”{
                            “ tourName”“遊覽”，
                            “ tourReference”“參考”
                          }，
                          “ sliceDiceIndicator”“ ABCDEF”，
                          “ includedCheckedBags”{
                            “數量”0
                          }
                        }，
                        {
                          “ segmentId”“ 20”，
                          “客艙”“經濟”，
                          “ fareBasis”“ ANNNNF4K”，
                          “ brandedFare”“ LIGHTONE”，
                          “ class”“ A”，
                          “ isAllotment”是的，
                          “ allotmentDetails”{
                            “ tourName”“遊覽”，
                            “ tourReference”“參考”
                          }，
                          “ sliceDiceIndicator”“ ABCDEF”，
                          “ includedCheckedBags”{
                            “數量”0
                          }
                        }，
                        {
                          “ segmentId”“ 30”，
                          “客艙”“經濟”，
                          “ fareBasis”“ ANNNNF4K”，
                          “ brandedFare”“ LIGHTONE”，
                          “ class”“ A”，
                          “ isAllotment”是的，
                          “ allotmentDetails”{
                            “ tourName”“遊覽”，
                            “ tourReference”“參考”
                          }，
                          “ sliceDiceIndicator”“ ABCDEF”，
                          “ includedCheckedBags”{
                            “數量”0
                          }
                        }，
                        {
                          “ segmentId”“ 31”，
                          “客艙”“經濟”，
                          “ fareBasis”“ ANNNNF4K”，
                          “ brandedFare”“ LIGHTONE”，
                          “ class”“ A”，
                          “ isAllotment”是的，
                          “ allotmentDetails”{
                            “ tourName”“遊覽”，
                            “ tourReference”“參考”
                          }，
                          “ sliceDiceIndicator”“ ABCDEF”，
                          “ includedCheckedBags”{
                            “數量”0
                          }
                        }
                      ]
                    }
                  ]
                }
              ]，
              “ ticketingAggreement”{
                “ option”“ DELAY_TO_CANCEL”，
                “ dateTime”“ 2018-08-21T101500.000”
              }，
              “聯繫人”[
                {
                  “ companyName”“ AMADEUS”，
                  “目的”“標準”，
                  “電話”[
                    {
                      “ deviceType”“ FAX”，
                      “ countryCallingCode”“ 33”，
                      “數字”“ 480080070”
                    }，
                    {
                      “ deviceType”“ LANDLINE”，
                      “ countryCallingCode”“ 33”，
                      “數字”“ 480080070”
                    }
                  ]，
                  “ emailAddress”“ support@mail.com”，
                  “地址” {
                    “行”[
                      “ 485路線杜平蒙塔德”
                    ]，
                    “ postalCode”“ 06902”，
                    “ cityName”“ Sophia Antipolis Cedex”，
                    “ countryCode”“ FR”
                  }
                }
              ]
            }，
            “字典”{
              “位置”{
                “ CDG”{
                  “ cityCode”“ PAR”，
                  “ countryCode”“ FR”
                }，
                “ ORY”{
                  “ cityCode”“ PAR”，
                  “ countryCode”“ FR”
                }，
                “ MAD”{
                  “ cityCode”“ MAD”，
                  “ countryCode”“ ES”
                }
              }
            }
          }';

        $return_v = json_decode($txt_v);
        return $txt_v;
    }

}