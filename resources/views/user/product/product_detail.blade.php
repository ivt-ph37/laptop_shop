@extends('master_user')

@section('content')
<div class="wrap">
	@include('user.header.header')
	<script>
		$(function(){
			$('#products').slides({
				preload: true,
				preloadImage: 'img/loading.gif',
				effect: 'slide, fade',
				crossfade: true,
				slideSpeed: 350,
				fadeSpeed: 500,
				generateNextPrev: true,
				generatePagination: false,

			});
		});
	</script>
	<div class="main">
		<div class="content">
			<div class="section group minh-gr">
				<div class="rightsidebar span_3_of_1">
					@include('user.header.header_category')

				</div>

				<div class="cont-desc span_1_of_2">
					<div class="product-details">				
						<div class="grid images_3_of_2">
							<div id="container">
								<div id="products_example">
									<div id="products">
										<div class="slides_container">
											@foreach($productImage as $value)
											@foreach($value->product_images as $item)
											<a href="#"><img src="{{$item->path}}" alt="" /></a></a>
											@endforeach
											@endforeach

										</div>
										<ul class="pagination">
											@foreach($productImage as $value)
											@foreach($value->product_images as $item)
											<li>
												<a href="#"><img src="{{$item->path}}" alt="" /></a>
											</li>
											@endforeach
											@endforeach
										</ul>
									</div>
								</div>
							</div>
						</div>

						<div class="desc span_3_of_2">
							<form action="{{route('add-cart',['id'=>$product->id])}}" method="get">
								@csrf
								<h2>{{$product->name}}</h2>
								<p>{{$product->description}}</p>					
								<div class="price">
									<p>Price: <span>{{$product->price}}$</span></p> 

									<p>Promotion Price: 
										@foreach($promotionPrice as $item)
										<span>{{$item->price}}$</span>
										@endforeach
									</p>
								</div>

								<input type="hidden" name="price" value="{{$product->price}}">
								@foreach($promotionPrice as $item)
								<input type="hidden" name="promotionPrice"  value="{{$item->price}}">
								@endforeach
								
								<div class="available">
									<span>Quantity:</span>
									<input type="number" name="quantity" value="1" min="1" max="10">
								</div>
								
									@if(Session::has('thongbao'))
									<div>{{Session::get('thongbao')}}: <strong>Chỉ còn {{$product->quantity}} sản phẩm</strong></div>
									@endif
								
								<button class="button" type="submit" id="btn_add_cart">Add to Cart</button>	
							</form>
						</div>
						<div class="clear"></div>
					</div>

					<div class="product_desc">	
						<div id="horizontalTab">
							<ul class="resp-tabs-list">
								<li>Product Details</li>
								<li>product Tags</li>
								<li>Product Reviews</li>
								<div class="clear"></div>
							</ul>
							<div class="resp-tabs-container">
								<div class="product-desc">
									<p>Lorem Ipsum is simply dummy text of the <span>printing and typesetting industry</span>. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</p>
									<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, <span>when an unknown printer took a galley of type and scrambled</span> it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.<span> It has survived not only five centuries</span>, but also the leap into electronic typesetting, remaining essentially unchanged.</p>
									<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</p>					</div>

									<div class="product-tags">
										<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</p>
										<h4>Add Your Tags:</h4>
										<div class="input-box">
											<input type="text" value="">
										</div>
										<div class="button"><span><a href="#">Add Tags</a></span></div>
									</div>	

									<div class="review">
										<div style="margin-bottom:15px">
											<h4>Review product <a href="#" style="">{{$product->name}}</a></h4>

											<div class="review_rating_content" style="display:flex; justify-content:space-between; align-items: center; margin-top:15px">

												<div class="component_rating" style="width:15%;">
													<div class="rating_item">
														<div class=""><span class="fas fa-star" style="font-size:30px; color:#ff9705">2.5</span></div>
													</div>
												</div>
												
												<div class="list_rating" style="width:60%; padding:15px;">
													@for($i=1; $i<=5; $i++)
														<div class="item_rating" style="margin-top:15px; display: flex; justify-content:space-between; align-items:center;
														color:#ff9705">
															<div>
																{{$i}}<span class="fa fa-star"></span>
															</div>
															<div style="width:65%">
																<span style="width:100%;height:6px;display: 
																block;border:1px solid #dedede">
																	<b style="width:30%; background-color:#f25800; display:block; height:100%; border-radius:5%;"></b>
																</span>
															</div>
															<div>
																<a href="">290 reviews</a>
															</div>
														</div>
													@endfor
												</div>

												<div class="" style="width:15%; border:1px solid #ff9705; background-color:#ff9705; padding:15px; text-align:center; border-radius:50%">
													<a class="js_rating_action" style="color:#fff; text-decoration: none; cursor:pointer; opacity:0.7">Choose reviews</a>
												</div>
											</div>

											<div class="form_rating hide">
												<div style="display:flex; justify-content:space-between; align-items:center" >
													<p style="color:#CD1F25">Please choose review</p>
													<span id="list_start">
														@for($i=1; $i<=5; $i++)
														<i class="fas fa-star" data-key="{{$i}}"></i>
														@endfor
													</span>
													<input type="hidden" id="number_rating">
													<a href="{{route('save-rating', $product->id)}}" class="js_rating_product">Send Reviews</a>
												</div>
											</div>
										</div>

										<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</p>
	
										<!-- comment bang facebook -->
										<div id="fb-root"></div>
										<script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v7.0" nonce="eTUN1Nlk"></script>	
										<div class="fb-comments" data-href="{{route('preview', $value->id)}}" data-numposts="7" data-width=""></div>

									</div>
								</div>
							</div>
						</div>

						
						<div class="content_bottom">
							<div class="heading">
								<h3>Related Products</h3>
							</div>
							<div class="see">
								<p><a href="#">See all Products</a></p>
							</div>
							<div class="clear"></div>
						</div>
						<div class="section group">
							@foreach($productSuggests as $item)
							<div class="grid_1_of_4 images_1_of_4">
								<a href="#"><img src="{{$item->path}}" alt=""></a>		
								<div>{{$item->name}}</div>			
								<div class="price" style="border:none">
									<div class="add-cart" style="float:none">								
										<h4><a href="{{route('preview', $value->id)}}">View Details</a></h4>
									</div>
									<div class="clear"></div>
								</div>
							</div>
							@endforeach				
						</div>
					</div>

				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	$(document).ready(function () {
		$('#horizontalTab').easyResponsiveTabs({
				type: 'default', //Types: default, vertical, accordion           
				width: 'auto', //auto or any width like 600px
				fit: true   // 100% fit in a container
			});
	});

	$(function(){
		let listStart = $('#list_start .fas');

		listStart.mouseover(function() {
			let $this = $(this);

			let number = $this.attr('data-key');

			listStart.removeClass('rating_active');

			$("#number_rating").val(number);

			$.each(listStart, function(key, value){
				if(key+1 <= number)
				{
					$(this).addClass('rating_active'); 
				}
			});
		});

		$('.js_rating_action').click(function(event){
			event.preventDefault();

			if($('.form_rating').hasClass('hide'))
			{
				$('.form_rating').addClass('active').removeClass('hide');
			}
			else
			{
				$('.form_rating').addClass('hide').removeClass('active');
			}
		});

		$('.js_rating_product').click(function(event){
			event.preventDefault();

			let number = $('#number_rating').val();
			let url = $(this).attr('href');
			// var _this = $(this);
			
			// console.log(number);
			// console.log(url);
			if(number){
				$.ajax({
					headers: {
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					},
					url: url,
					type: 'post',
					data: {

						number:number,
					},
					success : function(data){
						 window.location.reload();
					},
					error : function(data){
						// alert('fails'); 
						console.log(data); 
					}
				});
			}
		})
	})
</script>	

@include('user.footer.footer')
@endsection