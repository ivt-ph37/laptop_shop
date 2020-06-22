@if ($child_category->categories)
	@if($child_category->id == $item->parent_id)
        {{$child_category->name}}
    @else
	    @foreach($child_category->childrenCategories as $childCategory)
			@include('admin.cate.dequy', ['child_category' => $childCategory])
	    @endforeach
    @endif
@endif