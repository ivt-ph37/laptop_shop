@extends('admin.master_admin')
@section('content')
<div class="col-lg-12">
                        <h1 class="page-header">Order
                            <small>List</small>
                        </h1>
    <div>
        <div style="float: left;width: 50%;">
<form action="" method="get" id="form-search">
        @csrf
    <div class="input-group custom-search-form" style="width: 75%;">
        <input type="text" class="form-control" id="search" name="search" placeholder="Search...">
        <span class="input-group-btn">
            <button class="btn btn-default" id="butsearch" type="submit"  >
                <i class="fa fa-search"></i>
            </button>
        </span>
    </div>
</form>
        </div>
        <div class="btn-group">
  <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    Sort orders
  </button>
  <div class="dropdown-menu dropdown-menu-right">
    <button class="dropdown-item oldorder" type="button">Old orders</button>
    <button class="dropdown-item neworder" type="button" >New orders</button>
  </div>
</div>
<div class="btn-group" style="margin-left: 7%;">
  <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    Sort Status
  </button>
  <div class="dropdown-menu dropdown-menu-right">
    <button class="dropdown-item st1" type="button">Chờ xử lý</button>
    <button class="dropdown-item st2" type="button">Đang giao hàng</button>
    <button class="dropdown-item st3" type="button">Hoàn thành</button>
  </div>
</div>
    </div>

</div>

