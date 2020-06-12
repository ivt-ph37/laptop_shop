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
							<li><a href="{{route('logout')}}" id="btn_logout">Logout</a></li>
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
						@if(Session::has('success'))
							<div class="alert alert-success">{{Session::get('success')}}</div>
							@endif
						<div class="col-sm-3">
							<h2>My Account</h2>
							<ul>
								<li><a href="{{route('user', Auth::user()->id)}}">Account Control Panel</a></li>
								<li  class="active"><a href="account_information.html">Personal Information</a></li>
								<li><a href="account_orders.html">My Orders</a></li>
								<li><a href="account_carts.html">My Carts</a></li>
								<li><a href="account_reviews.html">My Reviews and Ratings</a></li>
								<li><a href="account_newsletter.html">Account Newsletter and Other</a></li>
							</ul>
						</div>
						<div class="col-sm-9">
							<h2>Edit Account</h2>
							<div class="row">
								<div class="col-sm-12 col-md-12">
									<form method="post" class="cmxform" action="{{route('update-user', $user->id)}}" id="editForm">
										{{ method_field('PUT')  }}
										<input type="hidden" name="_token" value="{{ csrf_token() }}" />
										<div class="form-group row">
											<label for="fullname" class="col-sm-2 form-control-label">Full Name:</label>
											<div class="col-sm-8">
												<input type="text" name="fullname" class="form-control" id="firstname" value="{{$user->fullname}}" minlength="2" required >
											</div>
										</div>
									
										<div class="form-group row">
											<label for="email" class="col-sm-2 form-control-label">Email:</label>
											<div class="col-sm-8">
												<input type="email" name="email" class="form-control email" id="email" value="{{$user->email}}" readonly="">
											</div>
										</div>

										<div class="form-group row">
											<label for="username" class="col-sm-2 form-control-label">Username:</label>
											<div class="col-sm-8">
												<input type="text" name="username" class="form-control" id="username" value="{{$user->username}}" readonly="">
											</div>
										</div>

										<div class="form-group row">
											<label for="telephone" class="col-sm-2 form-control-label">Phone Number:</label>
											<div class="col-sm-8">
												<input type="text" class="form-control" name="telephone" id="telephone" value="{{$user->telephone}}" required>
											</div>
										</div>

										<fieldset class="form-group">
											<div class="row">
												<label class="col-md-2">Gender:</label>
												<div class="col-md-6">
													
													<input type=radio name="sex" value="0" {{ $user->sex == '0' ? 'checked' : ''}}>Male</option>
													
													<input type=radio name="sex" value="1" {{ $user->sex == '1	' ? 'checked' : ''}}>Female</option>            
													
													<!-- <input type=radio name="sex" value="0" 
													@if($user->sex == 0) 
													 'checked'
													@endif
												>Male</option>
												<input type=radio name="sex" value="1" 
													@if($user->sex == 1) 
													 'checked'
													@endif
												>Female</option>  -->  
												</div>



											</div>
										</fieldset>
										<!-- <div class="form-group row">
											<label for="birthdate" class="col-sm-2 form-control-label">BirthDate:</label>
											<div class="col-sm-8">
												<input type="date" class="form-control" name="birthdate" id="birthdate"value="1995-12-30" required>
											</div>
										</div>
 -->
										<div class="form-group row">
											<div class="col-sm-offset-2 col-sm-8">
												<input type="submit" class="btn btn-yellow btn-lg" id="submitForm" value="Save" />
											</div>
										</div>
									</form>
								</div>
							</div> <!--End Row-->
						</div>
					</div> <!--End Row-->

				</div>
			</div> <!--End Account page div-->

		</div> <!-- End content Area class -->
	</div>
	@include('user.footer')
</body>
</html>