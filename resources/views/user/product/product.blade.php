@extends('master_user')
@section('content')
<div class="wrap">
	@include('user.header.header')
	@include('user.header.header_slide')
	<div class="main">
		<div class="content">
			<!-- <div class="content_top">
				<div class="heading">
					<h3>New Products</h3>
				</div>
				<div class="see">
					<p><a href="{{route('list-product')}}">See all Products</a></p>
				</div>
				<div class="clear"></div>
			</div> -->
			<div class="section group">
				@foreach($products as $value)
					
				<div class="grid_1_of_4 images_1_of_4">
					@if($value->quantity == 0)
					<div class="data_value_none">Hết hàng</div>
					@elseif($value->quantity <= 10)
					<div class="data_value_none">Gần hết</div>
					@else
					<div class="data_value_none">Còn hàng</div>
					@endif
					<div>
					<a href="{{route('preview', $value->id)}}">
						@if(count($value->product_images))
						<img src="/uploads/{{$value->product_images[0]->path}}" alt="" /></a>
						@endif
					<h2>{{$value->name}}</h2>
					</div>
					<div class="price-details">
						<div class="price-number">
							<p><span class="rupees">${{$value->price}}</span></p>
						</div>
						<div class="add-cart">								
							<h4><a href="{{route('preview', $value->id)}}">View Details</a></h4>
						</div>
						<div class="clear"></div>
					</div>
				</div>
				@endforeach
			</div>
		</div>
	</div>
	{!!$products->links()!!}
</div>
@include("user.footer.footer")
@endsection