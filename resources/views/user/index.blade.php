@extends('master_user')
@section('content')
<div class="wrap">
	@include('user.header.header')
	@include('user.header.header_slide')
	
	<div class="main">



	@if(Session::get('products_vieww') != NULL)
	<div class="heading">
					<h3>San pham da xem</h3>
				</div>
		<div class="section group">
				@foreach($products_views as $key=>$value)
				@if($key != 0)
					
					<div class="grid_1_of_4 images_1_of_4">
						<a href="{{route('preview', $value['id'])}}">
							@foreach($value['product_images'] as $keyy=>$item)
	                                    @if($value['id'] == $item['product_id'])
	                                    @if($keyy == 0)
	                                    <img src="/uploads/{{$item['path']}}" alt="" ></img>
	                                    @endif
	                                    @endif
	                                    @endforeach
						</a>
						<h2>{{$value['name']}}</h2>
						<div class="price-details">
							<div class="price-number">
								<p><span class="rupees">${{$value['price']}}</span></p>
							</div>
							<div class="add-cart">								
								<h4><a href="{{route('preview', $value['id'])}}">View Details</a></h4>
							</div>
							<div class="clear"></div>
						</div>
					</div>
					@endif
				@endforeach
			</div>
	@endif

		<div class="content">
			<div class="content_top">
				<div class="heading">
					<h3>Sản Phẩm Mới</h3>
				</div>
				<div class="see">
					<p><a href="{{route('list-product')}}">Xem tất cả sản phẩm</a></p>
				</div>
				<div class="clear"></div>
			</div>
			<div class="section group">
				@foreach($products as $value)
				<div class="grid_1_of_4 images_1_of_4">
					<div>
						@if($value->quantity == 0)
						<div class="data_value_none">Hết hàng</div>
						@elseif($value->quantity <= 10)
						<div class="data_value_none">Gần hết</div>
						@else
						<div class="data_value_none">Còn hàng</div>
						@endif
						@foreach($value->promotions as $promotion)
							<div class="data_value_promotion">-{{$promotion->price}}$</div>
						@endforeach
						<a href="{{route('preview', $value->id)}}">
							@foreach($value->product_images as $key=>$item)
	                            @if($value->id == $item->product_id)
	                                @if($key == 0)
	                                    <img src="/uploads/{{$item->path}}" alt=""></img>
	                                @endif
	                            @endif
	                        @endforeach
						</a>	
						<h2>{{$value->name}}</h2>
					</div>
					<div class="price-details">
						<div class="price-number">
							<p><span class="rupees">${{$value->price}}</span></p>
						</div>
						<div class="add-cart">								
							<h4><a href="{{route('preview', $value->id)}}">Xem chi tiết</a></h4>

						</div>
					</div>

				</div>

				@endforeach
			</div>

			<div class="content_bottom">
				<div class="heading">
					<h3>Sản Phẩm Bán Chạy</h3>
				</div>
				<div class="see">
					<p><a href="{{route('list-feature')}}">Xem tất cả sản phẩm</a></p>
				</div>
				<div class="clear"></div>
			</div>
			<div class="section group">
				@foreach($products as $value)
				@if($value->sales_volume >= 10)
				<div class="grid_1_of_4 images_1_of_4">
					<a href="{{route('preview', $value->id)}}">

						@foreach($value->product_images as $key=>$item)
                                    @if($value->id == $item->product_id)
                                    @if($key == 0)
                                    <img src="/uploads/{{$item->path}}" alt="" ></img>
                                    @endif
                                    @endif
                                    @endforeach
					</a>	
					<h2>{{$value->name}}</h2>

					<div class="price-details">
						<div class="price-number">
							<p><span class="rupees">${{$value->price}}</span></p>
						</div>
						<div class="add-cart">								
							<h4><a href="{{route('preview', $value->id)}}">Xem chi tiết</a></h4>
						</div>
						<div class="clear"></div>
					</div>
				</div>
				@endif
				@endforeach
			</div>

			<div class="content_bottom">
				<div class="heading">
					<h3>Sản Phẩm Nổi Bật</h3>
				</div>
				<div class="see">
					<p><a href="{{route('list-highlight')}}">Xem tất cả sản phẩm</a></p>
				</div>
				<div class="clear"></div>
			</div>
			<div class="section group">
				@foreach($products as $value)
				@if($value->note == 1)
				<div class="grid_1_of_4 images_1_of_4">
						@if($value->quantity == 0)
						<div class="data_value_none">Hết hàng</div>
						@elseif($value->quantity <= 10)
						<div class="data_value_none">Gần hết</div>
						@else
						<div class="data_value_none">Còn hàng</div>
						@endif
					<a href="{{route('preview', $value->id)}}">
					@foreach($value->product_images as $key=>$item)
                            @if($value->id == $item->product_id)
                            @if($key == 0)
                            <img src="/uploads/{{$item->path}}" alt=""></img>
                            @endif
                            @endif
                            @endforeach
                      </a>					
					<h2>{{$value->name}} </h2>
					<div class="price-details">
						<div class="price-number">
							<p><span class="rupees">${{$value->price}}</span></p>
						</div>
						<div class="add-cart">								
							<h4><a href="{{route('preview', $value->id)}}">Xem chi tiết</a></h4>
						</div>
						<div class="clear"></div>
					</div>
				</div>
				@endif
				@endforeach
			</div>
		</div>
	</div>
</div>
@include("user.footer.footer")
@endsection