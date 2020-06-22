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
                                <th>Quantity</th>
                                <th>Price</th>
                                <th>Total</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach($order_detail as $key=>$item)
                            <tr class="odd gradeX" align="center">
                                <td>{{$key=$key+1}}</td>
                                <td>{{$item->products->name}}</td>
                                <td>{{$item->quantity}}</td>
                                <td>{{$item->price}}</td>
                                <td>{{$item->quantity * $item->price}}</td>
                             
                            </tr>
                             @endforeach
                        </tbody>
                    </table>
        <?php $b1=0;$b2=0 ?>
<?php $c=0; ?>
<?php $d=0; ?>
        @foreach($order_detail as $item)
        @if($item->orders->deliver_status == 0)
        <h1 style="color: blue">{{$item->products->name}}</h1>
                <?php $a=0; ?>
                         @foreach($promotion as $value)
                        @if($value->products->name == $item->products->name && $value->status == 0)
                        <?php $a++ ?>
                        
                            @if($value->quantity < $item->quantity)
                                <span>VAN CON IT</span><br>
                                <span>Gia sap pham dk khuyen mai : {{$value->quantity}} * {{$item->price}} *{{$value->price}} / 100 = {{ $b1=  $value->quantity * $item->price *  ($value->price /100)}}</span><br>
              
                                <span>Het khuyen mai qua so luong : {{$item->quantity-$value->quantity}} * {{$item->price}} = {{ $b2=    ($item->quantity-$value->quantity) * $item->price }}</span><br>
                            @else
                                <span>CON NHIEU</span><br>
                                <span>Sap pham khuyen mai : {{$item->quantity}} * {{$item->price}} * {{$value->price}} / 100 =  {{ $b2= $item->quantity * $item->price * $value->price /100}}</span><br>
                    
                            @endif          
                        @endif
                    @endforeach
                 @foreach($promotion1 as $value)
                            @if($value->products->name == $item->products->name && $a == 0)
                            <?php $a++ ?>
                            
                                <span>Ma khuyen mai: Het Han</span><br>
                                        <span>San pham khong duoc khuyen mai : {{$item->quantity}} * {{$item->price}} = {{ $c= $item->quantity * $item->price }}</span><br>  
                              
                            @endif
                    @endforeach
                @if($a == 0)
                
                    <span>Ma khuyen mai: Khong co</span><br>
                    <span>San pham khong duoc khuyen mai : {{$item->quantity}} * {{$item->price}} ={{ $d= $item->quantity * $item->price }}</span><br>
               

                @endif
    
        @endif
        @endforeach
        {{$b1}}
        {{$b2}}
        {{$c}}
        {{$d}}
        <span>TOTAL:{{$b1+$b2+$c+$d}}</span>

















                <?php $b1=0;$b2=0 ?>
<?php $c=0; ?>
<?php $d=0; ?>
        @foreach($order_detail as $item)
        @if($item->orders->deliver_status != 0)
        <h1 style="color: blue">{{$item->products->name}}</h1>
                <?php $a=0; ?>
                         @foreach($promotion as $value)
                        @if($value->products->name == $item->products->name && $value->status == 0)
                        <?php $a++ ?>
                        
                            @if($value->quantity < $item->quantity)
                                <span>VAN CON IT</span><br>
                                <span>Gia sap pham dk khuyen mai : {{$value->quantity}} * {{$item->price}} *{{$value->price}} / 100 = {{ $b1=  $value->quantity * $item->price *  ($value->price /100)}}</span><br>
              
                                <span>Het khuyen mai qua so luong : {{$item->quantity-$value->quantity}} * {{$item->price}} = {{ $b2=    ($item->quantity-$value->quantity) * $item->price }}</span><br>
                            @else
                                <span>CON NHIEU</span><br>
                                <span>Sap pham khuyen mai : {{$item->quantity}} * {{$item->price}} * {{$value->price}} / 100 =  {{ $b2= $item->quantity * $item->price * $value->price /100}}</span><br>
                    
                            @endif          
                        @endif
                    @endforeach
                 @foreach($promotion1 as $value)
                            @if($value->products->name == $item->products->name && $a == 0)
                            <?php $a++ ?>
                            
                                <span>Ma khuyen mai: Het Han</span><br>
                                        <span>San pham khong duoc khuyen mai : {{$item->quantity}} * {{$item->price}} = {{ $c= $item->quantity * $item->price }}</span><br>  
                              
                            @endif
                    @endforeach
                @if($a == 0)
                
                    <span>Ma khuyen mai: Khong co</span><br>
                    <span>San pham khong duoc khuyen mai : {{$item->quantity}} * {{$item->price}} ={{ $d= $item->quantity * $item->price }}</span><br>
               

                @endif
    
        @endif
        @endforeach
        {{$b1}}
        {{$b2}}
        {{$c}}
        {{$d}}
        <span>TOTAL:{{$b1+$b2+$c+$d}}</span>


@endsection



                   <!--  <?php $b = 0;$a=0 ?> -->
                        
<!--                         @if($item->product_id != $value->product_id)
                            <span>Ma khuyen mai: Khong co</span><br>
                            <span>San pham khong duoc khuyen mai:{{$item->quantity}} * {{$item->price}} ={{ $a=$a+ $item->quantity * $item->price }}</span><br>
                        @elseif ($item->product_id == $value->product_id  && $value->status == 1 || $value->quantity ==0)
                            <span>Ma khuyen mai: Het Han</span><br>
                            <span>San pham khong duoc khuyen mai123:{{$item->quantity}} * {{$item->price}} = {{ $a=$a+ $item->quantity * $item->price }}</span><br>
                        @elseif ($item->product_id == $value->product_id  && $value->status == 0 && $value->quantity < $item->quantity)
                            <span>Ma khuyen mai: Van con it</span><br>
                            <span>Gia sap pham dk khuyen mai:{{$value->quantity}} * {{$value->price}} / 100 = {{ $a=$value->quantity * $value->price /100}}</span><br>
                            <span>Het khuyen mai qua so luong:{{$item->quantity-$value->quantity}} * {{$item->price}} = {{ $a=$a+ ($item->quantity-$value->quantity) * $item->price }}</span><br>
                        @else
                            <span>Ma khuyen mai: CON NHIEU</span><br>
                            <span>Sap pham khuyen mai:{{$item->quantity}} * {{$value->price}} / 100 =  {{ $a=$a+ $item->quantity * $value->price /100}}</span><br>  
                        @endif -->


            <!-- {{$a=$a}} -->