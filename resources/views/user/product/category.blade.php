@extends('master_user')
@section('content')
	<table class="table table-striped">
	  <thead>
	    <tr>
	      <th scope="col">ID</th>
	      <th scope="col">Name</th>
	      <th scope="col">Category_Id</th>
	    </tr>
	  </thead>

	  <tbody>
	  	@foreach($products as $value)

	  	<tr>
	  		<td>{{$value->id}}</td>
	  		<td>{{$value->name}}</td>
	  		<td>{{$value->categoies->name}}</td>
	  	</tr>
	  	@endforeach
	  </tbody>
</table>
@endsection