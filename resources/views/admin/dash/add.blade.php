@extends('admin.master_admin')
@section('content')
<div class="col-lg-12">
                        <h1 class="page-header">Category
                            <small>Add</small>
                        </h1>
                    </div>
<div class="col-lg-7" style="padding-bottom:120px">
<!--     @if($errors->has('name') || $errors->has('desription'))
        <div class="alert alert-success" role="alert">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{!!$error!!}</li>
                @endforeach
            </ul>
                
    </div>
    @endif -->
    <form action="{{route('category.store')}}" method="POST">
        @csrf
        <div class="form-group">
            <label>Category Name *</label>
            <input class="form-control" name="name" value="{!! old('name') !!}" />
            <div class="p-3 mb-2 bg-danger text-white" style="color: red;">{!! $errors->first('name')!!}</div>
        </div>
        <div class="form-group">
            <label>Category Parent</label>
            <select class="form-group" name="parent_id">
                <option value="0">None</option>
                @foreach ($categories as $category) 
                    <?php $str="-" ?>
                    <option value="{{$category->id}}"><?php echo $str; ?>{{ $category->name }}</option>
                        @foreach ($category->childrenCategories as $childCategory)
                        <?php $str."-" ?>
                            @include('admin.cate.child_category', ['child_category' => $childCategory,'str'=>$str.'-' ])
                         @endforeach   
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label >Desription *</label>
            <textarea class="form-control" rows="3" name="desription">{!! old('desription') !!}</textarea>
            
            <div class="p-3 mb-2 bg-danger text-white" style="color: red;">{!! $errors->first('desription')!!}</div>
        </div>
        <button type="submit" class="btn btn-default">Category Add</button>
        <button type="reset" class="btn btn-default">Reset</button>
    <form>
</div>
@endsection
                