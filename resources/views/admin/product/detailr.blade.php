@extends('admin.master_admin')
@section('content')
<div class="col-lg-12">
    <div>
                        <form action="{{ route('post.image',$id) }}" method="POST" role="form" enctype="multipart/form-data">
                            @csrf
                                   <div class="form-group">
                             <label>Image *</label>
                             <input  type="file" name="image[]" multiple />
                            </div>
                             <button type="submit" class="btn btn-default">Upload</button>
                    </form>
                    </div>
    @foreach($products as $item)
                        <h1 class="page-header">Product Detailr Of
                            <small style="font-size: 40px;color: red;">{{$item->name}}</small>
                        </h1>
                        @if(session('thongbao'))
    <div class="alert alert-success" role="alert">
        {{session('thongbao')}}
    </div>
@endif
                    </div>
                    
                    <!-- /.col-lg-12 -->
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
                                <th>Note</th>
                                <th>Description</th>
                                <th>Sales_volume</th>
                            </tr>
                        </thead>
                        <tbody>
                            

                            <tr class="odd gradeX" align="center">
                                <td >{{$item->quantity}}</td>
                                <td >{{$item->price}}</td>
                                <td >{{$item->RAM}}</td>
                                <td >{{$item->VGA}}</td>
                                <td >{{$item->operating_system}}</td>
                                <td >{{$item->CPU}}</td>
                                <td >{{$item->guarantee}}</td>
                                <td >{{$item->note}}</td>
                                <td >{{$item->description}}</td>
                                <td>{{$item->sales_volume}}</td>

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

@endsection

@section('sr')

<script>
$(document).ready(function () {
     $('.btn-delete').click(function(){
        var url = $(this).attr('data-url');
        var _this = $(this);
        if (confirm('Ban co chac muon xoa khong?')) {
            $.ajax({
                type: 'delete',
                url: url,
                success: function(response) {
                    alert('Xoa thanh cong');
                    // _this.parent().parent().remove();
                    window.location.reload();
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    //xử lý lỗi tại đây
                }
            })
        }
    })






})
</script>

@endsection