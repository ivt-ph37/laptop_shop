@extends('admin.master_admin')
@section('content')
<div class="col-lg-12">
    <div>
        @foreach($products as $item)
                        <h3 class="page-header">Chi tiết sản phẩm:
                            <span style="color: #6b00ff;">{{$item->name}}</span>
                        </h3>
    </div>
    <div class="alert alert-success" id="mess" role="alert">
    </div>
        <div>
                        <form action="{{ route('post.image',$id) }}" method="POST" role="form" enctype="multipart/form-data">
                            @csrf
                                   <div class="form-group">
                             <label>Image *</label>
                             <input  type="file" name="image[]" multiple />
                            </div>
                             <button type="submit" class="btn btn-default">Upload</button>
                    </form>
                    </div><br>
                    

    
                        @if(session('thongbao'))
    <div class="alert alert-success" role="alert">
        {{session('thongbao')}}
    </div>
@endif
                    </div>

                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr align="center">
                                <th>Quantity</th>
                                <th>Price</th>
                                <th>RAM</th>
                                <th>VGA</th>
                                <th>Operating_System</th>
                                <th>CPU</th>
                                <th>Guarantee</th>
                                <th>Description</th>
                                <th>Sales_volume</th>
                                <th>Note</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="odd gradeX" align="center">
                                <td >{{$item->quantity}}</td>
                                <td >{{$item->price}}$</td>
                                <td >{{$item->RAM}}</td>
                                <td >{{$item->VGA}}</td>
                                <td >{{$item->operating_system}}</td>
                                <td >{{$item->CPU}}</td>
                                <td >{{$item->guarantee}}</td>
                                <td >{!!$item->description!!}</td>
                                <td>{{$item->sales_volume}}</td>
                                <td id="note">
                                    @if($item->note == 0)
                                        <button data-url="{{route('product.like',$item->id)}}" class="notlike"><i class="fa fa-star-o" aria-hidden="true"></i></button>
                                    @else
                                        <button data-url="{{route('product.like',$item->id)}}" class="like"><i class="fa fa-star" aria-hidden="true"></i></button>
                                    @endif

                                </td>
                                <td class="center">
                <button data-url="{{route('product.edit',$item->id)}}" class="btn btn-primary btn-edit" data-toggle="modal" data-target="#edit" type="button"><i class="fa fa-pencil fa-fw" ></i> </button>
            </td>
                            </tr>
                            
                        </tbody>
                    </table>
                        
                        @endforeach
                        <h2 class="page-header">Product Images
                        </h2>
                        <div>
                        @foreach($product_image as $item)
                            @if($item->id != 0)
                            
                            <img src="/uploads/{{$item->path}}" alt="" width="33%"></img>
                            <button data-url="{{ route('image.destroy',$item->id) }}"​ type="button" data-target="#delete" data-toggle="modal" class="btn btn-danger btn-delete"><i class="fa fa-times" aria-hidden="true"></i></button>
                            
                            @endif
                        @endforeach
                        </div>
                    </div>
@include('admin.product.edit')
@endsection

@section('sr')

<script>
$(document).ready(function () {
    $('#mess').hide();

    $(document).on('click', '.notlike', function(e){
            var url = $(this).attr('data-url');
            e.preventDefault();
            $.ajax({
                type: 'get',
                url: url,
                success: function ($resuld) {
                    $('#note').text($resuld.data.note); 
                    window.location.reload();             
             }
            })

        })
    $(document).on('click', '.like', function(e){
            var url = $(this).attr('data-url');
            e.preventDefault();
            $.ajax({
                type: 'get',
                url: url,
                success: function ($resuld) {
                    $('#note').text($resuld.data.note); 
                    window.location.reload();             

             }
            })


        })
    
     $('.btn-delete').click(function(){
        var url = $(this).attr('data-url');
        var _this = $(this);
        if (confirm('Ban co chac muon xoa khong?')) {
            $.ajax({
                type: 'delete',
                url: url,
                success: function(response) {
                    alert('Xoa thanh cong');
                    window.location.reload();
                },
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
                type: 'get',
                url: url,

                success: function (response) { 
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
                    $('.idSupplier').html(html);
                    var html2 ='';
                    $.each(response.product_image,function($key,$value){
                        html2 +='<img src=/uploads/'+$value['path']+' style="margin-right: 16px;width:100px; "/>';
                        
                    });
                    $('.idImage').html(html2);

                        
                    $('#form-edit').attr('data-url','{{ asset('admin/product/') }}/'+response.data.id)
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
             _token: '{{csrf_token()}}' ,
            'name': $('#name-edit').val(),  
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