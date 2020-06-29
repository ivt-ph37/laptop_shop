@extends('admin.master_admin')
@section('content')
<div class="col-lg-12">
    <h1 class="page-header">Products
        <small>List</small>
    </h1>
@if(session('thongbao'))
    <div class="alert alert-success" role="alert">
        {{session('thongbao')}}
    </div>
@endif
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
    Sắp Xếp
  </button>
  <div class="dropdown-menu dropdown-menu-right">
    <button class="dropdown-item st1" type="button" style="width: 100%;" value="1">Tất cả</button>
    <button class="dropdown-item st2" type="button" style="width: 100%;" value="2">Sắp Hết</button>
    <button class="dropdown-item st3" type="button" style="width: 100%;" value="3">Đã hết</button>
  </div>
</div>
    </div>
   <div class="alert alert-success" id="mess" role="alert">
    </div>
</div>
<div id="table_pag">
                <!-- /.col-lg-12 -->

<table class="table table-striped table-bordered table-hover" id="dataTables-example">



                        <thead>
                            <tr align="center">
                                <th>STT</th>
                                <th>Name</th>
                                <th>Category_Name</th>
                                <th>Quantity</th>
                                <th>Images</th>
                                <th></th>
                                <th colspan="2">Action</th>
                            </tr>
                        </thead>
                        <tbody id="bodydd">
                            @foreach($products as $key=>$item)
                            <tr class="odd gradeX" align="center">
                                <td>{{$item->id}}</td>
                                <td id="name">{{$item->name}}</td>
                                <td id="category_id">{{$item->categoies->name}}</td>
                                <td id="quantity">{{$item->quantity}}</td>
                                <td>
                                    @foreach($item->product_images as $key=>$valus)
                                    @if($item->id == $valus->product_id)
                                    @if($key == 0)
                                    <img src="/uploads/{{$valus->path}}" alt="" width="25%"></img>
                                    @endif
                                    @endif
                                    @endforeach
                                </td>
                                <td><a href="{{route('product.show',$item->id)}}">Show</a></td>
                                <td class="center">
                <button data-url="{{route('product.edit',$item->id)}}" class="btn btn-primary btn-edit" data-toggle="modal" data-target="#edit" type="button"><i class="fa fa-pencil fa-fw" ></i> </button>
            </td>
            <td class="center">
                <button data-url="{{ route('product.destroy',$item->id) }}"​ type="button" data-target="#delete" data-toggle="modal" class="btn btn-danger btn-delete"><i class="fa fa-trash-o  fa-fw"></i></button>
            </td>
                                
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
            {{$products->links()}}
</div>

@include('admin.product.edit')

@endsection


@section('sr')

