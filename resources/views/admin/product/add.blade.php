@extends('admin.master_admin')
@section('content')
<div class="col-lg-12">
                        <h1 class="page-header">Product
                            <small>Add</small>
                        </h1>
                    </div>
                    <!-- /.col-lg-12 -->
                    <div class="col-lg-7" style="padding-bottom:120px">
                           
                        <form action="{{route('product.store')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label>Name *</label>
                                <input class="form-control" name="name" value="{!! old('name') !!}" />
                                <div class="p-3 mb-2 bg-danger text-white" style="color: red;">{!! $errors->first('name')!!}</div>
                            </div>
                            <div class="form-group">
                                <label>Quantity *</label>
                                <input class="form-control" name="quantity" value="{!! old('quantity') !!}"/>
                                <div class="p-3 mb-2 bg-danger text-white" style="color: red;">{!! $errors->first('quantity')!!}</div>
                            </div>
                            <div class="form-group">
                                <label>Price *</label>
                                <input class="form-control" name="price" value="{!! old('price') !!}"/>
                                <div class="p-3 mb-2 bg-danger text-white" style="color: red;">{!! $errors->first('price')!!}</div>
                            </div>
                            <div class="form-group">
                                <label>Supplier_Name</label>
                                <select class="form-group" name="supplier_id" >
                                    @foreach ($suppliers as $item) 
                                        <option value="{{$item->id}}">{{$item->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Category_Name</label>
                                <select class="form-group" name="category_id">
                                    @foreach ($categories as $item) 
                                        <option value="{{$item->id}}">{{$item->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>RAM *</label>
                                <input class="form-control" name="RAM" value="{!! old('RAM') !!}"/>
                                <div class="p-3 mb-2 bg-danger text-white" style="color: red;">{!! $errors->first('RAM')!!}</div>
                            </div>
                            <div class="form-group">
                                <label>VGA *</label>
                                <input class="form-control" name="VGA" value="{!! old('VGA') !!}"/>
                                <div class="p-3 mb-2 bg-danger text-white" style="color: red;">{!! $errors->first('VGA')!!}</div>
                            </div>
                            <div class="form-group">
                                <label>Operating_System *</label>
                                <input class="form-control" name="operating_system" value="{!! old('operating_system') !!}"/>
                                <div class="p-3 mb-2 bg-danger text-white" style="color: red;">{!! $errors->first('operating_system')!!}</div>
                            </div>
                            <div class="form-group">
                                <label>CPU *</label>
                                <input class="form-control" name="CPU" value="{!! old('CPU') !!}"/>
                                <div class="p-3 mb-2 bg-danger text-white" style="color: red;">{!! $errors->first('CPU')!!}</div>
                            </div>
                            <div class="form-group">
                                <label>Guarantee *</label>
                                <input class="form-control" name="guarantee" value="{!! old('guarantee') !!}"/>
                                <div class="p-3 mb-2 bg-danger text-white" style="color: red;">{!! $errors->first('guarantee')!!}</div>
                            </div>
                            <div class="form-group">
                                <label>Note *</label>
                                <textarea class="form-control" rows="3" name="note">{!! old('note') !!}</textarea>

                            </div>
                            <div class="form-group">
                                <label>Description *</label>
                                <textarea class="form-control" rows="3" name="description" >{!! old('description') !!}</textarea>
                                <div class="p-3 mb-2 bg-danger text-white" style="color: red;">{!! $errors->first('description')!!}</div>
                            </div>
                            <div class="form-group">
                                <label>Sales_Volume *</label>
                                <input class="form-control" name="sales_volume" value="{!! old('sales_volume') !!}"/>
                                <div class="p-3 mb-2 bg-danger text-white" style="color: red;">{!! $errors->first('sales_volume')!!}</div>
                            </div>
           <div class="form-group">
        <label>Image *</label>
        <input  type="file" name="image[]" multiple value="{!! old('image') !!}" />

                            <button type="submit" class="btn btn-default">Product Add</button>
                            <button type="reset" class="btn btn-default">Reset</button>
                        <form>
                    </div>
@endsection
             