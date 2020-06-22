<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="" rel="stylesheet" media="all">
    <link href="{{ asset('setup/admin/css/setting.css') }}" rel="stylesheet" media="all">
    <script language='javascript' src='{{ asset('setup/admin/js/setting.js') }}'></script>
    <title>權限設定頁面</title>
</head>
<body>
    <div class="frame_1">
        <div class="frame_2">
            <p><a href="{{ url('/admin') }}">返回</a></p>
            <p>權限管理：</p>

            選擇權限：
            <select onclick="ShowRoute(this.value, '{{$Permissions_id_s}}')" >
                <option value="">無</option>
                @foreach($p_r_arr as $key => $value)
                    <option value="{{$value['p_id']}}" >{{$value['p_name']}}</option>
                @endforeach
            </select>

            </br>

            可使用以下路由：
            @foreach($p_r_arr as $key => $value)
            <div class="reel" id="Route_r_{{$value['p_id']}}" style="display:none">
                @foreach($Route_arr as $key_1 => $value_1)
                    <div class="reel_width">
                        {{$value_1['1']}}<input type="checkbox" onclick="ModifyPermissions('{{ csrf_token() }}','{{$value['p_id']}}','{{$value_1[0]}}')" 
                        id="Check_P_R_{{$value['p_id']}}_{{$value_1[0]}}" 
                        @if(!empty($value['route'])) @if(in_array($value_1[0], $value['route'])) checked @endif @endif >
                    </div>
                @endforeach
            </div>
            @endforeach

            <hr>

            選擇使用者：
            <select onclick="ShowPermissions(this.value, '{{$user_id_s}}')" >
                <option value="">無</option>
                @foreach($user_arr as $key => $value)
                    <option value="{{$value[0]}}" >{{$value[1]}}</option>
                @endforeach
            </select>

            </br>

            所擁有權限：
            @foreach($u_p_arr as $key => $value)
            <div class="reel" id="u_p_{{$value['u_id']}}" style="display:none">
                @foreach($Permission_arr as $key_1 => $value_1)
                    <div class="reel_width">
                        {{$value_1['1']}}<input type="checkbox" onclick="ModifyUser('{{ csrf_token() }}','{{$value['u_id']}}','{{$value_1[0]}}')" 
                        id="Check_U_P_{{$value['u_id']}}_{{$value_1[0]}}" 
                        @if(!empty($value['Permissions'])) @if(in_array($value_1[0], $value['Permissions'])) checked @endif @endif >
                    </div>
                @endforeach
            </div>
            @endforeach

            
        </div>
    </div>
</body>
</html>