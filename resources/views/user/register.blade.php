<!DOCTYPE html>
<html>
<head>
	<title></title>

	<link href="{{asset('css/user/style.css')}}" rel="stylesheet" type="text/css" media="all"/>
	<link href="{{asset('css/user/main.css')}}" rel="stylesheet" type="text/css" media="all"/>
	<link href="{{asset('css/user/bootstrap.min.css')}}" rel="stylesheet" type="text/css" media="all"/>
</head>
<body>
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
							<li><a href="#">Checkout</a></li>
							<!-- <li><a href="#">My Account</a></li> -->
						@else
							<li><a href="{{route('register')}}">Register</a></li>
							<li><a href="{{route('login')}}">Login</a></li>
							<li><a href="#">Delivery</a></li>
							<li><a href="#">Checkout</a></li>
							<!-- <li><a href="#">My Account</a></li> -->
						@endif
					</ul>
				</div>
				<div class="clear"></div>
			</div>
			<div class="header_top">
				<div class="logo">
					<a href="{{route('home')}}"><img src="images/logo.png" alt="" /></a>
				</div>

				<div class="clear"></div>
			</div>
		</div>
	
		<div class="content-area">
			<div class="registration-page">
				<div class="container">
					<div class="row">
						@if(count($errors)>0)
							<div class="alert alert-danger">
								@foreach($errors->all() as $error)
									{{$error}}
								@endforeach
							</div>
						@endif
						@if(Session::has('success'))
							<div class="alert alert-success">{{Session::get('success')}}</div>
						@endif

						<div class="col-md-8 col-md-offset-2">
							<h2 class="text-center">Create Your Account</h2>
							<form method="post" class="cmxform" action="{{route('register')}}" id="registerForm">
								<input type="hidden" name="_token" value="{{ csrf_token() }}" />
								<div class="form-group row">
									<label for="fullname" class="col-sm-2 form-control-label">Full Name:</label>
									<div class="col-sm-8">
										<input type="text" name="fullname" class="form-control" id="fullname" placeholder="Maniruzzaman" minlength="2" required>
									</div>
								</div>

								<div class="form-group row">
									<label for="email" class="col-sm-2 form-control-label">Email:</label>
									<div class="col-sm-8">
										<input type="email" name="email" class="form-control email" id="email" placeholder="test@example.com">
									</div>
								</div>

								<div class="form-group row">
									<label for="username" class="col-sm-2 form-control-label">Username:</label>
									<div class="col-sm-8">
										<input type="text" name="username" class="form-control" id="username" placeholder="akash90">
									</div>
								</div>

								<div class="form-group row">
									<label for="password" class="col-sm-2 form-control-label">Password:</label>
									<div class="col-sm-8">
										<input type="password" name="password" class="form-control" id="password" placeholder="Enter password">
									</div>
								</div>

								<div class="form-group row">
									<label for="confirm_password" class="col-sm-2 form-control-label">Confirm Password:</label>
									<div class="col-sm-8">
										<input type="password" class="form-control" name="confirm_password" id="confirm_password" placeholder="Same password previously entered">
									</div>
								</div>

								<div class="form-group row">
									<label for="telephone" class="col-sm-2 form-control-label">Phone Number:</label>
									<div class="col-sm-8">
										<input type="text" class="form-control" name="telephone" id="telephone" placeholder="Enter Phone Number" required>
									</div>
								</div>

								<div class="form-group row">
									<div class="col-sm-offset-2 col-sm-8">
										<input type="submit" class="btn btn-danger btn-lg btn-block" id="submitForm" value="Sign Up Now" />
									</div>
								</div>
							</form>
						</div>
					</div> <!--End Row-->
				</div>
			</div> <!--End Registration page div-->
		</div> <!-- End content Area class -->

	</div>
	@include('user.footer')
</body>
</html>

