<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('css/admin/list.css') }}" rel="stylesheet" media="all">
    <title>管理頁面</title>
</head>
<body>
    <div class="title">管理</div>
    
    <div class="frame_1">
        <div class="frame_2">
            <div class="frame_3"><a href="{{ route('member') }}">會員管理</a></div>
        </div>
        <div class="frame_2">
            <div class="frame_3"><a href="{{ route('department') }}">部門管理</a></div>
        </div>
        <div class="frame_2">
            <div class="frame_3"><a href="{{ route('competence') }}">權限管理</a></div>
        </div>

    </div>
    
</body>
</html>