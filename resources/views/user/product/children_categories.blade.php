@if($minh->category)
	@foreach($minh->childrenCategories as $i)
		<li class="has-children">
			<a href="">{{$i->name}}</a>	
			<ul class="is-hidden">
				@include('user.product.children_categories', ['minh'=>$item])
			</ul>
		</li>
	@endforeach
@endif

