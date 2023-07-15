<!DOCTYPE html>
<html lang="en-US">
<head>
    <title>@yield('title')</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @stack('custom-css')
</head>
<body>

<div class="navigation">
    <div class="content">
        <div class="navigation">
            <div class="vertical-menu">
                <a href="/">Landing</a>
                <a href="{{route('users.index')}}">Users</a>
            </div>
            <div class="content">
                @yield('user-content')
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script type="text/javascript" src="{{asset('js/app.js')}}" async></script>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>
@stack('custom-js')

</body>
</html>


