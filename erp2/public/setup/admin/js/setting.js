//顯示此權限有哪些路由可用
function ShowRoute(permissions_id, c_id_s){
    var c_id_arr = c_id_s.split(",");

    for(var i = 0;i < c_id_arr.length-1;i++){
        if(document.getElementById('Route_r_'+c_id_arr[i]))
            document.getElementById('Route_r_'+c_id_arr[i]).style.display="none";//顯示
    }
    document.getElementById('Route_r_'+permissions_id).style.display="";//顯示
}

//顯示此權限有哪些路由可用
function ShowPermissions(user_id, c_id_s){
    var c_id_arr = c_id_s.split(",");

    for(var i = 0;i < c_id_arr.length-1;i++){
        if(document.getElementById('u_p_'+c_id_arr[i]))
            document.getElementById('u_p_'+c_id_arr[i]).style.display="none";//顯示
    }
    document.getElementById('u_p_'+user_id).style.display="";//顯示
}

//修改權限所擁有路由
function ModifyPermissions($csrf_token, $P_id, $R_id){
    //取得此選項是否被勾選
    var isChecked = (document.getElementById("Check_P_R_"+$P_id+"_"+$R_id).checked)?'1':'0';
    
    //傳送資料
    var xmlHttp = new XMLHttpRequest();
    xmlHttp.open("POST",'./ModifyPermissions', false);
    xmlHttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    var Send_Str =  '_token='+$csrf_token+
                    '&P_id='+$P_id+
                    '&R_id='+$R_id+
                    '&isChecked='+isChecked;
    xmlHttp.send(Send_Str);
}

//修改使用者所擁有權限
function ModifyUser($csrf_token, $U_id, $P_id){
    //取得此選項是否被勾選
    var isChecked = (document.getElementById("Check_U_P_"+$U_id+"_"+$P_id).checked)?'1':'0';
    
    //傳送資料
    var xmlHttp = new XMLHttpRequest();
    xmlHttp.open("POST",'./ModifyUser', false);
    xmlHttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    var Send_Str =  '_token='+$csrf_token+
                    '&U_id='+$U_id+
                    '&P_id='+$P_id+
                    '&isChecked='+isChecked;
    xmlHttp.send(Send_Str);
}


    
function makeRequest() {
  var url = "https://api.fixer.io/latest";
  xhr = new XMLHttpRequest();
  xhr.onload = function() {
    var response = JSON.parse(this.responseText);
    console.log(response)
  };
  
  xhr.open(
    "GET",
    url,true
  );
  
  xhr.send();
}

makeRequest();