<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{__('Information')}}</title>

    <!-- Styles -->
    <style>
        .links > a {
            color: #636b6f;
            padding: 0 25px;
            font-size: 13px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        }
    </style>
</head>
<body>

    <div class="links">
        <a href="{{ url('/') }}">首頁</a>
        <p>{{__('Information')}}</p>
        <p>
            {{__('member list')}}:
            @foreach($MemberList as $key => $value)
            @if($key!=0) , @endif
            {{$value->name}}
            @endforeach
        </p>
    </div>
    
</body>
</html>