<div class="alert alert-success" id="mess" role="alert">
    </div>
                    <!-- /.col-lg-12 -->
                    <table class="table table-striped table-bordered table-hover" id="anhyeuem">

                        <thead>
                            <tr align="center">
                                <th>ID</th>
                                <th>Username</th>
                                <th>Email</th>
                                <th>Order_Date</th>
                                <th>Delivery_Date</th>
                                <th>Deliver_Status</th>
                                <th></th>
                                <th colspan="2">Action</th>
                            </tr>
                        </thead>
                        <tbody id="bodydd">
                            @foreach($orders as $item)
                            <tr class="odd gradeX" align="center">
                                <td>{{$item->id}}</td>
                                <td>{{$item->username}}</td>
                                <td>{{$item->email}}</td>
                                <td>{{$item->order_date}}</td>
                                <td>{{$item->delivery_date}}</td>
                                <td id="deliver_status">
                                    @if($item->deliver_status == 0)
                                        {{"Chờ xử lý"}}
                                    @elseif($item->deliver_status == 1)
                                        {{"Đang giao hàng"}}
                                    @else 
                                        {{"Hoàn thành"}}
                                    @endif
                                </td>
                                <td><a href="{{route('order.show',$item->id)}}">Show</a></td>
                                <td class="center">
                <button data-url="{{route('order.edit',$item->id)}}" class="btn btn-primary btn-edit" data-toggle="modal" data-target="#edit" type="button"><i class="fa fa-pencil fa-fw" ></i> </button>
            </td>
            <td class="center">
                <button data-url="{{ route('order.destroy',$item->id) }}"​ type="button" data-target="#delete" data-toggle="modal" class="btn btn-danger btn-delete"><i class="fa fa-trash-o  fa-fw"></i></button>
            </td>
                                
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                {{$orders->links()}}
@include('admin.order.edit')

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
                        e.preventDefault();
                        // console.log(url);
                        $.ajax({
                            type: 'get',
                            url: 'order/search',
                        data: {
                            'search': $('#search').val(),  //biến phải trùng vs tên REQUEST 
                        },
                        success: function(ab) {
                            $('#bodydd').html(ab);
                var html ='';
                    $.each(ab.data,function($key,$value){
             if ($value['deliver_status'] == 0) {
                            $a = 'Chờ xử lý';
                        } else if ($value['deliver_status'] == 1) {
                            $a = 'Đang giao hàng';
                        } else {
                            $a = 'Hoàn thành';
                        } 
                        
                html +='<tr><td>'+$value['id']+'</td><td>'+$value['username']+'</td><td>'+$value['email']+'</td><td>'+$value['order_date']+'</td><td>'+$value['delivery_date']+'</td><td>'+$a+'</td><td><a href="http://127.0.0.1/admin/order/'+$value['id']+'">Show</a></td><td class="center"><button data-url="http://127.0.0.1/admin/order/'+$value['id']+'/edit" class="btn btn-primary btn-edit" data-toggle="modal" data-target="#edit" type="button"><i class="fa fa-pencil fa-fw" ></i> </button></td><td class="center"><button data-url="http://127.0.0.1/admin/order/'+$value['id']+'"​ type="button" data-target="#delete" data-toggle="modal" class="btn btn-danger btn-delete"><i class="fa fa-trash-o  fa-fw"></i></button></td>';
                        html += '</tr>';
                    });
                $('#bodydd').html(html);
                            }

                        })
                    })

    $('.neworder').click(function(e){
        e.preventDefault();
        $.ajax({
            type:'get',
            url: 'order/new',
            
            success:function(ab){
                // console.log(ab.data);
                
                $('#bodydd').html(ab);
                // window.location.reload();
                var html ='';
                    $.each(ab.data,function($key,$value){
                        if ($value['deliver_status'] == 0) {
                            $a = 'Chờ xử lý';
                        } else if ($value['deliver_status'] == 1) {
                            $a = 'Đang giao hàng';
                        } else {
                            $a = 'Hoàn thành';
                        } 
                        
                html +='<tr><td>'+$value['id']+'</td><td>'+$value['username']+'</td><td>'+$value['email']+'</td><td>'+$value['order_date']+'</td><td>'+$value['delivery_date']+'</td><td>'+$a+'</td><td><a href="http://127.0.0.1/admin/order/'+$value['id']+'">Show</a></td><td class="center"><button data-url="http://127.0.0.1/admin/order/'+$value['id']+'/edit" class="btn btn-primary btn-edit" data-toggle="modal" data-target="#edit" type="button"><i class="fa fa-pencil fa-fw" ></i> </button></td><td class="center"><button data-url="http://127.0.0.1/admin/order/'+$value['id']+'"​ type="button" data-target="#delete" data-toggle="modal" class="btn btn-danger btn-delete"><i class="fa fa-trash-o  fa-fw"></i></button></td>';
                        html += '</tr>';
                    });
                $('#bodydd').html(html);
            }
        })
    })
     $('.oldorder').click(function(e){
        e.preventDefault();
        $.ajax({
            type:'get',
            url: 'order/old',
            
            success:function(ab){
                // console.log(ab.data);
                
                $('#bodydd').html(ab);
                // window.location.reload();
                var html ='';
                    $.each(ab.data,function($key,$value){
                        if ($value['deliver_status'] == 0) {
                            $a = 'Chờ xử lý';
                        } else if ($value['deliver_status'] == 1) {
                            $a = 'Đang giao hàng';
                        } else {
                            $a = 'Hoàn thành';
                        } 
                        
            html +='<tr><td>'+$value['id']+'</td><td>'+$value['username']+'</td><td>'+$value['email']+'</td><td>'+$value['order_date']+'</td><td>'+$value['delivery_date']+'</td><td>'+$a+'</td><td><a href="http://127.0.0.1/admin/order/'+$value['id']+'">Show</a></td><td class="center"><button data-url="http://127.0.0.1/admin/order/'+$value['id']+'/edit" class="btn btn-primary btn-edit" data-toggle="modal" data-target="#edit" type="button"><i class="fa fa-pencil fa-fw" ></i> </button></td><td class="center"><button data-url="http://127.0.0.1/admin/order/'+$value['id']+'"​ type="button" data-target="#delete" data-toggle="modal" class="btn btn-danger btn-delete"><i class="fa fa-trash-o  fa-fw"></i></button></td>';
                        html += '</tr>';
                    });
                $('#bodydd').html(html);
            }
        })
    })
     $('.st1').click(function(e){
        e.preventDefault();
        $.ajax({
            type:'get',
            url: 'order/statu',
            
            success:function(ab){
                // console.log(ab.data);
                
                $('#bodydd').html(ab);
                // window.location.reload();
                var html ='';
                    $.each(ab.data,function($key,$value){
                        if ($value['deliver_status'] == 0) {
                            $a = 'Chờ xử lý';
                        } else if ($value['deliver_status'] == 1) {
                            $a = 'Đang giao hàng';
                        } else {
                            $a = 'Hoàn thành';
                        } 
                        
html +='<tr><td>'+$value['id']+'</td><td>'+$value['username']+'</td><td>'+$value['email']+'</td><td>'+$value['order_date']+'</td><td>'+$value['delivery_date']+'</td><td>'+$a+'</td><td><a href="http://127.0.0.1/admin/order/'+$value['id']+'">Show</a></td><td class="center"><button data-url="http://127.0.0.1/admin/order/'+$value['id']+'/edit" class="btn btn-primary btn-edit" data-toggle="modal" data-target="#edit" type="button"><i class="fa fa-pencil fa-fw" ></i> </button></td><td class="center"><button data-url="http://127.0.0.1/admin/order/'+$value['id']+'"​ type="button" data-target="#delete" data-toggle="modal" class="btn btn-danger btn-delete"><i class="fa fa-trash-o  fa-fw"></i></button></td>';
                        html += '</tr>';
                    });
                $('#bodydd').html(html);
            }
        })
    })
     $('.st2').click(function(e){
        e.preventDefault();
        $.ajax({
            type:'get',
            url: 'order/status',
            
            success:function(ab){
                // console.log(ab.data);
                
                $('#bodydd').html(ab);
                // window.location.reload();
                var html ='';
                    $.each(ab.data,function($key,$value){
                        if ($value['deliver_status'] == 0) {
                            $a = 'Chờ xử lý';
                        } else if ($value['deliver_status'] == 1) {
                            $a = 'Đang giao hàng';
                        } else {
                            $a = 'Hoàn thành';
                        } 
                        
html +='<tr><td>'+$value['id']+'</td><td>'+$value['username']+'</td><td>'+$value['email']+'</td><td>'+$value['order_date']+'</td><td>'+$value['delivery_date']+'</td><td>'+$a+'</td><td><a href="http://127.0.0.1/admin/order/'+$value['id']+'">Show</a></td><td class="center"><button data-url="http://127.0.0.1/admin/order/'+$value['id']+'/edit" class="btn btn-primary btn-edit" data-toggle="modal" data-target="#edit" type="button"><i class="fa fa-pencil fa-fw" ></i> </button></td><td class="center"><button data-url="http://127.0.0.1/admin/order/'+$value['id']+'"​ type="button" data-target="#delete" data-toggle="modal" class="btn btn-danger btn-delete"><i class="fa fa-trash-o  fa-fw"></i></button></td>';
                        html += '</tr>';
                    });
                $('#bodydd').html(html);
            }
        })
    })
     $('.st3').click(function(e){
        e.preventDefault();
        $.ajax({
            type:'get',
            url: 'order/statuss',
            
            success:function(ab){
                // console.log(ab.data);
                
                $('#bodydd').html(ab);
                // window.location.reload();
                var html ='';
                    $.each(ab.data,function($key,$value){
                        if ($value['deliver_status'] == 0) {
                            $a = 'Chờ xử lý';
                        } else if ($value['deliver_status'] == 1) {
                            $a = 'Đang giao hàng';
                        } else {
                            $a = 'Hoàn thành';
                        } 
                        
html +='<tr><td>'+$value['id']+'</td><td>'+$value['username']+'</td><td>'+$value['email']+'</td><td>'+$value['order_date']+'</td><td>'+$value['delivery_date']+'</td><td>'+$a+'</td><td><a href="http://127.0.0.1/admin/order/'+$value['id']+'">Show</a></td><td class="center"><button data-url="http://127.0.0.1/admin/order/'+$value['id']+'/edit" class="btn btn-primary btn-edit" data-toggle="modal" data-target="#edit" type="button"><i class="fa fa-pencil fa-fw" ></i> </button></td><td class="center"><button data-url="http://127.0.0.1/admin/order/'+$value['id']+'"​ type="button" data-target="#delete" data-toggle="modal" class="btn btn-danger btn-delete"><i class="fa fa-trash-o  fa-fw"></i></button></td>';
                        html += '</tr>';
                    });
                $('#bodydd').html(html);
            }
        })
    })





    $('.btn-delete').click(function(){
        var url = $(this).attr('data-url');
        var _this = $(this);
        if (confirm('Ban co chac muon xoa khong?')) {
            $.ajax({
                headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
                type: 'delete',
                url: url,
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
    $('.btn-edit').click(function(e){

        var url = $(this).attr('data-url');

        e.preventDefault();

        $.ajax({
                //phương thức get
                type: 'get',
                url: url,
                success: function (response) {
                    $('.tittle').text(response.data.username);
                    $('#username-edit').val(response.data.username);
                    $('#email-edit').val(response.data.email);
                    if(response.data.deliver_status == 0){
                        $('#option0').attr('selected','selected');
                    }else if(response.data.deliver_status == 1){
                        $('#option1').attr('selected','selected');
                    }
                    else{
                        $('#option2').attr('selected','selected');
                    }
                     $('#form-edit').attr('data-url','{{ asset('admin/order/') }}/'+response.data.id)

                },
                error: function (error) {
                    
                }
            })
        })
    $('#form-edit').submit(function(e){
                        e.preventDefault();
                        var url=$(this).attr('data-url');
                        $.ajax({
                            type: "PUT",
                            url: url,

                        data: {
                            'deliver_status': $('#deliver_status-edit').val(),
                            '_method':'put',

                        },                       
                        success: function($resuld) {
                            $('#deliver_status').text($resuld.data.deliver_status);
                            $('#mess').show();
                            $('#mess').html($resuld.message,{timeOut:5000});
                            toastr.success($resuld.message);
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