@extends('admin.master_admin')
@section('content')
<div class="col-lg-12">
    <h1 class="page-header">Promotion
        <small>List</small>
    </h1>
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
                                <th>Promotion (%)</th>
                                <th>Quantity</th>
                                <th>End Date</th>
                                <th>Status</th>
                                <th colspan="2">Action</th>
                            </tr>
                        </thead>
                        <tbody id="bodydd">
                            @foreach($promotions as $key=>$item)
                            <tr class="odd gradeX" align="center">
                                <td>{{$key++}}</td>
                                <td id="product_id">{{$item->products->name}}</td>
                                <td id="price">{{$item->price}}%</td>
                                <td id="start_date">{{$item->quantity}}</td>
                                <td id="end_date">{{$item->end_date}}</td>
                                <td id="status">
                                    @if($item->status == 0) {{"Còn khuyến mãi"}}
                                    @else {{"Hết khuyến mãi"}}
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


         // $('#form-search').submit(function(e){
         //                e.preventDefault();
         //                // console.log(url);
         //                $.ajax({
         //                    type: 'get',
         //                    url: 'product/search',
         //                data: {
         //                    'search': $('#search').val(),  //biến phải trùng vs tên REQUEST 
         //                },
         //                success: function(ab) {
         //                    $('#bodydd').html(ab);
         //        var html ='';
         //            $.each(ab.data,function($key,$value){
         //                $.each(ab.categories,function($keyy,$values){
         //                     if ($value['category_id' ] == $values['id']) {
         //                    $a = $values['name'];
         //                    }
         //                });
         //        html +='<tr><td>'+$value['id']+'</td><td>'+$value['name']+'</td><td>'+$a+'</td><td>'+$value['quantity']+'</td><td><a href="http://127.0.0.1/admin/product/'+$value['id']+'">Show</a></td><td class="center"><button data-url="http://127.0.0.1/admin/product/'+$value['id']+'/edit" class="btn btn-primary btn-edit" data-toggle="modal" data-target="#edit" type="button"><i class="fa fa-pencil fa-fw" ></i> </button></td><td class="center"><button data-url="http://127.0.0.1/admin/product/'+$value['id']+'"​ type="button" data-target="#delete" data-toggle="modal" class="btn btn-danger btn-delete"><i class="fa fa-trash-o  fa-fw"></i></button></td>';
         //                html += '</tr>';
         //            });
         //        $('#bodydd').html(html);




         //                    }

         //                })
         //            })





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

// $('.st1').click(function(e){
//         e.preventDefault();
//         $.ajax({
//             type:'get',
//             url: 'product/sort-remains',
            
//             success:function(ab){
//                 // console.log(ab.categories.id);
                
//                 $('#bodydd').html(ab);
//                 // window.location.reload();
//                 var html ='';
//                     $.each(ab.data,function($key,$value){
//                         $.each(ab.categories,function($keyy,$values){
//                              if ($value['category_id' ] == $values['id']) {
//                             $a = $values['name'];
//                             }
//                         });
//                 html +='<tr><td>'+$value['id']+'</td><td>'+$value['name']+'</td><td>'+$a+'</td><td>'+$value['quantity']+'</td><td><a href="http://127.0.0.1/admin/product/'+$value['id']+'">Show</a></td><td class="center"><button data-url="http://127.0.0.1/admin/product/'+$value['id']+'/edit" class="btn btn-primary btn-edit" data-toggle="modal" data-target="#edit" type="button"><i class="fa fa-pencil fa-fw" ></i> </button></td><td class="center"><button data-url="http://127.0.0.1/admin/product/'+$value['id']+'"​ type="button" data-target="#delete" data-toggle="modal" class="btn btn-danger btn-delete"><i class="fa fa-trash-o  fa-fw"></i></button></td>';
//                         html += '</tr>';
//                     });
//                 $('#bodydd').html(html);
//             }
//         })
//     })
// $('.st2').click(function(e){
//         e.preventDefault();
//         $.ajax({
//             type:'get',
//             url: 'product/sort-almost',
            
//             success:function(ab){
//                 // console.log(ab.categories.id);
                
