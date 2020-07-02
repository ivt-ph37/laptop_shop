@extends('admin.master_admin')
@section('content')
<div class="col-lg-12">

    <h1 class="page-header">Category
        <small>chirdren </small>
    </h1>
    <div class="alert alert-success" id="mess" role="alert">
    </div>

                    </div>
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr align="center">
                                <th>STT</th>
                                <th>Name</th>
                                <th>Parent_id</th>
                                <th colspan="2">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($categoies as $key=>$item)

                            <tr class="odd gradeX" align="center">
                                <td >{{$key++}}</td>
                                <td >{{$item->name}}</td>
                                <td >
                                 @foreach($categories as $value)     
                                    @if($value->id == $item->parent_id)
                                        {{$value->name}}
                                    @endif
                                 @endforeach   
                                </td>
                                <td class="center">
                                    <button data-url="{{route('category.edit',$item->id)}}" class="btn btn-primary btn-edit" data-toggle="modal" data-target="#edit" type="button"><i class="fa fa-pencil fa-fw" ></i> </button>
                                </td>
                                <td class="center">
                                    <button data-url="{{ route('category.destroy',$item->id) }}"​ type="button" data-target="#delete" data-toggle="modal" class="btn btn-danger btn-delete"><i class="fa fa-trash-o  fa-fw"></i></button>
                                </td>
                         @endforeach

                            </tr>
                            
                        </tbody>
                    </table>
                        
                       
@include('admin.cate.edit')
@endsection
@section('sr')

<script>
$(document).ready(function () {
    $('#mess').hide();

    $('.btn-delete').click(function(){
        var url = $(this).attr('data-url');
        var _this = $(this);
        if (confirm('Ban co chac muon xoa khong?')) {
            $.ajax({
                type: 'delete',
                url: url,
                success: function(response) {
                    alert('Xoa thanh cong');
                    _this.parent().parent().remove();
                },
            })
        }
    })

    $('.btn-edit').click(function(e){
        $('.error').hide();
    $('.errorss').hide();
        var url = $(this).attr('data-url');

        e.preventDefault();

        $.ajax({
                type: 'get',
                url: url,
                success: function (response) {
                    $('.tittle').text(response.data.name);
                    $('#name-edit').val(response.data.name);
                    $('#parent-edit').val(response.data.parent_id);
                    $('#desription-edit').val(response.data.desription);
                    $('#form-edit').attr('data-url','{{ asset('admin/category/chirdren') }}/'+response.data.id)
                },
            })
        })
    $('#form-edit').submit(function(e){
                        e.preventDefault();
                        var url=$(this).attr('data-url');
                        $.ajax({
                            type: "get",
                            url: url,
                        data: {
                            'name': $('#name-edit').val(),  //biến phải trùng vs tên REQUEST 
                            'parent_id': $('#parent-edit').val(),
                            'desription': $('#desription-edit').val(),
                            '_method':'get',

                        },
                        success: function($resuld) {
                            if($resuld.error == 'true'){
                                
                                if ($resuld.mess.name) {
                                    $('.error').show();
                                    $('.error').text($resuld.mess.name[0]);
                                }else{$('.error').hide()};
                                if ($resuld.mess.desription) {
                                    $('.errorss').show();
                                $('.errorss').text($resuld.mess.desription);                                    
                                }else{
                                    $('.errorss').hide();
                                }
            
                            }else{
                            $('#edit').modal('hide');
                            $('#name').text($resuld.data.name);
                            $('#parent_id').text($resuld.data.parent_id);
                            $('#desription').text($resuld.data.desription);
                            $('#mess').show();
                            $('#mess').html($resuld.message,{timeOut:5000});
                            toastr.success($resuld.message);
                            window.location.reload();
                            }

                        },
                        })
                    })



})
   
</script>
@endsection

