@extends('master_user')
@section('content')
<div class="wrap">
	@include('user.header.header')
	@include('user.header.header_slide')
	
	<div class="main">
		@if (Cookie::get('dung') != null)
	<h1>123123123122312</h1>
	@endif
		<div class="content">
			<div class="content_top">
				<div class="heading">
					<h3>New Products</h3>
				</div>
				<div class="see">
					<p><a href="{{route('list-product')}}">See all Products</a></p>
				</div>
				<div class="clear"></div>
			</div>
			<div class="section group">
				@foreach($products as $value)
				<div class="grid_1_of_4 images_1_of_4">
					<a href="{{route('preview', $value->id)}}">
						@foreach($value->product_images as $key=>$item)
                                    @if($value->id == $item->product_id)
                                    @if($key == 0)
                                    <img src="/uploads/{{$item->path}}" alt="" width="100%"></img>
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
							<h4><a href="{{route('preview', $value->id)}}">View Details</a></h4>
						</div>
						<div class="clear"></div>
					</div>
				</div>
				@endforeach
			</div>
			<div class="content_bottom">
				<div class="heading">
					<h3>Feature Products</h3>
				</div>
				<div class="see">
					<p><a href="{{route('list-feature')}}">See all Products</a></p>
				</div>
				<div class="clear"></div>
			</div>
			<div class="section group">
				@foreach($products as $value)
				@if($value->sales_volume > 0)
				<div class="grid_1_of_4 images_1_of_4">
					<a href="{{route('preview', $value->id)}}">
				@foreach($value->product_images as $key=>$item)
                            @if($value->id == $item->product_id)
                            @if($key == 0)
                            <img src="/uploads/{{$item->path}}" alt="" width="100%"></img>
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
							<h4><a href="{{route('preview', $value->id)}}">View Details</a></h4>
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