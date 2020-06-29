@extends('admin.master_admin')
@section('content')
<div class="col-lg-12">
                        <h1 class="page-header">Promotion
                            <small>Add</small>
                        </h1>
                    </div>
<div class="col-lg-7" style="padding-bottom:120px">
@if(session('thongbao'))
    <div class="alert alert-success" role="alert" style="color: red;">
        {{session('thongbao')}}
    </div>
@endif
    <form action="{{route('promotion.store')}}" method="POST">
        @csrf
        <div class="form-group">
            <label>Name Suppliers *</label>
            <select class="form-group" name="sup_id" id="idSupp" >
                @foreach ($suppliers as $item) 
                    <option value="{{$item->id}}">{{$item->name}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label>Name Product *</label>
            <select class="form-group" name="product_id" id="idPro">
            </select>
        </div>
        <div class="form-group">
            <label >Promotion *</label>
            <input class="form-control" name="price" value="{!! old('price') !!}" />
            
            <div class="p-3 mb-2 bg-danger text-white" style="color: red;">{!! $errors->first('price')!!}</div>
        </div>

        <div class="form-group">
            <label >Start Date *</label>
            <input class="form-control" name="start_date" type="date" value="{!! old('start_date') !!}" />
            
            <div class="p-3 mb-2 bg-danger text-white" style="color: red;">{!! $errors->first('start_date')!!}</div>
        </div>
        <div class="form-group">
            <label >End Date *</label>
            <input class="form-control" name="end_date" type="date" value="{!! old('end_date') !!}" />
            
            <div class="p-3 mb-2 bg-danger text-white" style="color: red;">{!! $errors->first('end_date')!!}</div>
        </div>
        <button type="submit" class="btn btn-default">Promotion Add</button>
        <button type="reset" class="btn btn-default">Reset</button>
    <form>
</div>
@endsection
@section('sr')

<script>
$(document).ready(function () {
    $('#idSupp').change(function(){
        var idSup = $(this).val();
        $.ajax({
            type: 'get',
            url: '/admin/promotion/ajax/'+idSup,
            success:function($resuld){
                // console.log($resuld.data);
                // alert(idSup);
                 var html ='';
                    $.each($resuld.data,function($key,$value){
                        if ($value['supplier_id']==idSup) {
                            html +='<option value='+$value['id']+' selected>';
                                html += $value['name'];
                            html += '</option>';
                        }else{
                            html +='<option value='+$value['id']+' >';
                                html += $value['name'];
                            html += '</option>';
                        }
                    });
                        $('#idPro').html(html);
            }
        })
    })




})
</script>
@endsection

                