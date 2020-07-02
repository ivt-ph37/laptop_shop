@extends('admin.master_admin')
@section('content')
<div class="col-lg-12">
    @foreach($users as $item)
                        <h1 class="page-header">User: 
                            <small style="font-size: 40px;color: #6b00ff;">{{$item->username}}</small>
                        </h1>
                                            <div class="alert alert-success" id="mess" role="alert">
    </div>
                    </div>

<table class="table table-striped table-bordered table-hover" id="dataTables-example">

    <thead>
        <tr align="center">
            <th>ID</th>
            <th>fullname</th>
            <th>Email</th>
            <th>Level</th>
            <th>Telephone</th>
            <th>Sex</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <tr class="odd gradeX" align="center">
            <td>{{$item->id}}</td>
            <td>{{$item->fullname}}</td>
            <td>{{$item->email}}</td>
            <td>
                @if($item->level == 1)
                {{"Admin"}}
                @else
                    {{"User"}}
                @endif
            </td>
            <td>{{$item->telephone}}</td>
            <td>
                @if($item->sex == 0)
                {{"Nam"}}
                @else
                    {{"Nữ"}}
                @endif
            </td>
            <td class="center">
                <button data-url="{{route('user.edit',$item->id)}}" class="btn btn-primary btn-edit" data-toggle="modal" data-target="#edit" type="button"><i class="fa fa-pencil fa-fw" ></i> </button>
            </td>
        </tr>
         @endforeach
    </tbody>
</table>
@include('admin.user.edit')                 
@endsection

@section('sr')
<script>
    $(document).ready(function () {
        $('#mess').hide();
        $(document).on('click', '.btn-edit', function(e){
        var url = $(this).attr('data-url');
        e.preventDefault();
        $.ajax({
            type: 'get',
            url: url,
            success: function (response) {
                $('.tittle').text(response.data.username);
                $('#username-edit').val(response.data.username);
                $('#email-edit').val(response.data.email);
                if(response.data.level == 1){
                    $('#gridRadios1').attr('checked','checked');
                }else{
                    $('#gridRadios2').attr('checked','checked');
                }
                 $('#form-edit').attr('data-url','{{ asset('admin/user/') }}/'+response.data.id)

            },
            })
        })
    $('#form-edit').submit(function(e){
        e.preventDefault();
        var url=$(this).attr('data-url');
        $.ajax({
            type: "PUT",
            url: url,

        data: {
            'username': $('#username-edit').val(),
            'email': $('#email-edit').val(),
            'level': ($(".leveledit").prop("checked") ? 1 : 0),
            '_method':'put',

        },                       
        success: function($resuld) {

            $('#edit').modal('hide');
            $('#email').text($resuld.data.email);
            $('#level').text($resuld.data.level);
            $('#mess').show();
            $('#mess').html($resuld.message,{timeOut:5000});
            toastr.success($resuld.data.message);
            window.location.reload();
        },
                        })
                    })






})
   
</script>
@endsection