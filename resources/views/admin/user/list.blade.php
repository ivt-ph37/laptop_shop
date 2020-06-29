@extends('admin.master_admin')
@section('content')
<div class="col-lg-12">
                        <h1 class="page-header">User
                            <small>List</small>
                        </h1>
                    </div>

<form action="" method="get" id="form-search">
        @csrf
    <div class="input-group custom-search-form" style="width: 40%;">
        <input type="text" class="form-control" id="search" name="search" placeholder="Search...">
        <span class="input-group-btn">
            <button class="btn btn-default" id="butsearch" type="submit"  >
                <i class="fa fa-search"></i>
            </button>
        </span>
    </div>
    <div ></div>
</form>
<div class="alert alert-success" id="mess" role="alert">
    </div>
                    <!-- /.col-lg-12 -->
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr align="center">
                                <th>STT</th>
                                <th>fullname</th>
                                <th>Email</th>
                                <th>Level</th>
                                <th>Sex</th>
                                <th></th>
                                <th colspan="2">Action</th>
                            </tr>
                        </thead>
                        <tbody id="bodydd">
                            @foreach($users as $key=>$item)
                            <tr class="odd gradeX" align="center">
                                <td>{{$item->id}}</td>
                                <td>{{$item->fullname}}</td>
                                <td id="email">{{$item->email}}</td>
                                <td id="level">
                                    @if($item->level == 1)
                                    {{"Admin"}}
                                    @else
                                        {{"User"}}
                                    @endif
                                </td>
                                <td id="sex">
                                    @if($item->sex == 1)
                                    {{"Nữ"}}
                                    @else
                                        {{"Nam"}}
                                    @endif
                                </td>
                                <td><a href="{{route('user.show',$item->id)}}">Show</a></td>
                                <td class="center">
                <button data-url="{{route('user.edit',$item->id)}}" class="btn btn-primary btn-edit" data-toggle="modal" data-target="#edit" type="button"><i class="fa fa-pencil fa-fw" ></i> </button>
            </td>
            <td class="center">
                <button data-url="{{ route('user.destroy',$item->id) }}"​ type="button" data-target="#delete" data-toggle="modal" class="btn btn-danger btn-delete"><i class="fa fa-trash-o  fa-fw"></i></button>
            </td>
                                
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{$users->links()}}

@include('admin.user.edit')

@endsection

@section('sr')

<script>
$(document).ready(function () {
    $('#mess').hide();

    $('.pagination a').unbind('click').on('click', function(e) {
        e.preventDefault();
        // $('#wrapper').hide();

        var page= $(this).attr('href').split('page=')[1];
        fetch_data(page);
    }) 
    function fetch_data(page){
        $.ajax({
            type:"get",
            url: '?page='+page,
            
            success:function($resuld){
                $('body').html($resuld);
                
            }
        })
    }



          $('#form-search').submit(function(e){
            $('.pagination').hide();
                        e.preventDefault();
                        // console.log(url);
                        $.ajax({
                            type: 'get',
                            url: 'user/search',
                        data: {
                            'search': $('#search').val(),  //biến phải trùng vs tên REQUEST 
                        },
                        success: function(ab) {
                            $('#bodydd').html(ab);
                var html ='';
                    $.each(ab.data,function($key,$value){
                        if ($value['level'] == 1) {
                            $a = 'Admin';
                        } else {
                            $a = 'User';
                        }
                        if ($value['sex'] == 1) {
                            $b = 'Nữ';
                        } else {
                            $b = 'Nam';
                        }


                html +='<tr><td>'+$value['id']+'</td><td>'+$value['fullname']+'</td><td>'+$value['email']+'</td><td>'+$a+'</td><td>'+$b+'</td><td><a href="http://127.0.0.1/admin/user/'+$value['id']+'">Show</a></td><td class="center"><button data-url="http://127.0.0.1/admin/user/'+$value['id']+'/edit" class="btn btn-primary btn-edit" data-toggle="modal" data-target="#edit" type="button"><i class="fa fa-pencil fa-fw" ></i> </button></td><td class="center"><button data-url="http://127.0.0.1/admin/user/'+$value['id']+'"​ type="button" data-target="#delete" data-toggle="modal" class="btn btn-danger btn-delete"><i class="fa fa-trash-o  fa-fw"></i></button></td>';
                        html += '</tr>';
                    });
                $('#bodydd').html(html);
                            }

                        })
                    })



    $(document).on('click', '.btn-delete', function(e){
        var url = $(this).attr('data-url');
        var _this = $(this);
        if (confirm('Ban co chac muon xoa khong?')) {
            $.ajax({
                type: 'delete',
                url: url,
                data: { _token: '{{csrf_token()}}' },
                success: function(response) {
                    alert('Xoa thanh cong');
                    _this.parent().parent().remove();
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    //xử lý lỗi tại đây
                }
            })
        }
    })
    $(document).on('click', '.btn-edit', function(e){

        var url = $(this).attr('data-url');

        e.preventDefault();

        $.ajax({
                //phương thức get
                type: 'get',
                url: url,
                success: function (response) {
                    //đưa dữ liệu controller gửi về điền vào input trong form edit.
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
                error: function (error) {
                    
                }
            })
        })
    $('#form-edit').submit(function(e){
                        e.preventDefault();
                        var url=$(this).attr('data-url');
                // console.log(url);
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
                            error: function (jqXHR, textStatus, errorThrown) {
                                //xử lý lỗi tại đây
                            }
                        })
                    })






})
   
</script>
@endsection