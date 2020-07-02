@extends('admin.master_admin')
@section('content')
<div class="col-lg-12">
    <h1 class="page-header">Promotion
        <small>List</small>
    </h1>
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
    Sắp Xếp
  </button>
  <div class="dropdown-menu dropdown-menu-right">
    <button class="dropdown-item st1" type="button" style="width: 100%;" value="1">Khuyến mãi</button>
    <button class="dropdown-item st2" type="button" style="width: 100%;" value="2">Hết khuyến mãi</button>
  </div>
</div>
@if(session('thongbao'))
    <div class="alert alert-success" role="alert">
        {{session('thongbao')}}
    </div>
@endif

   <div class="alert alert-success" id="mess" role="alert">
    </div>
</div>
<div id="table_pag">
                <!-- /.col-lg-12 -->

<table class="table table-striped table-bordered table-hover" id="dataTables-example">
    <thead>
        <tr align="center">
            <th>STT</th>
            <th>Name Product</th>
            <th>Promotion</th>
            <th>End Date</th>
            <th>Status</th>
            <th colspan="2">Action</th>
        </tr>
    </thead>
    <tbody id="bodydd">
        @foreach($promotions as $key=>$item)
        <tr class="odd gradeX" align="center">
            <td>{{$item->id}}</td>
            <td id="product_id">{{$item->products->name}}</td>
            <td id="price">{{$item->price}}$</td>
            <td id="end_date">{{$item->end_date}}</td>
            <td id="status">
                @if($item->status == 0) {{"Hết khuyến mãi"}}
                @else {{"Khuyến mãi"}}
                @endif
            </td>
            <td class="center">
                <button data-url="{{route('promotion.edit',$item->id)}}" class="btn btn-primary btn-edit" data-toggle="modal" data-target="#edit" type="button"><i class="fa fa-pencil fa-fw" ></i> </button>
            </td>
            <td class="center">
                <button data-url="{{ route('promotion.destroy',$item->id) }}"​ type="button" data-target="#delete" data-toggle="modal" class="btn btn-danger btn-delete"><i class="fa fa-trash-o  fa-fw"></i></button>
            </td>
                                
        </tr>
            @endforeach
    </tbody>
</table>
            {{$promotions->links()}}
</div>
@include('admin.promotions.edit')


@endsection


@section('sr')

