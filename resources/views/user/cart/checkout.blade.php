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
					<li><a href="{{route('user', Auth::user()->id)}}">Xin chào {{Auth::user()->fullname}}</a></li>
					<li><a href="#">Delivery</a></li>
					<!-- <li><a href="{{route('checkout')}}">Checkout</a></li> -->
					<!-- <li><a href="#">My Account</a></li> -->
					@else
					<li><a href="{{route('register')}}">Đăng ký</a></li>
					<li><a href="{{route('login')}}">Đăng nhập</a></li>
					<li><a href="#">Delivery</a></li>
					<!-- <li><a href="{{route('checkout')}}">Checkout</a></li> -->
					<!-- <li><a href="#">My Account</a></li> -->
					@endif
				</ul>
			</div>
			<div class="clear"></div>
		</div>
		<div class="header_top">
			<div class="logo">
				<a href="{{route('home')}}"><img src="{{asset('images/logo.png')}}" alt="" /></a>
			</div>

			<div class="clear"></div>
		</div>
	</div>
	
	<div class="content-area">
		<div class="login-page">
			<div class="container">
				<div class="row">
					@if(Auth::check())
					@if(Session::has('success'))
					<div class="alert alert-success">{{Session::get('success')}}</div>
					@endif
					<div class="col-md-8 col-md-offset-2 minh-checkout">
						<h2 class="text-center">Thông Tin Giao Hàng</h2>

						<form method="post" class="cmxform minh-form-ck" action="{{route('add-order')}}" id="checkoutForm">
							<input type="hidden" name="_token" value="{{ csrf_token() }}" />
							<div class="minh-form-ck-group">
							
								<div class="form-group">
									<label class="control-label col-sm-2" for="fullname">Tên Khách Hàng: *</label>
									<div class="col-sm-10">
										<input type="text" class="form-control inputs" id="fullname" name="fullname" value="{{Auth::user()->fullname}}" placeholder="Enter Your Shipping Name"  required/> 
										<input type="hidden" name="id" value="{{Auth::user()->id}}">
										<input type="hidden" name="username" value="{{Auth::user()->username}}">
									</div>
								</div>

								<div class="form-group">
									<label for="email" class="col-sm-2 control-label">Địa Chỉ Email: *</label>
									<div class="col-sm-10">
										<input type="email" name="email" class="form-control inputs" id="email" value="{{Auth::user()->email}}" placeholder="Enter Email Shipping Name" required />
									</div>
								</div>

								<div class="form-group">
									<label class="control-label col-sm-2" for="telephone">Số Điện Thoại: *</label>
									<div class="col-sm-10">
										<input type="text" class="form-control inputs" value="{{Auth::user()->telephone}}" id="shipping_contact" name="telephone" placeholder="Enter Your Shipping Contact No"  required/> 
									</div>
								</div>

								<div class="form-group">
									<label class="control-label col-sm-2" for="delivery_address">Địa Chỉ Giao Hàng: *</label>
									<div class="col-sm-10">
										<input type="text" class="form-control inputs" name="delivery_address" id="shipping_primary_address" placeholder="Enter Your Shipping primary Address" required/>
									</div>
								</div>

								<div class="form-group">
									<div class="col-sm-10 col-sm-offset-2">
										<a href=""><input type="submit" class="btn btn-info pull-right  margin-top-20 checkbtn2" name="submit_check2" value="Submit..."/></a>
										<a href="{{route('cart-index')}}" class="btn btn-danger pull-right  margin-top-20 margin-right-20">Back</a>
										<div class="clearfix"></div> 
									</div>
								</div>

							</div>
							<table class="table">
							<thead>
								<!-- <tr>
									<th width="5%">No.</th>
									<th width="45%">Item</th> 
									<th width="10%">Quantity</th> 
									<th width="20%">Unit Price</th> 
									<th width="20%">Total Price</th> 
								</tr> -->
							</thead>

							<tbody>
								<?php $i=1;?>	
								<?php $total = 0; ?>
								@foreach($cart as $value)
								<tr>
									<td>{{$i}}</td>
									<td>
										<img src="{{asset($value->options->img)}}" width="50" alt="" class="img img-thumbnail pull-left">
										<span class="pull-left cart-product-option">

											<strong>{{$value->name}}</strong><br />
											

											<!-- <a href="{{route('delete-cart', $value->rowId)}}">
												<input type="submit" class="btn btn-red btn-sm" name="" value="Remove Item" id="remove_item_cart">
											</a> -->
											<!-- <a href="#">
												<input type="submit" class="btn btn-red btn-sm update_item_cart" name="" value="Update Item" id="{{$value->rowId}}">
											</a> -->
										</span>
										<div class="clearfix"></div>
									</td>
									<td>
										<span class="pull-left cart-product-option">

											<strong>x{{$value->qty}}</strong><br />
										</span>
									</td>
									<!-- <td id="unit_price">{{number_format($value->price, 0,",",".")}}</td> -->
									<td>
										<span class="pull-left cart-product-option">

											<strong>{{number_format($value->subtotal(), 0,",",".")}}$</strong><br />
										</span>
									</td>
								</tr>   
								<?php $i++?> 
								<?php $total +=  $value->subtotal(); ?>                       
								@endforeach

								<tr>
									<td></td>
									<td colspan="1" id=""><strong>Tổng tiền:</strong></td>
									<td></td>
									<td>
										<p><span class="total_product_sum" id="sum_total_cart">{{$total}}$</span></p>
									</td>
									<div class="clearfix"></div>
								</tr>
								
								</tbody>
								
							</table>

						</form>

					</div>
					@else
						<div class="col-md-8 col-md-offset-2 minh-checkout">
						<h2 class="text-center">Thông Tin Giao Hàng</h2>

						<form method="post" class="cmxform minh-form-ck" action="{{route('add-order')}}" id="checkoutForm">
							<input type="hidden" name="_token" value="{{ csrf_token() }}" />
							<div class="minh-form-ck-group">
							
								<div class="form-group">
									<label class="control-label col-sm-2" for="fullname">Tên Khách Hàng: *</label>
									<div class="col-sm-10">
										<input type="text" class="form-control inputs" id="fullname" name="fullname" value="" placeholder="Enter Your Shipping Name"  required/> 
										<input type="hidden" name="id" value="">
										<input type="hidden" name="username" value="">
									</div>
								</div>

								<div class="form-group">
									<label for="email" class="col-sm-2 control-label">Địa Chỉ Email: *</label>
									<div class="col-sm-10">
										<input type="email" name="email" class="form-control inputs" id="email" value="" placeholder="Enter Email Shipping Name" required />
									</div>
								</div>

								<div class="form-group">
									<label class="control-label col-sm-2" for="telephone">Số Điện Thoại: *</label>
									<div class="col-sm-10">
										<input type="text" class="form-control inputs" value="" id="shipping_contact" name="telephone" placeholder="Enter Your Shipping Contact No"  required/> 
									</div>
								</div>

								<div class="form-group">
									<label class="control-label col-sm-2" for="delivery_address">Địa Chỉ Giao Hàng: *</label>
									<div class="col-sm-10">
										<input type="text" class="form-control inputs" name="delivery_address" id="shipping_primary_address" placeholder="Enter Your Shipping primary Address" required/>
									</div>
								</div>

								<div class="form-group">
									<div class="col-sm-10 col-sm-offset-2">
										<a href=""><input type="submit" class="btn btn-info pull-right  margin-top-20 checkbtn2" name="submit_check2" value="Submit..."/></a>
										<a href="{{route('cart-index')}}" class="btn btn-danger pull-right  margin-top-20 margin-right-20">Back</a>
										<div class="clearfix"></div> 
									</div>
								</div>

							</div>
							<table class="table">
							<thead>
								<!-- <tr>
									<th width="5%">No.</th>
									<th width="45%">Item</th> 
									<th width="10%">Quantity</th> 
									<th width="20%">Unit Price</th> 
									<th width="20%">Total Price</th> 
								</tr> -->
							</thead>

							<tbody>
								<?php $i=1;?>	
								<?php $total = 0; ?>
								@foreach($cart as $value)
								<tr>
									<td>{{$i}}</td>
									<td>
										<img src="{{asset($value->options->img)}}" width="50" alt="" class="img img-thumbnail pull-left">
										<span class="pull-left cart-product-option">

											<strong>{{$value->name}}</strong><br />
											

											<!-- <a href="{{route('delete-cart', $value->rowId)}}">
												<input type="submit" class="btn btn-red btn-sm" name="" value="Remove Item" id="remove_item_cart">
											</a> -->
											<!-- <a href="#">
												<input type="submit" class="btn btn-red btn-sm update_item_cart" name="" value="Update Item" id="{{$value->rowId}}">
											</a> -->
										</span>
										<div class="clearfix"></div>
									</td>
									<td>
										<span class="pull-left cart-product-option">

											<strong>x{{$value->qty}}</strong><br />
										</span>
									</td>
									<!-- <td id="unit_price">{{number_format($value->price, 0,",",".")}}</td> -->
									<td>
										<span class="pull-left cart-product-option">

											<strong>{{number_format($value->subtotal(), 0,",",".")}}$</strong><br />
										</span>
									</td>
								</tr>   
								<?php $i++?>   
								<?php $total +=  $value->subtotal(); ?>                     
								@endforeach

								<tr>
									<td></td>
									<td colspan="1" id=""><strong>Tổng tiền:</strong></td>
									<td></td>
									<td>
										<p><span class="total_product_sum" id="sum_total_cart">{{$total}}$</span></p>
									</td>
									<div class="clearfix"></div>
								</tr>
								
								</tbody>
								
							</table>

						</form>

					</div>
					@endif

				</div> <!--End Row-->
			</div>
		</div> <!--End Registration page div-->


	</div> <!--End Cart page-->


</div>
	@include('user.footer.footer')
@endsection