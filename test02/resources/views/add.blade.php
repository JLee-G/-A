<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script language='javascript' src='{{ asset('test/js/test01.js') }}'></script>
    <title>新增資料用頁面</title>
</head>
<body>
<span style="color:blue;" onclick="Show(1)">新增飯店：</span>
<div id="Show_1" style="display:none">
    <form method="post" action="{{ url('/hotel_add') }}">
        {{ csrf_field() }}
        1.選擇新增飯店的供應商：
        <select name="supplier_id" id="supplier_id" required="required" >
            <option value="">無</option>
            @foreach($supplier_all as $key => $value)
                <option value="{{$value['id']}}" >{{$value['name']}}</option>
            @endforeach
        </select>
        <br />
        2.新增飯店：<input type='text' name="hotel" id="hotel" value="" required="required" >
        <button>送出</button>
    </form>
</div>

<br/>


<span style="color:blue;" onclick="Show(2)">新增房間：</span>
<div id="Show_2" style="display:none">

    <form method="post" action="{{ url('/room_add') }}">
        {{ csrf_field() }}

        1.選擇新增飯店的供應商：
        <select name="supplier_id" id="supplier_id" onchange="ShowH('{{ csrf_token() }}', this.value)" required="required" >
            <option value="">無</option>
            @foreach($supplier_all as $key => $value)
                <option value="{{$value['id']}}" >{{$value['name']}}</option>
            @endforeach
        </select>
        <br />

        2.選擇飯店：
        <select name="hotel_Options" id="hotel_Options" required="required" ></select>
        <br />

        3.輸入房間資訊：<input type='text' name="room_test" id="room_test" value="" required="required" >
        金額：<input type='text' name="amount" id="amount" value="" required="required" >
        幣別：
        <select name="currency" id="currency" required="required" >
            <option value="">無</option>
            @foreach($currency_all as $key => $value)
                <option value="{{$value['name']}}" >{{$value['name']}}</option>
            @endforeach
        </select>
        <button>送出</button>
    </form>
</div>

<br/>

<span style="color:blue;" onclick="Show(9)">新增訂單：</span>
<div id="Show_9" style="display:none">
    1.選擇飯店：
    <select name="hotel_id" id="hotel_id" onchange="ShowR('{{ csrf_token() }}', this.value)" required="required" >
        <option value="">無</option>
        @foreach($hotel_all as $key => $value)
            <option value="{{$value['id']}}" >{{$value['name']}}</option>
        @endforeach
    </select>
    <br />

    2.挑選飯店房間：
    <select name="Room_Options" id="Room_Options" required="required" onchange="ShowA('{{ csrf_token() }}', this.value)" ></select>
    <br />

    <span id="test_9"></span>
    <br />
    確認送出：
</div>

<br/>

<span style="color:blue;" onclick="Show(3)">新增幣別：</span>
<div id="Show_3" style="display:none">

    <form method="post" action="{{ url('/currency_add') }}">
        {{ csrf_field() }}
        輸入幣別名稱：<input type='text' name="currency_name" id="currency_name" value="" required="required" >
        <button>送出</button>
    </form>
</div>

</body>
</html>