@extends('admin.master_admin')
@section('content')
<div class="col-lg-12">
                    </div>

                    <!-- /.col-lg-12 -->
                        <h2 class="page-header" style="color: blue;text-align: center;"> 
                            Customer Infomation
                        </h2>
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr align="center">
                                <th>STT</th>
                                <th>Name</th>
                                <th>Phone</th>
                                <th>Address</th>


                            </tr>
                        </thead>
                        <tbody>
                            @foreach($user as $key=>$item)

                            <tr class="odd gradeX" align="center">
                                <td>{{$key+1}}</td>
                                <td>{{$item->users->fullname}}</td>
                                <td>{{$item->users->telephone}}</td>
                                <td>{{$item->delivery_address}}</td>      
                            </tr>
                             @endforeach
                        </tbody>
                    </table>
                    <h2 class="page-header" style="color: blue;text-align: center;"> 
                            List Orders Detail
                        </h2>

                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr align="center">
                                <th>STT</th>
                                <th>Name Product</th>
                                <th>Promotion</th>
                                <th>Quantity</th>
                                <th>Price</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $total=0; ?>
                            @foreach($order_detail as $key=>$item)
                            
                            <?php $promotion=0; ?>
                            <tr class="odd gradeX" align="center">
                                <td>{{$key=$key+1}}</td>
                                <td>{{$item->products->name}}</td>
                                <td>
                                @foreach($promotions as $value)
                                    @if($value->product_id == $item->product_id && $item->orders->order_date >= $value->start_date && $item->orders->order_date <= $value->end_date)
                                    {{"Đã áp dụng"}}
                                    <?php $promotion = $value->price ?>
                                    @endif
                                @endforeach
                                </td>
                                <td>{{$item->quantity}}</td>
                                <td>{{$item->price - $promotion }}$</td>
                                <td>{{($item->price - $promotion)*$item->quantity}}$</td>
                                <?php $total +=($item->price - $promotion)*$item->quantity ?>
                            </tr>

                            
                             @endforeach
                        </tbody>
                    </table>

        <span style="color: red;font-size: 37px;">Tổng tiền thanh toán :{{$total}}$</span><br>
        @if($order_status->deliver_status == 0)
            
            <span style="color: blue;font-size: 25px;">Deliver_Status :</span><button data-url="{{route('order.edit',$order_status->id)}}" class="btn btn-primary btn-edit" data-toggle="modal" data-target="#edit" type="button">{{"Chờ xử lý"}} </button><br>
        @elseif($order_status->deliver_status == 1)
            
            <span style="color: blue;font-size: 25px;">Deliver_Status :</span><button data-url="{{route('order.edit',$order_status->id)}}" class="btn btn-primary btn-edit" data-toggle="modal" data-target="#edit" type="button">{{"Đang giao hàng"}} </button><br>
        @else 
            
            <span style="color: blue;font-size: 25px;">Deliver_Status :</span><button data-url="{{route('order.edit',$order_status->id)}}" class="btn btn-primary btn-edit" data-toggle="modal" data-target="#edit" type="button">{{"Hoàn thành"}}</button><br>
        @endif
            






<div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Chỉnh sửa <span class="tittle"></span></h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row" style="margin: 5px">
                        <div class="col-lg-12">
                            <form action="" id="form-edit" method="POST" role="form">
                                <div class="form-group">
                                <label>Deliver_Status</label>
                                <select class="form-group" name="deliver_status" id="deliver_status-edit">
                                    <option value="0" id="option0">Chờ xử lý</option>
                                    <option value="1" id="option1">Đang giao hàng</option>
                                    <option value="2" id="option2">Hoàn thành</option>
                                </select>
                            </div>
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Update</button>

                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    

@endsection





@section('sr')

<script>
$(document).ready(function () {

 $('.btn-edit').click(function(e){

        var url = $(this).attr('data-url');

        e.preventDefault();

        $.ajax({
                //phương thức get
                type: 'get',
                url: url,
                success: function (response) {
                    $('.tittle').text(response.data.username);
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
                            // $('#mess').show();
                            // $('#mess').html($resuld.message,{timeOut:5000});
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


