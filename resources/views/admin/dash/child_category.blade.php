
<option value="{{$childCategory->id}}"><?php echo $str; ?>{{ $child_category->name }}</option>
	@if ($child_category->categories)
			
	        @foreach ($child_category->categories as $childCategory)
	        	
	            @include('admin.cate.child_category', ['child_category' => $childCategory,'str'=>$str."-"])
	        @endforeach
	    
@endif