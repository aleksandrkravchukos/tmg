<!DOCTYPE html>
<html>
<head>
    <title>@yield('title')</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
</head>
<body>
<main>
    <div class="container">
        @yield('content')
    </div>
</main>

<script type="text/javascript" src="{{asset('js/app.js')}}" async></script>
@yield('scripts')
</body>
</html>


