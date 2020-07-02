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
  <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="width: 166px;">
    Đơn hàng
  </button>
  <div class="dropdown-menu dropdown-menu-right">
    <button class="dropdown-item oldorder" type="button" style="width: 100%;" value="0">Mới</button>
    <button class="dropdown-item neworder" type="button" style="width: 100%;" value="1">Cũ</button>
  </div>
</div>
<div class="btn-group" style="margin-left: 7%;">
  <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="width: 166px;">
    Trạng thái
  </button>
  <div class="dropdown-menu dropdown-menu-right">
    <button class="dropdown-item st1" type="button" style="width: 100%;" value="1">Chờ xử lý</button>
    <button class="dropdown-item st2" type="button" style="width: 100%;" value="2">Đang giao hàng</button>
    <button class="dropdown-item st3" type="button" style="width: 100%;" value="3">Hoàn thành</button>
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
                                <th>STT</th>
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
                            @foreach($orders as $key=>$item)
                            <tr class="odd gradeX" align="center">
                                <td>{{$item->id}}</td>
                                <td>{{$item->username}}</td>
                                <td>{{$item->email}}</td>
                                <td>{{$item->order_date}}</td>
                                <td id="delivery_date">{{$item->delivery_date}}</td>
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
                        $.ajax({
                            type: 'get',
                            url: 'order/search',
                        data: {
                            'search': $('#search').val(),  
                        },
                        success: function($resuld) {
                            $('#bodydd').html($resuld);
                            var html ='';
                            $.each($resuld.data,function($key,$value){
                                if ($value['deliver_status'] == 0) {
                                    $a = 'Chờ xử lý';
                                } else if ($value['deliver_status'] == 1) {
                                    $a = 'Đang giao hàng';
                                } else {
                                    $a = 'Hoàn thành';
                                }
                                if ($value['delivery_date'] == null) {
                                    $value['delivery_date'] ='';
                                } 
                                
                                html +='<tr><td>'+$value['id']+'</td><td>'+$value['username']+'</td><td>'+$value['email']+'</td><td>'+$value['order_date']+'</td><td>'+$value['delivery_date']+'</td><td>'+$a+'</td><td><a href="http://127.0.0.1/admin/order/'+$value['id']+'">Show</a></td><td class="center"><button data-url="http://127.0.0.1/admin/order/'+$value['id']+'/edit" class="btn btn-primary btn-edit" data-toggle="modal" data-target="#edit" type="button"><i class="fa fa-pencil fa-fw" ></i> </button></td><td class="center"><button data-url="http://127.0.0.1/admin/order/'+$value['id']+'"​ type="button" data-target="#delete" data-toggle="modal" class="btn btn-danger btn-delete"><i class="fa fa-trash-o  fa-fw"></i></button></td>';
                                html += '</tr>';
                                         });
                                $('#bodydd').html(html);
                            }

                        })
                    })


        $(document).on('click', '.neworder', function(e){
            $('.pagination').hide();
            var id= $(this).attr('value');
            e.preventDefault();
            $.ajax({
            type:'get',
            url: 'order/sort/'+id,
            
            success:function($resuld){       
                $('#bodydd').html($resuld);
                var html ='';
                    $.each($resuld.data,function($key,$value){
                        if ($value['deliver_status'] == 0) {
                            $a = 'Chờ xử lý';
                        } else if ($value['deliver_status'] == 1) {
                            $a = 'Đang giao hàng';
                        } else {
                            $a = 'Hoàn thành';
                        } 
                        if ($value['delivery_date'] == null) {
                            $value['delivery_date'] ='';
                }    
                        html +='<tr><td>'+$value['id']+'</td><td>'+$value['username']+'</td><td>'+$value['email']+'</td><td>'+$value['order_date']+'</td><td>'+$value['delivery_date']+'</td><td>'+$a+'</td><td><a href="http://127.0.0.1/admin/order/'+$value['id']+'">Show</a></td><td class="center"><button data-url="http://127.0.0.1/admin/order/'+$value['id']+'/edit" class="btn btn-primary btn-edit" data-toggle="modal" data-target="#edit" type="button"><i class="fa fa-pencil fa-fw" ></i> </button></td><td class="center"><button data-url="http://127.0.0.1/admin/order/'+$value['id']+'"​ type="button" data-target="#delete" data-toggle="modal" class="btn btn-danger btn-delete"><i class="fa fa-trash-o  fa-fw"></i></button></td>';
                        html += '</tr>';
                    });
                $('#bodydd').html(html);
            }
        })
    })

    $(document).on('click', '.oldorder', function(e){
        $('.pagination').hide();
        var id= $(this).attr('value');
        e.preventDefault();
        $.ajax({
            type:'get',
            url: 'order/sort/'+id,
            success:function($resuld){
                $('#bodydd').html($resuld);
                var html ='';
                    $.each($resuld.data,function($key,$value){
                        if ($value['deliver_status'] == 0) {
                            $a = 'Chờ xử lý';
                        } else if ($value['deliver_status'] == 1) {
                            $a = 'Đang giao hàng';
                        } else {
                            $a = 'Hoàn thành';
                        } 
                       if ($value['delivery_date'] == null) {
                        $value['delivery_date'] ='';
                     }      
                        html +='<tr><td>'+$value['id']+'</td><td>'+$value['username']+'</td><td>'+$value['email']+'</td><td>'+$value['order_date']+'</td><td>'+$value['delivery_date']+'</td><td>'+$a+'</td><td><a href="http://127.0.0.1/admin/order/'+$value['id']+'">Show</a></td><td class="center"><button data-url="http://127.0.0.1/admin/order/'+$value['id']+'/edit" class="btn btn-primary btn-edit" data-toggle="modal" data-target="#edit" type="button"><i class="fa fa-pencil fa-fw" ></i> </button></td><td class="center"><button data-url="http://127.0.0.1/admin/order/'+$value['id']+'"​ type="button" data-target="#delete" data-toggle="modal" class="btn btn-danger btn-delete"><i class="fa fa-trash-o  fa-fw"></i></button></td>';
                        html += '</tr>';
                    });
                $('#bodydd').html(html);
            }
        })
    })

    $(document).on('click', '.st1', function(e){
        $('.pagination').hide();
        var id= $(this).attr('value');
        e.preventDefault();
        $.ajax({
            type:'get',
            url: 'order/status/'+id,
            success:function($resuld){
              
                $('#bodydd').html($resuld);
                var html ='';
                    $.each($resuld.data,function($key,$value){
                        if ($value['deliver_status'] == 0) {
                            $a = 'Chờ xử lý';
                        } else if ($value['deliver_status'] == 1) {
                            $a = 'Đang giao hàng';
                        } else {
                            $a = 'Hoàn thành';
                        } 
                        if ($value['delivery_date'] == null) {
                        $value['delivery_date'] ='';
                         } 
                        html +='<tr><td>'+$value['id']+'</td><td>'+$value['username']+'</td><td>'+$value['email']+'</td><td>'+$value['order_date']+'</td><td>'+$value['delivery_date']+'</td><td>'+$a+'</td><td><a href="http://127.0.0.1/admin/order/'+$value['id']+'">Show</a></td><td class="center"><button data-url="http://127.0.0.1/admin/order/'+$value['id']+'/edit" class="btn btn-primary btn-edit" data-toggle="modal" data-target="#edit" type="button"><i class="fa fa-pencil fa-fw" ></i> </button></td><td class="center"><button data-url="http://127.0.0.1/admin/order/'+$value['id']+'"​ type="button" data-target="#delete" data-toggle="modal" class="btn btn-danger btn-delete"><i class="fa fa-trash-o  fa-fw"></i></button></td>';
                        html += '</tr>';
                    });
                $('#bodydd').html(html);
            }
        })
    })

    $(document).on('click', '.st2', function(e){
        $('.pagination').hide();
        var id= $(this).attr('value');
        e.preventDefault();
        $.ajax({
            type:'get',
            url: 'order/status/'+id,
            
            success:function($resuld){
                $('#bodydd').html($resuld);
                var html ='';
                    $.each($resuld.data,function($key,$value){
                        if ($value['deliver_status'] == 0) {
                            $a = 'Chờ xử lý';
                        } else if ($value['deliver_status'] == 1) {
                            $a = 'Đang giao hàng';
                        } else {
                            $a = 'Hoàn thành';
                        } 
                        if ($value['delivery_date'] == null) {
                    $value['delivery_date'] ='';
                } 
                html +='<tr><td>'+$value['id']+'</td><td>'+$value['username']+'</td><td>'+$value['email']+'</td><td>'+$value['order_date']+'</td><td>'+$value['delivery_date']+'</td><td>'+$a+'</td><td><a href="http://127.0.0.1/admin/order/'+$value['id']+'">Show</a></td><td class="center"><button data-url="http://127.0.0.1/admin/order/'+$value['id']+'/edit" class="btn btn-primary btn-edit" data-toggle="modal" data-target="#edit" type="button"><i class="fa fa-pencil fa-fw" ></i> </button></td><td class="center"><button data-url="http://127.0.0.1/admin/order/'+$value['id']+'"​ type="button" data-target="#delete" data-toggle="modal" class="btn btn-danger btn-delete"><i class="fa fa-trash-o  fa-fw"></i></button></td>';
                        html += '</tr>';
                    });
                $('#bodydd').html(html);
            }
        })
    })
    $(document).on('click', '.st3', function(e){
        $('.pagination').hide();
        var id= $(this).attr('value');
        e.preventDefault();
        $.ajax({
            type:'get',
            url: 'order/status/'+id,
            
            success:function($resuld){
                $('#bodydd').html($resuld);
                var html ='';
                    $.each($resuld.data,function($key,$value){
                        if ($value['deliver_status'] == 0) {
                            $a = 'Chờ xử lý';
                        } else if ($value['deliver_status'] == 1) {
                            $a = 'Đang giao hàng';
                        } else {
                            $a = 'Hoàn thành';
                        } 
                      if ($value['delivery_date'] == null) {
                    $value['delivery_date'] ='';
                }   
                        html +='<tr><td>'+$value['id']+'</td><td>'+$value['username']+'</td><td>'+$value['email']+'</td><td>'+$value['order_date']+'</td><td>'+$value['delivery_date']+'</td><td>'+$a+'</td><td><a href="http://127.0.0.1/admin/order/'+$value['id']+'">Show</a></td><td class="center"><button data-url="http://127.0.0.1/admin/order/'+$value['id']+'/edit" class="btn btn-primary btn-edit" data-toggle="modal" data-target="#edit" type="button"><i class="fa fa-pencil fa-fw" ></i> </button></td><td class="center"><button data-url="http://127.0.0.1/admin/order/'+$value['id']+'"​ type="button" data-target="#delete" data-toggle="modal" class="btn btn-danger btn-delete"><i class="fa fa-trash-o  fa-fw"></i></button></td>';
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
            })
        }
    })
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

 
    $(document).on('submit', '#form-edit', function(e){
        e.preventDefault();
        var url=$(this).attr('data-url');
        $.ajax({
            type: "PUT",
            url: url,

        data: {
            _token: '{{csrf_token()}}',
            'deliver_status': $('#deliver_status-edit').val(),
            '_method':'put',

        },                       
        success: function($resuld) {
            $('#deliver_status').text($resuld.data.deliver_status);
            $('#delivery_date').text($resuld.data.delivery_date);
            $('#mess').show();
            $('#mess').html($resuld.message,{timeOut:5000});
            toastr.success($resuld.message);
            window.location.reload();

        },
        })
    })






})
   
</script>
@endsection