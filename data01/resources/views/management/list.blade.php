<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script language='javascript' src='{{ asset('js/management/list.js') }}'></script>

    <title>{{__('management')}}</title>

    <!-- Styles -->
    <style>
        .links > a {
            color: #636b6f;
            /* padding: 0 25px; */
            font-size: 13px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        }
        .links > p {
            color:green;
        }
    </style>
</head>
<body>
    <div class="links">
        <a href="{{ url('/') }}">首頁</a>
        <p>{{__('management')}}</p>
        <p>目前使用者：</p>
        @foreach($user_arr as $key => $value)
            @if($key!=0) 
                <br/>
            @endif
            {{ $value[1] }} 部門：{{ $value[3] }}，權限：{{ $value[2] }}
        @endforeach

        <br/>

        <p>權限管理：</p>

        <form action="{{ url('/AddDepartment') }}">
            新增部門：<input size="20" type="text" name="department_id" value="" placeholder="請輸入" autocomplete="off">
            <button>新增</button>
        </form>

        <form action="{{ url('/AddPermissions') }}">
            新增權限：
            選擇部門：
            <select name="department_id" >
                <option value="">無</option>
                @foreach($department_arr as $key => $value)
                    <option value="{{ $value[0] }}" {{ (old('department_id') == $value[0] ? 'selected':'') }}>{{ $value[1] }}</option>
                @endforeach
            </select>
            新增權限：
            <input size="20" type="text" name="post_v" value="{{ old('post_v') }}" placeholder="請輸入" autocomplete="off">
            <button>新增</button>
        </form>

        <form action="{{ url('/UserPermissions') }}">
            修改使用者權限：
            選擇使用者：
            <select name="user_id" >
                <option value="">無</option>
                @foreach($user_arr as $key => $value)
                    <option value="{{ $value[0] }}" {{ (old('user_id') == $value[0] ? 'selected':'') }}>{{ $value[1] }}</option>
                @endforeach
            </select>

            選擇部門：
            <select name="department_id" onchange="test(this.value, '{{$department_id_s}}')" >
                <option value="">無</option>
                @foreach($department_arr as $key => $value)
                    <option value="{{ $value[0] }}" {{ (old('department_id') == $value[0] ? 'selected':'') }}>{{ $value[1] }}</option>
                @endforeach
            </select>

            選擇權限：
            @foreach($department_arr as $key => $value)
                <select onchange="test02(this.value)" id='department_{{$value[0]}}' style="display:none;" >
                    <option value="">無</option>
                    @foreach($classTable_arr as $key_1 => $value_1)
                        @if($value[1] == $value_1[1])
                            <option value="{{ $value_1[2] }}" >{{ $value_1[0] }}</option>
                        @endif
                    @endforeach
                    </option>
                </select>
            @endforeach
            <input type='hidden' name="post_v" id="post_v" >
            
            <button>修改</button>

            <!--全部錯誤訊息-->
            @if ($errors->any())
                @foreach ($errors->all() as $error)
                    [{{ $error }}]
                @endforeach
            @endif
        </form>
        <br/>

        <p>部門&權限：</p>
        @foreach($department_arr as $key => $value)
            部門：
            <a href="#" onclick="ModifyDepartmentName('{{ csrf_token() }}','{{$value[0]}}','{{ $value[1] }}')">{{ $value[1] }}</a> 
            ，包含的權限：
            @php $i = 0; @endphp
            @foreach($classTable_arr as $key_1 => $value_1)
                @if($value[1] == $value_1[1])
                    @if($i!=0)
                        、
                    @endif
                    {{ $value_1[0] }}<a href="#" onclick="DeleteAuthority('{{csrf_token()}}', '{{$value_1[2]}}')">x</a>
                    @php $i++; @endphp
                @endif
            @endforeach
            <br/>
        @endforeach

        <br/>

        <p>權限觀看設定：</p>

        <form action="{{ url('/Watch') }}">
            選擇部門：
            <select name="department_id" onchange="test03(this.value, '{{$department_id_s}}')" >
                <option value="">無</option>
                @foreach($department_arr as $key => $value)
                    <option value="{{ $value[0] }}">{{ $value[1] }}</option>
                @endforeach
            </select>

            選擇權限：
            @foreach($department_arr as $key => $value)
                <select onchange="test04(this.value, '{{$classTable_id_s}}')" id='department_c_{{$value[0]}}' style="display:none;" >
                    <option value="">無</option>
                    @foreach($classTable_arr as $key_1 => $value_1)
                        @if($value[1] == $value_1[1])
                            <option value="{{ $value_1[2] }}" >{{ $value_1[0] }}</option>
                        @endif
                    @endforeach
                    </option>
                </select>
            @endforeach
            <input type='hidden' name="post_v" id="post_v" >

            <br/>

            可觀看的路徑有：
            
            @foreach($classTable_arr as $key_1 => $value_1)
                <div id='d_c_{{$value_1[2]}}' style="display:none;" >
                    @foreach($route_arr as $key => $value)
                        <label>{{ $value[1] }}<input onclick="ModifyWatch('{{csrf_token()}}', '{{$value_1[2]}}', '{{$value[0]}}')" type="checkbox" id="Check_value_{{$value_1[2]}}_{{$value[0]}}" value="{{ $value[0] }}" {{ (in_array($value_1[2],$value[2]))?'checked':'' }}></label>
                        <br/>
                    @endforeach
                </div>
            @endforeach
            <br/>
        </form>
        
        <br/>

        
        <br/>

        <form action="{{ url('/RefreshUrl') }}">
            <button>刷新路徑</button>
        </form>

    </div>
</body>
</html>


