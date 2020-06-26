@extends('master_user')

@section('content')
<div class="wrap">
	@include('user.header.header')
	<script>
		$(function(){
			$('#productss').slides({
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
									<div id="productss">
										<div class="slides_container">
											@foreach($productImage as $value)
											@foreach($value->product_images as $key=>$item)
				                       
				                                    @if($key == 0)
				                                    <img src="/uploads/{{$item->path}}" alt="" width="100%"></img>
				                       
				                                    @endif
				                                    @endforeach
											@endforeach

										</div>
										<ul class="pagination">
											@foreach($productImage as $value)
											@foreach($value->product_images as $key=>$item)
											<li>
												@if($key != 0)
												<a href="#{{$key++}}"> 
				                                    <img src="/uploads/{{$item->path}}" alt="" width="100%"></img>
				                       
				                                   </a>
				                                    @endif
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
									@if($product->quantity > 0 && $product->quantity / 2 >= $product->sales_volume)
										@if ($promotion != NULL)
										<p>Promotion Price: 
											<span>Giảm: </span><span>{{$promotion->price}}%</span><br>
											<p>Giá cũ: <span style="text-decoration: line-through;">{{$product->price}}$</span></p>
											<p>Còn:<span> {{$promotion->products->price * $promotion->price / 100}}$</span></p>
										</p>
										@else
										<p>Price: <span>{{$product->price}}$</span></p>
										@endif
									@elseif($product->quantity > 0 && $product->quantity / 2 < $product->sales_volume)
										@if ($promotion != NULL)
										<p>Promotion Price: 
											<span>Giảm: </span><span>{{$promotion->price}}%</span><br>
											<p>Giá cũ: <span style="text-decoration: line-through;">{{$product->price}}$</span></p>
											<p>Còn:<span> {{$promotion->products->price * $promotion->price / 100}}$</span></p>
											<p style="color: #5f00ff;">Sản phầm gần hết</p>
										</p>
										@else
										<p>Price: <span>{{$product->price}}$</span></p>
										<p style="color: #5f00ff;">Sản phầm gần hết</p>
										@endif
									@else	
										<p><span> Sản phẩm đã hết</span></p>								
									@endif
										
								</div>
								@if($product->quantity != 0)

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
								@endif
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
										<h4>Lorem ipsum Review by <a href="#">{{$product->name}}</a></h4>
										<ul>
											<li>Price :<a href="#"><img src="{{asset('images/price-rating.png')}}" alt="" /></a></li>
											<li>Value :<a href="#"><img src="{{asset('images/value-rating.png')}}" alt="" /></a></li>
											<li>Quality :<a href="#"><img src="{{asset('images/quality-rating.png')}}" alt="" /></a></li>
										</ul>
										<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</p>
										<!-- <div class="your-review">
											<h3>How Do You Rate This Product?</h3>
											<p>Write Your Own Review?</p>
											<form>
												<div>
													<span><label>Nickname<span class="red">*</span></label></span>
													<span><input type="text" value=""></span>
												</div>
												<div><span><label>Summary of Your Review<span class="red">*</span></label></span>
													<span><input type="text" value=""></span>
												</div>						
												<div>
													<span><label>Review<span class="red">*</span></label></span>
													<span><textarea> </textarea></span>
												</div>
												<div>
													<span><input type="submit" value="SUBMIT REVIEW"></span>
												</div>
											</form>
										</div>		 -->	
										<!-- comment bang facebook -->
										<div id="fb-root"></div>
										<script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v7.0" nonce="eTUN1Nlk"></script>	
										<div class="fb-comments" data-href="https://developers.facebook.com/docs/plugins/comments#configurator" data-numposts="7" data-width=""></div>

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
						</script>	

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
								@foreach($item->product_images as $key=>$value)
				                       
                                @if($key == 0)
                               <a href=""><img src="/uploads/{{$value->path}}" alt="" width="25%"></img></a> 
                   
                                @endif
                                @endforeach	
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
@include('user.footer.footer')
@endsection`