<script>
$(document).ready(function () {
    $('#mess').hide();


    $('#form-search').submit(function(e){
        $('.pagination').hide();
        e.preventDefault();
        $.ajax({
            type: 'get',
            url: 'promotion/search',
        data: {
            'search': $('#search').val(),  
        },
        success: function($resuld) {
            $('#bodydd').html($resuld);
            var html ='';
            $.each($resuld.data,function($key,$value){
                if ($value['status'] == 1) {
                    $value['status'] = 'Khuyến mãi';
                } else {
                    $value['status'] = 'Hết khuyến mãi';
                }
                $.each($resuld.products,function($keyy,$values){
                     if ($value['product_id' ] == $values['id']) {
                    $a = $values['name'];
                    html +='<tr><td>'+$value['id']+'</td><td>'+$a+'</td><td>'+$value['price']+'</td><td>'+$value['end_date']+'</td><td>'+$value['status']+'</td><td class="center"><button data-url="http://127.0.0.1/admin/promotion/'+$value['id']+'/edit" class="btn btn-primary btn-edit" data-toggle="modal" data-target="#edit" type="button"><i class="fa fa-pencil fa-fw" ></i> </button></td><td class="center"><button data-url="http://127.0.0.1/admin/promotion/'+$value['id']+'"​ type="button" data-target="#delete" data-toggle="modal" class="btn btn-danger btn-delete"><i class="fa fa-trash-o  fa-fw"></i></button></td>';
                html += '</tr>';
                    }
                });
                
        
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
            url: 'promotion/sort/'+id,
            
            success:function($resuld){
                $('#bodydd').html($resuld);
                var html ='';
                $.each($resuld.data,function($key,$value){
                    $.each($resuld.products,function($keyy,$values){
                        if ($value['product_id' ] == $values['id']) {
                            $a = $values['name'];
                            }
                        });
                        $value['status'] = 'Khuyến mãi';
                         html +='<tr><td>'+$value['id']+'</td><td>'+$a+'</td><td>'+$value['price']+'</td><td>'+$value['end_date']+'</td><td>'+$value['status']+'</td><td class="center"><button data-url="http://127.0.0.1/admin/promotion/'+$value['id']+'/edit" class="btn btn-primary btn-edit" data-toggle="modal" data-target="#edit" type="button"><i class="fa fa-pencil fa-fw" ></i> </button></td><td class="center"><button data-url="http://127.0.0.1/admin/promotion/'+$value['id']+'"​ type="button" data-target="#delete" data-toggle="modal" class="btn btn-danger btn-delete"><i class="fa fa-trash-o  fa-fw"></i></button></td>';
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
            url: 'promotion/sort/'+id,
            success:function($resuld){
                $('#bodydd').html($resuld);
                var html ='';
                $.each($resuld.data,function($key,$value){
                    $.each($resuld.products,function($keyy,$values){
                        if ($value['product_id' ] == $values['id']) {
                            $a = $values['name'];
                            }
                        });
                            $value['status'] = 'Hết khuyến mãi';

                html +='<tr><td>'+$value['id']+'</td><td>'+$a+'</td><td>'+$value['price']+'</td><td>'+$value['end_date']+'</td><td>'+$value['status']+'</td><td class="center"><button data-url="http://127.0.0.1/admin/promotion/'+$value['id']+'/edit" class="btn btn-primary btn-edit" data-toggle="modal" data-target="#edit" type="button"><i class="fa fa-pencil fa-fw" ></i> </button></td><td class="center"><button data-url="http://127.0.0.1/admin/promotion/'+$value['id']+'"​ type="button" data-target="#delete" data-toggle="modal" class="btn btn-danger btn-delete"><i class="fa fa-trash-o  fa-fw"></i></button></td>';
                        html += '</tr>';
                    });
                $('#bodydd').html(html);
            }
        })
    })



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
        $('.error1').hide();
        $('.error34').hide();
        var url = $(this).attr('data-url');
        e.preventDefault();

        $.ajax({
                type: 'get',
                url: url,
                success: function (response) {  
                    $('#price-edit').val(response.data.price);
                    $('#start_date-edit').val(response.data.start_date);
                    $('#end_date-edit').val(response.data.end_date);
                    var html ='';
                    $.each(response.users,function($key,$value){
                        if ($value['id']==response.data.user_id) {
                            html +='<option value='+$value['id']+' selected>';
                                html += $value['fullname'];
                            html += '</option>';
                        }else{
                            html +='<option value='+$value['id']+' >';
                                html += $value['fullname'];
                            html += '</option>';
                        }
                    });
                        $('.idUser').html(html);
                        var html1 ='';
                    $.each(response.products,function($key,$value){
                        if ($value['id']==response.data.product_id) {
                            html1 +='<option value='+$value['id']+' selected>';
                                html1 += $value['name'];
                            html1 += '</option>';
                        }else{
                            html1 +='<option value='+$value['id']+' >';
                                html1 += $value['name'];
                            html1 += '</option>';
                        }
                    });
                        $('.idProduct').html(html1);                      
                    $('#form-edit').attr('data-url','{{ asset('admin/promotion/') }}/'+response.data.id)
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
            _token: '{{csrf_token()}}' ,
            'user_id': $('.idUser').val(),  
            'product_id': $('.idProduct').val(),
            'price': $('#price-edit').val(),
            'start_date': $('#start_date-edit').val(),
            'end_date': $('#end_date-edit').val(),

            '_method':'put',
         },
        success: function($resuld) {
            $('.error34').hide();
            if($resuld.error == 'true'){
                $('.error34').hide();
                if ($resuld.mess.price) {
                    $('.error1').show();
                    $('.error1').text($resuld.mess.price);
                } else {
                      $('.error1').hide(); 
                      $('.error34').hide();                                   
                }

            }else if ($resuld.errorsss == 'true') {
                     $('.error1').show();
                    $('.error1').text($resuld.thongbaoo);
            }
            else if ($resuld.errorss == 'true') {
                    $('.error34').show();
                     $('.error34').text($resuld.thongbao);
                     $('.error1').hide();
            } else {
                $('.error34').hide();
            $('#edit').hide();
            $('#product_id').text($resuld.data.product_id);
            $('#price').text($resuld.data.price);
            $('#end_date').text($resuld.data.end_date);
            $('#status').text($resuld.data.status);
            $('#mess').show();
            $('#mess').html($resuld.message,{timeOut:5000});
            window.location.reload();
        }

                        },

                        })
                    })



})
   
</script>
@endsection
               
