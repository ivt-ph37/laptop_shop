@extends('master_user')
@section('content')
<div class="wrap">
	@include('user.header.header')
	@include('user.header.header_slide')
	<div class="main">
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
					<a href="#">
						<!-- @if(count($value->product_images))
						<img src="{{$value->product_images[0]->path}}" alt="" /></a>

						@endif -->
						<img src="images/new-pic2.jpg" alt="" /></a>	
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
					<p><a href="#">See all Products</a></p>
				</div>
				<div class="clear"></div>
			</div>
			<div class="section group">
				<div class="grid_1_of_4 images_1_of_4">
					<a href="preview.html"><img src="images/new-pic1.jpg" alt="" /></a>					
					<h2>Lorem Ipsum is simply </h2>
					<div class="price-details">
						<div class="price-number">
							<p><span class="rupees">$849.99</span></p>
						</div>
						<div class="add-cart">								
							<h4><a href="preview.html">Add to Cart</a></h4>
						</div>
						<div class="clear"></div>
					</div>
				</div>
				<div class="grid_1_of_4 images_1_of_4">
					<a href="preview.html"><img src="images/new-pic2.jpg" alt="" /></a>
					<h2>Lorem Ipsum is simply </h2>
					<div class="price-details">
						<div class="price-number">
							<p><span class="rupees">$599.99</span></p>
						</div>
						<div class="add-cart">								
							<h4><a href="preview.html">Add to Cart</a></h4>
						</div>
						<div class="clear"></div>
					</div>
				</div>
				<div class="grid_1_of_4 images_1_of_4">
					<a href="preview.html"><img src="images/new-pic4.jpg" alt="" /></a>
					<h2>Lorem Ipsum is simply </h2>
					<div class="price-details">
						<div class="price-number">
							<p><span class="rupees">$799.99</span></p>
						</div>
						<div class="add-cart">								
							<h4><a href="preview.html">Add to Cart</a></h4>
						</div>
						<div class="clear"></div>
					</div>
				</div>
				<div class="grid_1_of_4 images_1_of_4">
					<a href="preview.html"><img src="images/new-pic3.jpg" alt="" /></a>
					<h2>Lorem Ipsum is simply </h2>					 
					<div class="price-details">
						<div class="price-number">
							<p><span class="rupees">$899.99</span></p>
						</div>
						<div class="add-cart">								
							<h4><a href="preview.html">Add to Cart</a></h4>
						</div>
						<div class="clear"></div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@include("user.footer.footer")
@endsection