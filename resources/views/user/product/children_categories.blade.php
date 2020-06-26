<a href="{{route('list-category',$child_category->id)}}">{{$child_category->name}}</a>
	@if ($child_category->categories)
		<!-- <ul class="cd-secondary-dropdown is-hidden"> -->
	        @foreach ($child_category->categories as $childCategory)
	        	<li class="has-children">
	            @include('user.product.children_categories', ['child_category' => $childCategory])
	            </li>
	        @endforeach
	    <!-- /ul> -->	
@endif