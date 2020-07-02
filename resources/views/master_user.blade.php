<!DOCTYPE html>
<html>
<head>
	<title></title>
	<meta name="csrf-token" content="{{csrf_token()}}">
	<link href="{{asset('css/user/style.css')}}" rel="stylesheet" type="text/css" media="all"/>
	<link href="{{asset('css/user/main.css')}}" rel="stylesheet" type="text/css" media="all"/>
	<link href="{{asset('css/user/bootstrap.min.css')}}" rel="stylesheet" type="text/css" media="all"/>
	<link href="{{asset('css/user/fix.css')}}" rel="stylesheet" type="text/css" media="all"/>

	<link href="{{asset('css/user/slider.css')}}" rel="stylesheet" type="text/css" media="all"/>
	<link href="{{asset('css/user/easy-responsive-tabs.css')}}" rel="stylesheet" type="text/css" media="all"/>

	<link rel="stylesheet" href="{{asset('css/user/global.css')}}">

	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css" integrity="sha384-KA6wR/X5RY4zFAHpv/CnoG2UW1uogYfdnP67Uv7eULvTveboZJg0qUpmJZb5VqzN" crossorigin="anonymous">
	
	<script type="text/javascript" src="{{asset('js/user/jquery-1.7.2.min.js')}}"></script> 
	<script type="text/javascript" src="{{asset('js/user/move-top.js')}}"></script>
	<script type="text/javascript" src="{{asset('js/user/easing.js')}}"></script>
	<script type="text/javascript" src="{{asset('js/user/startstop-slider.js')}}"></script>
	<script src="{{asset('js/user/easyResponsiveTabs.js')}}" type="text/javascript"></script>
	<script src="{{asset('js/user/slides.min.jquery.js')}}"></script>
	<script src="{{asset('js/user/ajax.js')}}"></script>
</head>
<body>
	@yield('content')
</body>
</html>