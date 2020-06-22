<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<img src="/uploads/{{Session::get('path')}}" alt="">
	<form action="{{url('/123')}}" method="post" enctype="multipart/form-data">
		@csrf
		<label for="">FILE</label>
		<input type="file" name="select_file" />
		<input type="submit" name="upload" value="Upload" 	/>

	</form>
</body>
</html>