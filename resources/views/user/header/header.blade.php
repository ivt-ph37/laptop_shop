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
						<li><a href="#" id="btn_logout">Logout</a></li>
					@else
						<li><a href="{{route('register')}}">Register</a></li>
						<li><a href="{{route('login')}}">Login</a></li>
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
			  <div class="cart">
			  	   <p>Welcome to our Online Store! 
				  	   	<span>
				  	   	<!-- 	<a 
				  	   		@if(Auth::check()) href=" {{route('cart-index')}}"
				  	   		@else href="{{route('login')}}" 
				  	   		@endif 
				  	   		title="Bạn đã mua {{Cart::count()}}">Cart:</a> -->
				  	   		<a href=" {{route('cart-index')}}"
				  	   			title="Bạn đã mua {{Cart::count()}}">Cart:
				  	   		</a>
				  	   	</span>
				  	   	<div id="dd" class="wrapper-dropdown-2">
				  	   		{{Cart::count()}} item(s) - {{Cart::total()}}$

				  	   		
				  	   		<ul class="dropdown">
								<li>you have @if(Cart::count()<0) {{no}} @else {{Cart::count()}} @endif items in your Shopping cart</li>
							</ul>
						</div>
					</p>
			  </div>
			  <script type="text/javascript">
			function DropDown(el) {
				this.dd = el;
				this.initEvents();
			}
			DropDown.prototype = {
				initEvents : function() {
					var obj = this;

					obj.dd.on('click', function(event){
						$(this).toggleClass('active');
						event.stopPropagation();
					});	
				}
			}

			$(function() {

				var dd = new DropDown( $('#dd') );

				$(document).click(function() {
					// all dropdowns
					$('.wrapper-dropdown-2').removeClass('active');
				});

			});

		</script>
	 <div class="clear"></div>
  </div>
	<div class="header_bottom">
	     	<div class="menu">
	     		<ul>
			    	<li class="active"><a href="{{route('home')}}">Home</a></li>
			    	<li><a href="about.html">About</a></li>
			    	<li><a href="delivery.html">Delivery</a></li>
			    	<li><a href="news.html">News</a></li>
			    	<li><a href="contact.html">Contact</a></li>
			    	<div class="clear"></div>
     			</ul>
	     	</div>
	     	<div class="search_box">
	     		<form>
	     			<input type="text" value="Search" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Search';}"><input type="submit" value="">
	     		</form>
	     	</div>
	     	<div class="clear"></div>
	     </div>	     
	