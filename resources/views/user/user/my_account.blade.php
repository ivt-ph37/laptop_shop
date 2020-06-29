@extends('master_user')
@section('content')
	<div class="wrap">
		<div class="header">
			<div class="headertop_desc">
				<div class="call">
					<p><span>Need help?</span> call us <span class="number">1-22-3456789</span></span></p>
				</div>
				<div class="account_desc">
					<ul>
						@if(Auth::check())
							<li><a href="#">Xin chào {{Auth::user()->fullname}}</a></li>
							<li><a href="#">Delivery</a></li>
							<!-- <li><a href="#">Checkout</a></li> -->
							<li><a href="{{route('logout')}}" id="btn_logout">Logout</a></li>
							<!-- <li><a href="#">My Account</a></li> -->
						@else
							<li><a href="{{route('register')}}">Đăng ký</a></li>
							<li><a href="{{route('login')}}">Đăng nhập</a></li>
							<li><a href="#">Delivery</a></li>
							<!-- <li><a href="#">Checkout</a></li> -->
							<!-- <li><a href="#">My Account</a></li> -->
						@endif
					</ul>
				</div>
				<div class="clear"></div>
			</div>
			<div class="header_top">
				<div class="logo">
					<a href="{{route('home')}}"><img src="{{ asset('images/logo.png') }}"></a>
				</div>

				<div class="clear"></div>
			</div>
		</div>
	</div>
	<div class="wrap">
	<div class="content-area">

		<div class="account-page">
			<div class="container">

				<div class="row">
					<div class="col-sm-3">
						<h2>My Account</h2>
						<ul>
							<li  class="active"><a href="#">Account Control Panel</a></li>
							<li><a href="account_carts.html">My All Orders</a></li>
							<li><a href="account_carts.html">My Carts Products</a></li>
							<li><a href="account_reviews.html">My Reviews and Ratings</a></li>
						</ul>
					</div>
					<div class="col-sm-9">
						<h2>Thông Tin Tài Khoản</h2>
						<strong>Hello {{$user->fullname}}</strong><br />
						<p>From your account control panel, you can access all of your recent activites, orders, save products and you can edit your personal information and other details.</p>
						<div class="row">
							<div class="col-md-6 col-sm-6">
								<div class="well">
									<h3>Thông Tin Liên Hệ</h3>
									<p>Họ và tên : {{$user->fullname}}</p>
									<p>Địa chỉ Email : {{$user->email}}</p>
									<p><a href="account_change_email.html">Change Email</a> | <a href="account_change_password.html">Change Password</a></p>
									<p class="pull-right"><a href="{{route('information-user', $user->id)}}"><i class="fa fa-edit"></i> Edit</a></p>
									<div class="clearfix"></div>
								</div>
							</div>

							<div class="col-md-6 col-sm-6">
								<div class="well">
									<h3>News Letters</h3>
									<p>Do you want to get the latest product news and promotion offers then make it on otherwise off it.</p>
									<p class="pull-right"><a href="#"><i class="fa fa-edit"></i> Edit</a></p>
									<div class="clearfix"></div>
								</div>
							</div>

							<div class="col-md-6 col-sm-6">
								<div class="well">
									<h3>Default Billing Address</h3>
									<address class="address">
										<strong>Name:</strong> {{$user->fullname}} <br />
										<strong>Email:</strong> {{$user->email}} <br />
										<strong>Contact No:</strong> {{$user->telephone}}<br />
									</address>
									<p class="pull-right"><a href="#"><i class="fa fa-edit"></i> Edit</a></p>
									<div class="clearfix"></div>
								</div>
							</div>

							<div class="col-md-6 col-sm-6">
								<div class="well">
									<h3>Default Delivery Address Address</h3>
									<address class="address">
										<strong>Name:</strong> Maniruzzaman Akash <br />
										<strong>Address:</strong> <br />
										Dumki-8602, Patuakhali, Barisal<br />
										Contact No: +8801951233084<br />
									</address>
									<p class="pull-right"><a href="#"><i class="fa fa-edit"></i> Edit</a></p>
									<div class="clearfix"></div>
								</div>
							</div>


						</div>
					</div>
				</div> <!--End Row-->

			</div>
		</div> <!--End Account page div-->

	</div> <!-- End content Area class -->
	</div>
	@include('user.footer.footer')
@endsection