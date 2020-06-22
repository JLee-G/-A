<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>首頁</title>
    <script language='javascript' src='{{ asset('setup/admin/js/setting.js') }}'></script>

    <!--日期選擇器-->
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="/resources/demos/style.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script>
        $( function() {
            $('.date').datepicker({
                dateFormat: 'yy-mm-dd',
            });       
        });
    </script>    
    <!--日期選擇器-->
    
</head>
<body>
    測試用：
    <hr />
    [新增訂單]
    選擇購買的東西：
    <label>機票<input type="checkbox" name="Check_value[]" value="1"></label>
    <label>飯店<input type="checkbox" name="Check_value[]" value="2"></label>
    <label>票券<input type="checkbox" name="Check_value[]" value="3"></label>

    <hr />
    選擇購買客戶
    <hr />
    [機票購買所需填寫資訊]
    所包含客戶、航空公司、單程/來回、啟程地、
    目的地、出發日期、搭乘成人、搭乘小孩、搭乘老人、航班
    機型、出發時間、到達時間
    <hr />
    [飯店訂房所需填寫資訊]
    所包含客戶、飯店名稱、房間數量、入住時間、退房時間
    <hr />
    [票券購買所需填寫資訊]
    票券公司名稱、數量
    <br />
    <button>送出</button>
    <hr />
    [新增客戶]
    <form method="post" action="{{ url('/New_customer') }}">
        {{ csrf_field() }}
        <p>客戶名稱<input type='text' name="name" autocomplete="off"></p>
        <p>英文姓名<input type='text' name="name_en" autocomplete="off"></p>
        <p>客戶性別<input type='text' name="gender" autocomplete="off"></p>
        <p>地址<input type='text' name="address" autocomplete="off"></p>
        <p>生日<input type="text" class="date" name="birthday" ></p>
        <p>電話<input type='text' name="phone" autocomplete="off"></p>
        <p>電話國家地區代碼<input type='text' name="Telephone_country_code" autocomplete="off"></p>
        <p>電話區碼<input type='text' name="Telephone_area_code" autocomplete="off"></p>
        <p>電話分機<input type='text' name="Extension" autocomplete="off"></p>
        <p>手機<input type='text' name="Cell_phone" autocomplete="off"></p>
        <p>信箱<input type='email' name="Emain" autocomplete="off"></p>
        <!--全部錯誤訊息-->
        @if ($errors->any())
            @foreach ($errors->all() as $error)
                [{{ $error }}]
            @endforeach
        @endif

        <button>送出</button>
    </form>
    <hr />
    [新增航空公司]
    公司名稱、英文名稱、電話、電話2、地址、傳真、信箱、網址
    <hr />
    [新增飯店]
    公司名稱、英文名稱、星級、電話、電話2、地址、傳真、信箱、網址
    <hr />
    [新增票券公司]
    公司名稱、英文名稱、電話、電話2、地址、傳真、信箱、網址
    <hr />
    [新增供應商]
    公司名稱、英文名稱、電話、電話2、地址、傳真、信箱、網址、
    統一編號、聯絡人、聯絡人電話、聯絡人手機、聯絡人職稱、收款銀行、
    銀行代碼、分行名稱、銀行帳戶

    
</body>
</html>