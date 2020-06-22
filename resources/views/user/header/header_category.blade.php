<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link href="{{asset('css/user/header_category/style.css')}}" rel="stylesheet" type="text/css" media="all"/>
	<link href="{{asset('css/user/header_category/reset.css')}}" rel="stylesheet" type="text/css" media="all"/>

	<script src="{{asset('js/user/header_category/modernizr.js')}}"></script>
</head>
<body>
	<div class="minh">
		<div class="cd-dropdown-wrapper">
			<a class="cd-dropdown-trigger" href="#0">Categories</a>
			<nav class="cd-dropdown">
				<ul class="cd-dropdown-content">
					@foreach($categories as $value)
					<li class="has-children">
						<a href="">{{$value->name}}</a>
						<ul class="cd-secondary-dropdown is-hidden">
							@foreach($value->childrenCategories as $item)
							<li class="has-children">
								<a href="">{{$item->name}}</a>
								<ul class="is-hidden">
									@include('user.product.children_categories', ['minh'=>$item])
								</ul>
							</li>
							@endforeach
						</ul> <!-- .cd-secondary-dropdown -->
					</li> <!-- .has-children -->
					@endforeach
				</ul> <!-- .cd-dropdown-content -->
			</nav> <!-- .cd-dropdown -->
		</div> <!-- .cd-dropdown-wrapper -->
	</div>
	
	<script src="{{asset('js/user/header_category/jquery.menu-aim.js')}}"></script>
	<script src="{{asset('js/user/header_category/main.js')}}"></script>
</body>
</html>