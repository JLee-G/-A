//顯示此權限有哪些路由可用
function Show(id){
    for(var i = 0;i < 10;i++){
        if(document.getElementById('Show_'+i))
            document.getElementById('Show_'+i).style.display="none";//隱藏
    }
    document.getElementById('Show_'+id).style.display="";//顯示
}

//更改顯示所擁有飯店
function ShowH(csrf_token, supplier_id){

    var display_v = '';

    //傳送資料
    var xmlHttp = new XMLHttpRequest();
    xmlHttp.open("POST",'./Related_Hotel', false);
    xmlHttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    var Send_Str =  '_token='+csrf_token+
                    '&supplier_id='+supplier_id;
    xmlHttp.send(Send_Str);

    var NewArray = xmlHttp.responseText.split("@!@");

    if(NewArray[1]!=''){
        var return_arr = NewArray[1].split(",");
        return_arr.forEach(function(e){ 
            var r_arr = e.split(":");
            if(display_v == '') display_v += '<option value="" >無</option>';
            display_v += '<option value="'+r_arr[0]+'" >'+r_arr[1]+'</option>';
        })
    }
    
    document.getElementById('hotel_Options').innerHTML = display_v;
}

//顯示飯店相關房間
function ShowR(csrf_token, hotel_id){
    
    var display_v = '';

    //傳送資料
    var xmlHttp = new XMLHttpRequest();
    xmlHttp.open("POST",'./Related_Room', false);
    xmlHttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    var Send_Str =  '_token='+csrf_token+
                    '&hotel_id='+hotel_id;
    xmlHttp.send(Send_Str);


    var NewArray = xmlHttp.responseText.split("@!@");
    
    if(NewArray[1]!=''){
        var return_arr = NewArray[1].split(",");
        return_arr.forEach(function(e){ 
            var r_arr = e.split(":");
            if(display_v == '') display_v += '<option value="" >無</option>';
            display_v += '<option value="'+r_arr[0]+'" >'+r_arr[1]+'</option>';
        })
    }
    
    document.getElementById('Room_Options').innerHTML = display_v;
}

//顯示房間相關資訊
function ShowA(csrf_token, Room_id){

    var display_v = '';

    //傳送資料
    var xmlHttp = new XMLHttpRequest();
    xmlHttp.open("POST",'./Room_Information', false);
    xmlHttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    var Send_Str =  '_token='+csrf_token+
                    '&Room_id='+Room_id;
    xmlHttp.send(Send_Str);

    var NewArray = xmlHttp.responseText.split("@!@");
    if(NewArray[1]!=''){
        display_v = NewArray[1];
    }
    
    document.getElementById('test_9').innerHTML = display_v;
}

//查詢訂單資訊
function order_inquire(csrf_token){

    var display_v = '';
    var order_number_v = document.getElementById("order_number").value;

    //傳送資料
    var xmlHttp = new XMLHttpRequest();
    xmlHttp.open("POST",'./order_inquire', false);
    xmlHttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    var Send_Str =  '_token='+csrf_token+
                    '&order_number='+order_number_v;
    xmlHttp.send(Send_Str);

    var NewArray = xmlHttp.responseText.split("@!@");
    if(NewArray[1]!=''){
        var return_arr = NewArray[1].split(",");
        return_arr.forEach(function(e){ 
            var r_arr = e.split(":::");
            display_v += '<br/>id='+r_arr[0]+'<br/>飯店ID='+r_arr[1]+'<br/>訂房客戶ID='+r_arr[2]+'<br/>房型='+r_arr[3]+'<br/>價格='+r_arr[4]+'<br/>幣別='+r_arr[5];
        })
    }
    
    document.getElementById('test_5').innerHTML = display_v;

}

//用金額ID查詢
function amount_inquire(){

    var display_v = '';

    var amount_id_v = document.getElementById("amount_id").value;

    //傳送資料
    var xmlHttp = new XMLHttpRequest();
    xmlHttp.open("POST",'./amount_inquire', false);
    xmlHttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    var Send_Str =  '_token='+csrf_token+
                    '&amount_id='+amount_id_v;
    xmlHttp.send(Send_Str);
    
}