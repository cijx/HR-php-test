<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{env("APP_NAME")}}</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{asset('css/app.css')}}" rel="stylesheet" type="text/css">
</head>
<body>
<div class="navbar navbar-default" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{route('indexPage')}}">{{env("APP_NAME")}}</a>
        </div>
        <div class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li><a href="{{route('indexPage')}}">домой</a></li>
                <li><a href="{{route('order.index')}}">заказы</a></li>
                <li><a href="{{route('weather')}}">погода</a></li>
            </ul>
        </div>
    </div>
</div>
<div class="container">
    @if(session("success"))
        <div class="alert alert-success">
            {{session("success")}}
        </div>
    @endif
     @if(session("fails"))
        <div class="alert alert-danger">
            {{session("fails")}}
        </div>
      @endif
    @yield("content")
</div>
<script src="{{asset('js/app.js')}}"></script>
@stack("scripts")
</body>
</html>