//                 $('#bodydd').html(ab);
//                 // window.location.reload();
//                 var html ='';
//                     $.each(ab.data,function($key,$value){
//                         $.each(ab.categories,function($keyy,$values){
//                              if ($value['category_id' ] == $values['id']) {
//                             $a = $values['name'];
//                             }
//                         });
//                 html +='<tr><td>'+$value['id']+'</td><td>'+$value['name']+'</td><td>'+$a+'</td><td>'+$value['quantity']+'</td><td><a href="http://127.0.0.1/admin/product/'+$value['id']+'">Show</a></td><td class="center"><button data-url="http://127.0.0.1/admin/product/'+$value['id']+'/edit" class="btn btn-primary btn-edit" data-toggle="modal" data-target="#edit" type="button"><i class="fa fa-pencil fa-fw" ></i> </button></td><td class="center"><button data-url="http://127.0.0.1/admin/product/'+$value['id']+'"​ type="button" data-target="#delete" data-toggle="modal" class="btn btn-danger btn-delete"><i class="fa fa-trash-o  fa-fw"></i></button></td>';
//                         html += '</tr>';
//                     });
//                 $('#bodydd').html(html);
//             }
//         })
//     })

//   $('.st3').click(function(e){
//         e.preventDefault();
//         $.ajax({
//             type:'get',
//             url: 'product/sort-out',
            
//             success:function(ab){
//                 // console.log(ab.categories.id);
                
//                 $('#bodydd').html(ab);
//                 // window.location.reload();
//                 var html ='';
//                     $.each(ab.data,function($key,$value){
//                         $.each(ab.categories,function($keyy,$values){
//                              if ($value['category_id' ] == $values['id']) {
//                             $a = $values['name'];
//                             }
//                         });
//                 html +='<tr><td>'+$value['id']+'</td><td>'+$value['name']+'</td><td>'+$a+'</td><td>'+$value['quantity']+'</td><td><a href="http://127.0.0.1/admin/product/'+$value['id']+'">Show</a></td><td class="center"><button data-url="http://127.0.0.1/admin/product/'+$value['id']+'/edit" class="btn btn-primary btn-edit" data-toggle="modal" data-target="#edit" type="button"><i class="fa fa-pencil fa-fw" ></i> </button></td><td class="center"><button data-url="http://127.0.0.1/admin/product/'+$value['id']+'"​ type="button" data-target="#delete" data-toggle="modal" class="btn btn-danger btn-delete"><i class="fa fa-trash-o  fa-fw"></i></button></td>';
//                         html += '</tr>';
//                     });
//                 $('#bodydd').html(html);
//             }
//         })
//     })




    
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
                error: function (jqXHR, textStatus, errorThrown) {
                    //xử lý lỗi tại đây
                }
            })
        }
    })
     $('.btn-edit').click(function(e){
        $('.error1').hide();
        $('.error2').hide();
        $('.error34').hide();


        var url = $(this).attr('data-url');
        e.preventDefault();

        $.ajax({
                //phương thức get
                type: 'get',
                url: url,
                success: function (response) {  //neu click thanh cong 
                    //đưa dữ liệu controller gửi về điền vào input trong form edit.
                    $('#price-edit').val(response.data.price);
                    $('#quantity-edit').val(response.data.quantity);
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

                            'user_id': $('.idUser').val(),  
                            'product_id': $('.idProduct').val(),
                            'price': $('#price-edit').val(),
                            'quantity': $('#quantity-edit').val(),
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
                                if ($resuld.mess.quantity) {
                                     $('.error2').show();
                                     $('.error2').text($resuld.mess.quantity);
                                 } else {
                                    $('.error2').hide();
                                    $('.error34').hide();
                                }

                            }else if ($resuld.errorss == 'true') {
                                    $('.error34').show();
                                     $('.error34').text($resuld.thongbao);
                                     $('.error1').hide();
                                    $('.error2').hide();
                            } else {
                                $('.error34').hide();
                            $('#edit').modal('hide');
                            $('#product_id').text($resuld.data.product_id);
                            $('#price').text($resuld.data.price);
                            $('#quantity').text($resuld.data.quantity);
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
               