<script>
$(document).ready(function () {
    
    $('#mess').hide();


         $('#form-search').submit(function(e){
            $('.pagination').hide();
                        e.preventDefault();
                        // console.log(url);
                        $.ajax({
                            type: 'get',
                            url: 'product/search',
                        data: {
                            'search': $('#search').val(),  //biến phải trùng vs tên REQUEST 
                        },
                       success:function(ab){
                // console.log(ab.categories.id);
                
                $('#bodydd').html(ab);
                // window.location.reload();
               var html ='';
                    $.each(ab.data,function($key,$value){
                        
                        $.each(ab.categories,function($keyy,$values){
                             if ($value['category_id' ] == $values['id']) {
                            $a = $values['name'];
                            }
                        });
                        var $b='';
                        $.each($value.product_images,function($keyyy,$valuess){
                             if ($keyyy == 0) {
                            $b = $valuess['path'];
                            }
                        });
                        
                html +='<tr><td>'+$value['id']+'</td><td>'+$value['name']+'</td><td>'+$a+'</td><td>'+$value['quantity']+'</td><td><img src="/uploads/'+$b+'" width="33%"></img></td><td><a href="http://127.0.0.1/admin/product/'+$value['id']+'">Show</a></td><td class="center"><button data-url="http://127.0.0.1/admin/product/'+$value['id']+'/edit" class="btn btn-primary btn-edit" data-toggle="modal" data-target="#edit" type="button"><i class="fa fa-pencil fa-fw" ></i> </button></td><td class="center"><button data-url="http://127.0.0.1/admin/product/'+$value['id']+'"​ type="button" data-target="#delete" data-toggle="modal" class="btn btn-danger btn-delete"><i class="fa fa-trash-o  fa-fw"></i></button></td>';
                        html += '</tr>';
                    });
                $('#bodydd').html(html);
            }
        })
    })





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


    $(document).on('click', '.st1', function(e){
         $('.pagination').hide();
         var id= $(this).attr('value');
        e.preventDefault();
        $.ajax({
            type:'get',
            url: 'product/sort/'+id,
            
            success:function(ab){
                // console.log(ab.categories.id);
                // console.log(ab.data);
                
                $('#bodydd').html(ab);
                // window.location.reload();
                var html ='';
                    $.each(ab.data,function($key,$value){
                        $.each(ab.categories,function($keyy,$values){
                             if ($value['category_id' ] == $values['id']) {
                            $a = $values['name'];
                            }
                        });
                        var $b='';
                        $.each($value.product_images,function($keyyy,$valuess){
                             if ($keyyy == 0) {
                            $b = $valuess['path'];
                            }
                        });
                        // console.log(ab.data);
                html +='<tr><td>'+$value['id']+'</td><td>'+$value['name']+'</td><td>'+$a+'</td><td>'+$value['quantity']+'</td><td><img src="/uploads/'+$b+'" width="33%"></img></td><td><a href="http://127.0.0.1/admin/product/'+$value['id']+'">Show</a></td><td class="center"><button data-url="http://127.0.0.1/admin/product/'+$value['id']+'/edit" class="btn btn-primary btn-edit" data-toggle="modal" data-target="#edit" type="button"><i class="fa fa-pencil fa-fw" ></i> </button></td><td class="center"><button data-url="http://127.0.0.1/admin/product/'+$value['id']+'"​ type="button" data-target="#delete" data-toggle="modal" class="btn btn-danger btn-delete"><i class="fa fa-trash-o  fa-fw"></i></button></td>';
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
            url: 'product/sort/'+id,
            
            success:function(ab){
                // console.log(ab.categories.id);
                
                $('#bodydd').html(ab);
                // window.location.reload();
               var html ='';
                    $.each(ab.data,function($key,$value){
                        $.each(ab.categories,function($keyy,$values){
                             if ($value['category_id' ] == $values['id']) {
                            $a = $values['name'];
                            }
                        });
                        var $b='';
                        $.each($value.product_images,function($keyyy,$valuess){
                             if ($keyyy == 0) {
                            $b = $valuess['path'];
                            }
                        });
                        // console.log(ab.data);
                html +='<tr><td>'+$value['id']+'</td><td>'+$value['name']+'</td><td>'+$a+'</td><td>'+$value['quantity']+'</td><td><img src="/uploads/'+$b+'" width="33%"></img></td><td><a href="http://127.0.0.1/admin/product/'+$value['id']+'">Show</a></td><td class="center"><button data-url="http://127.0.0.1/admin/product/'+$value['id']+'/edit" class="btn btn-primary btn-edit" data-toggle="modal" data-target="#edit" type="button"><i class="fa fa-pencil fa-fw" ></i> </button></td><td class="center"><button data-url="http://127.0.0.1/admin/product/'+$value['id']+'"​ type="button" data-target="#delete" data-toggle="modal" class="btn btn-danger btn-delete"><i class="fa fa-trash-o  fa-fw"></i></button></td>';
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
            url: 'product/sort/'+id,
            
            success:function(ab){
                // console.log(ab.categories.id);
                
                $('#bodydd').html(ab);
                // window.location.reload();
               var html ='';
                    $.each(ab.data,function($key,$value){
                        $.each(ab.categories,function($keyy,$values){
                             if ($value['category_id' ] == $values['id']) {
                            $a = $values['name'];
                            }
                        });
                        var $b='';
                        $.each($value.product_images,function($keyyy,$valuess){
                             if ($keyyy == 0) {
                            $b = $valuess['path'];
                            }
                        });
                        // console.log(ab.data);
                html +='<tr><td>'+$value['id']+'</td><td>'+$value['name']+'</td><td>'+$a+'</td><td>'+$value['quantity']+'</td><td><img src="/uploads/'+$b+'" width="33%"></img></td><td><a href="http://127.0.0.1/admin/product/'+$value['id']+'">Show</a></td><td class="center"><button data-url="http://127.0.0.1/admin/product/'+$value['id']+'/edit" class="btn btn-primary btn-edit" data-toggle="modal" data-target="#edit" type="button"><i class="fa fa-pencil fa-fw" ></i> </button></td><td class="center"><button data-url="http://127.0.0.1/admin/product/'+$value['id']+'"​ type="button" data-target="#delete" data-toggle="modal" class="btn btn-danger btn-delete"><i class="fa fa-trash-o  fa-fw"></i></button></td>';
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
        $('.error1').hide();
        $('.error2').hide();
        $('.error3').hide();


        var url = $(this).attr('data-url');
        e.preventDefault();

        $.ajax({
            
                //phương thức get
                type: 'get',
                url: url,

                success: function (response) {  //neu click thanh cong 
                    //đưa dữ liệu controller gửi về điền vào input trong form edit.
                    $('.tittle').text(response.data.name);
                    $('#name-edit').val(response.data.name);
                    $('#quantity-edit').val(response.data.quantity);
                    $('#price-edit').val(response.data.price);
                    var html ='';
                    $.each(response.suppliers,function($key,$value){
                        if ($value['id']==response.data.supplier_id) {
                            html +='<option value='+$value['id']+' selected>';
                                html += $value['name'];
                            html += '</option>';
                        }else{
                            html +='<option value='+$value['id']+' >';
                                html += $value['name'];
                            html += '</option>';
                        }
                    });
                        $('.idSupplier').html(html);
                        var html1 ='';
                    $.each(response.categories,function($key,$value){
                        if ($value['id']==response.data.category_id) {
                            html1 +='<option value='+$value['id']+' selected>';
                                html1 += $value['name'];
                            html1 += '</option>';
                        }else{
                            html1 +='<option value='+$value['id']+' >';
                                html1 += $value['name'];
                            html1 += '</option>';
                        }
                    });
                        $('.idCategory').html(html1);
                    $('#ram-edit').val(response.data.RAM);
                    $('#vga-edit').val(response.data.VGA);
                    $('#operating_system-edit').val(response.data.operating_system);
                    $('#cpu-edit').val(response.data.CPU);
                    $('#guarantee-edit').val(response.data.guarantee);
                    $('#note-edit').val(response.data.note);
                    CKEDITOR.instances['description-edit'].setData(response.data.description);
                    $('#sales_volume-edit').val(response.data.sales_volume);
                    // console.log(response.product_image);
                    $('.idSupplier').html(html);
                    var html2 ='';
                    $.each(response.product_image,function($key,$value){
                        html2 +='<img src=/uploads/'+$value['path']+' style="margin-right: 16px;width:100px; "/>';
                        
                    });
                    $('.idImage').html(html2);

                        
                    $('#form-edit').attr('data-url','{{ asset('admin/product/') }}/'+response.data.id)
                },
                error: function (error) {
                    
                }
            })
        })
    $('#form-edit').submit(function(e){
                        e.preventDefault();
                        var url=$(this).attr('data-url');
                        // var formData = new FormData($(this)[0]);
                        // formData.append( 'image', $( '#pimage' )[0].files[0] );
                        // $.ajaxSetup({
                        //     headers: {
                        //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        //     }
                        // });
                // console.log($('#pimage').val());
                        $.ajax({
                            type: "PUT",
                            url: url,
                            // data: formData,
                            // processData: false,
                            // contentType: false,
                         data: {
                             _token: '{{csrf_token()}}' ,
                            'name': $('#name-edit').val(),  //biến phải trùng vs tên REQUEST 
                            'quantity': $('#quantity-edit').val(),
                            'price': $('#price-edit').val(),
                            'supplier_id': $('.idSupplier').val(),
                            'category_id': $('.idCategory').val(),
                            'RAM': $('#ram-edit').val(),
                            'VGA': $('#vga-edit').val(),
                            'operating_system': $('#operating_system-edit').val(),
                            'CPU': $('#cpu-edit').val(),
                            'guarantee': $('#guarantee-edit').val(),
                            'note': $('#note-edit').val(),
                            'description': CKEDITOR.instances['description-edit'].getData(),
                            'sales_volume': $('#sales_volume-edit').val(),

                            '_method':'put',
                         },
                        success: function($resuld) {
                            if($resuld.error == 'true'){
                                if ($resuld.mess.name) {
                                    $('.error1').show();
                                    $('.error1').text($resuld.mess.name[0]);
                                } else {
                                      $('.error1').hide();                                    
                                }
                                if ($resuld.mess.quantity) {
                                     $('.error2').show();
                                     $('.error2').text($resuld.mess.quantity);
                                 } else {
                                    $('.error2').hide();
                                }
                                if ($resuld.mess.price) {
                                    $('.error3').show();
                                    $('.error3').text($resuld.mess.price);
                                } else {
                                    $('.error3').hide();
                                 }
                            }else{
                            $('#edit').hide();
                            $('#name').text($resuld.data.name);
                            $('#category_id').text($resuld.data.category_id);
                            $('#quantity').text($resuld.data.quantity);
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
               