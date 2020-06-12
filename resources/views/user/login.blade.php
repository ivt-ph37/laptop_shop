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
			<div class="login-page">
				<div class="container">
					<div class="row">
						@if(Session::has('flag'))
						<div class="alert alert-{{Session::get('flag')}}">{{Session::get('message')}}</div>
						@endif
						<div class="col-md-8 col-md-offset-2">
							<h2 class="text-center">Sign In Your Account</h2>
							<form method="post" class="cmxform" action="{{route('login')}}" id="loginForm">
								<input type="hidden" name="_token" value="{{csrf_token()}}">
								<div class="form-group row">
									<label for="email" class="col-sm-2 form-control-label">Email:</label>
									<div class="col-sm-8">
										<input type="email" name="email" class="form-control" id="email" placeholder="test@gmail.com" required />
									</div>
								</div>

								<div class="form-group row">
									<label for="password" class="col-sm-2 form-control-label">Password:</label>
									<div class="col-sm-8">
										<input type="password" name="password" class="form-control" id="password" placeholder="Enter password" required />
									</div>
								</div>

								<div class="form-group row col-sm-offset-2">

									<input type="checkbox" id="remember" name="remember" />
									<label for="remember" style="color:#ac2925; font-weight: normal"><span style="opacity:.5"></span>Remember Me</label><br />
								</div>



								<div class="form-group row">
									<div class="col-sm-offset-2 col-sm-8">
										<input type="submit" class="btn btn-danger btn-lg btn-block" id="submitForm" value="Sign In" />
									</div>
								</div>

								<div class="forget">
									<!-- <p class="pull-left"><a href="forgot_password.html">Forgot Password</a></p> -->
									<p class="pull-right">Not a memeber yet.. 
										<a href="{{route('register')}}">Create a new account</a>
									</p>
									<div class="clearfix"></div>
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