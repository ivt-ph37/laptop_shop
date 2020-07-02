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
			<a class="cd-dropdown-trigger" href="#0">Danh mục</a>
			<nav class="cd-dropdown">
				<ul class="cd-dropdown-content">
					@foreach ($categorys as $category) 
					<li class="has-children">
						<a href="#">{{$category->name}}</a>
						<ul class="cd-secondary-dropdown is-hidden">
							@foreach ($category->childrenCategories as $childCategory)
								@include('user.product.children_categories', ['child_category' => $childCategory])
							@endforeach
						</ul> <!-- .cd-secondary-dropdown -->
					</li> <!-- .has-children -->
					@endforeach
					<li class="has-children">
						<a href="#">LAPTOP theo RAM</a>
						<ul class="cd-secondary-dropdown is-hidden">
							<a href="{{route('list-category',1)}}">4GB</a>
							<a href="{{route('list-category',2)}}">8GB</a>
							<a href="{{route('list-category',3)}}">16GB</a>
						</ul> <!-- .cd-secondary-dropdown -->
					</li> <!-- .has-children -->
					<li class="has-children">
						<a href="#">LAPTOP theo giá</a>
						<ul class="cd-secondary-dropdown is-hidden">
							<a href="{{route('list-category',4)}}">Dưới 13$</a>
							<a href="{{route('list-category',5)}}">Từ 13$ - 17$</a>
							<a href="{{route('list-category',6)}}">Trên 17$</a>
						</ul> <!-- .cd-secondary-dropdown -->
					</li> <!-- .has-children -->
				</ul> <!-- .cd-dropdown-content -->
			</nav> <!-- .cd-dropdown -->
		</div> <!-- .cd-dropdown-wrapper -->
	</div>
	
	<script src="{{asset('js/user/header_category/jquery.menu-aim.js')}}"></script>
	<script src="{{asset('js/user/header_category/main.js')}}"></script>
</body>
</html>