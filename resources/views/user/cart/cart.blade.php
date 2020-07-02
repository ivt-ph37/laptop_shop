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
							<!-- <li><a href="#">Checkout</a></li> -->
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
					<a href="{{route('home')}}"><img src="{{asset('images/logo.png')}}" alt="" /></a>
				</div>

				<div class="clear"></div>
			</div>
		</div>
	
		<div class="content-area">
			<div class="container minh-cart">
				<div class="cart-page">
					<h2>Cart: {{Cart::count()}} Products</h2> 
					@if(Session::has('thongbao'))
						<div>{{Session::get('thongbao')}}: <strong>Chỉ còn {{$product->quantity}} sản phẩm</strong></div>
					@endif
					<form action="" method="" >
						<input type="hidden" name="_token" value="{{!!csrf_token()!!}}">
						<table class="table">
							<thead>
								<tr>
									<th width="5%">No.</th>
									<th width="45%">Sản phẩm</th> <!-- 50% -->
									<th width="10%">Số lượng</th> <!-- 10% -->
									<th width="20%">Giá tiền sản phẩm</th> <!-- 20% -->
									<th width="20%">Tổng số tiền</th> <!-- 20% -->
								</tr>
							</thead>

							<tbody>
								<?php $i=1;?>	
								<?php $total = 0; ?>
								@foreach($cart as $value)
								<tr>
									<td>{{$i}}</td>
									<td>
										<img src="/uploads/{{$value->options->img}}" width="20%" alt="" class="img img-thumbnail pull-left">
										<span class="pull-left cart-product-option">

											<strong>{{$value->name}}</strong><br />
											

											
												<input type="button" class="btn btn-red btn-sm remove_item_cart" name="" value="Remove Item" id="" data-url="{{route('delete-cart', $value->rowId)}}">
										
											<!-- <a href="#">
												<input type="submit" class="btn btn-red btn-sm update_item_cart" name="" value="Update Item" id="{{$value->rowId}}">
											</a> -->
										</span>
										<div class="clearfix"></div>
									</td>
									<td>
										
										<input type="number" min="1" max="10" name="quantity" value="{{$value->qty}}" class="form-control product_quantity_p1" onchange="updateCart(this.value, '{{$value->rowId}}', '{{$value->id}}')" id="qty"/> 
										
										
									</td>
									<td id="unit_price">{{$value->price}}$</td>
									<td><p class="total_ammount_p1" id="sub_total_cart">{{$value->subtotal()}}$</p></td>
								</tr>   
								<?php $i++?>  
								<?php $total +=  $value->subtotal(); ?>           
								@endforeach

								<tr>
									<td></td>
									<td colspan="2" id=""><strong>Total:</strong></td>
									<td></td>
									<td>
										<p><span class="total_product_sum" id="sum_total_cart">{{$total}}$</span></p>
									</td>
									<div class="clearfix"></div>
								</tr>
								<tr>
									<td colspan="5">
										<a href="{{route('checkout')}}" class="btn btn-yellow btn-lg pull-right margin-bottom-20" > Tiếp tục thanh toán </a>
										<a href="{{route('home')}}" class="btn btn-success btn-lg pull-right margin-right-20">
											<i class="fa fa-plus"></i> Thêm sản phẩm</a>

											<div class="clearfix"></div>
										</td>
									</tr>
								</tbody>

							</table>
						</form>
					</div> <!--End Cart page-->
					
				</div> <!-- End Container inside Content Area -->
			</div> <!-- End content Area class -->
		</div> <!-- End wrapper -->

	</div>
	@include('user.footer.footer')

	
	
	<script type="text/javascript">
			function updateCart(qty, rowId, id){
				// console.log(qty, rowId, id);
				$.ajax({
					'url': '/api/products/'+id+'/available',
					'type': 'GET',
					'data' : {
						'qty' : qty
					},
					success : function(data){
						// console.log(data);
						$.get(
							'{{asset('card/update')}}',
							{qty:qty, rowId:rowId},
							function(){
								location.reload();
							}
						);

					},
					error : function(data){
						alert('Sản phẩm không còn đủ số lượng');
					    

					}
				})
			}
	</script>
	<script type="text/javascript" src="{{asset('js/user/jquery-1.7.2.min.js')}}"></script>
	<script type="text/javascript" src="{{asset('js/user/ajax.js')}}"></script>
	
	
@endsection