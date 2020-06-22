@extends('admin.master_admin')
@section('content')

    <div class="market-updates">
            <div class="col-md-3 market-update-gd">
                <div class="market-update-block clr-block-2" style="background: #ff0000c2;color: white;margin-right: -15px;">
                    <div class="col-md-4 market-update-right">
                        <i class="fa fa-eye"> </i>
                    </div>
                     <div class="col-md-8 market-update-left">
                     <h4>Products</h4>
                    <h3>{{$products}}</h3>
                    <p>Other hand, we denounce</p>
                  </div>
                  <div class="clearfix"> </div>
                </div>
            </div>
            <div class="col-md-3 market-update-gd" style="background: #008010b0;    color: white;">
                <div class="market-update-block clr-block-1">
                    <div class="col-md-4 market-update-right">
                        <i class="fa fa-users" ></i>
                    </div>
                    <div class="col-md-8 market-update-left">
                    <h4>Users</h4>
                        <h3>{{$users}}</h3>
                        <p>Other hand, we denounce</p>
                    </div>
                  <div class="clearfix"> </div>
                </div>
            </div>
            <div class="col-md-3 market-update-gd" style="background: #0095ff;    color: white;">
                <div class="market-update-block clr-block-3">
                    <div class="col-md-4 market-update-right">
                        <i class="fa fa-usd"></i>
                    </div>
                    <div class="col-md-8 market-update-left">
                        <h4>Promotions</h4>
                        <h3>{{$promotions}}</h3>
                        <p>Other hand, we denounce</p>
                    </div>
                  <div class="clearfix"> </div>
                </div>
            </div>
            <div class="col-md-3 market-update-gd" style="background: black;    color: white;">
                <div class="market-update-block clr-block-4">
                    <div class="col-md-4 market-update-right">
                        <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                    </div>
                    <div class="col-md-8 market-update-left">
                        <h4>Orders</h4>
                        <h3>{{$orders}}</h3>
                        <p>Other hand, we denounce</p>
                    </div>
                  <div class="clearfix"> </div>
                </div>
            </div>
           <div class="clearfix"> </div>
        </div>  

@endsection



               