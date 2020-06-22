@extends('admin.master_admin')
@section('content')
<div class="col-lg-12">
  
                        <h1 class="page-header">Name of 
                            <small style="font-size: 40px;color: red;">{{$promotions->products->name}}</small>
                        </h1>
                    </div>
                    <!-- /.col-lg-12 -->
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr align="center">
                                <th>ID</th>
                                <th>Name Product</th>                      
                                <th>Price</th>
                                <th>Promotion</th>
                                <th>Quantity</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="odd gradeX" align="center">
                                <td>{{$promotions->id}}</td>
                                <td>{{$promotions->products->name}}</td>
                                <td>{{$promotions->products->price}}</td>
                                <td>{{$promotions->price}}</td>
                                <td>{{$promotions->quantity}}</td>
                                <td>{{$promotions->products->price * $promotions->price /100}}</td>
                            </tr>
                          
                        </tbody>
                    </table>

                   
@endsection