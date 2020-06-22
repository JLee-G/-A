function test(value, d_id_s){
    
    var d_id_arr = d_id_s.split(",");

    for(var i = 0;i < d_id_arr.length-1;i++){
        if(document.getElementById('department_'+d_id_arr[i]))
            document.getElementById('department_'+d_id_arr[i]).style.display="none";//顯示
    }
    document.getElementById('department_'+value).style.display="";//顯示
}

function test02(value){
    document.getElementById('post_v').value = value;
}

//下拉顯示隱藏
function test03(value, d_id_s){
    var d_id_arr = d_id_s.split(",");

    for(var i = 0;i < d_id_arr.length-1;i++){
        if(document.getElementById('department_c_'+d_id_arr[i]))
            document.getElementById('department_c_'+d_id_arr[i]).style.display="none";//顯示
    }
    document.getElementById('department_c_'+value).style.display="";//顯示
}

//勾選顯示隱藏
function test04(value, c_id_s){
    var c_id_arr = c_id_s.split(",");

    for(var i = 0;i < c_id_arr.length-1;i++){
        if(document.getElementById('d_c_'+c_id_arr[i]))
            document.getElementById('d_c_'+c_id_arr[i]).style.display="none";//顯示
    }
    document.getElementById('d_c_'+value).style.display="";//顯示
}

//修改觀看權限
function ModifyWatch($csrf_token, $classTable_id, $route_id){
    //取得此選項是否被勾選
    var isChecked = (document.getElementById("Check_value_"+$classTable_id+"_"+$route_id).checked)?'1':'0';
    
    //傳送資料
    var xmlHttp = new XMLHttpRequest();
    xmlHttp.open("POST",'./ModifyWatch', false);
    xmlHttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    var Send_Str =  '_token='+$csrf_token+
                    '&classTable_id='+$classTable_id+
                    '&route_id='+$route_id+
                    '&isChecked='+isChecked;
    xmlHttp.send(Send_Str);
}

//修改部門名稱
function ModifyDepartmentName($csrf_token, $id, $value){
    $modify_v = prompt("更改部門名稱",$value);
    if($modify_v){
        //傳送資料
        var xmlHttp = new XMLHttpRequest();
        xmlHttp.open("POST",'./MDN', false);
        xmlHttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        var Send_Str =  '_token='+$csrf_token+
                        '&id='+$id+
                        '&modify_v='+$modify_v;
        xmlHttp.send(Send_Str);

        history.go(0);	//重新整理
    }else if($modify_v == ''){
        alert('不能空值！');
    }
}

function DeleteAuthority($csrf_token, $id){
    //傳送資料
    var xmlHttp = new XMLHttpRequest();
    xmlHttp.open("POST",'./DeleteAuthority', false);
    xmlHttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    var Send_Str =  '_token='+$csrf_token+
                    '&id='+$id;
    xmlHttp.send(Send_Str);
    history.go(0);	//重新整理
}