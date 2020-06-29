<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Orders;
use App\Model\Order_Detail;
use App\Model\Promotions;
use App\Model\Products;
use Carbon\Carbon;
class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Orders::paginate(5);
        return view('admin.order.list',compact('orders'));
    }
    public function fetch_data(Request $request){
        if ($request->ajax() || 'NULL') {
            $orders= Orders::get();
            return view('admin.order.list',compact('orders'))->render();
        }
    }
    public function search(Request $request)
    {
        if ($request->ajax() || 'NULL') {
            $orders = Orders::where('username', 'LIKE', '%' . $request->search . '%')->orWhere('email', 'LIKE', '%' . $request->search . '%')->get();
            return response()->json(['data'=>$orders],200);
        }
    }


    public function sort(Request $request,$id)
    {
        if ($request->ajax() || 'NULL') {
            if ($id == 0) {
                $orders= Orders::orderBy('order_date','desc')->get();
            return response()->json(['data'=>$orders],200);
            }
            else {
                $orders= Orders::orderBy('order_date','asc')->get();
            return response()->json(['data'=>$orders],200);
            }
            
        }
    }
    public function status(Request $request,$id)
    {
         if ($request->ajax() || 'NULL') {
            if ($id == 1) {
                $orders= Orders::where('deliver_status',0)->get();
            return response()->json(['data'=>$orders],200);
            }else if ($id == 2) {
                $orders= Orders::where('deliver_status',1)->get();
            return response()->json(['data'=>$orders],200);
            } else{
                $orders= Orders::where('deliver_status',2)->get();
            return response()->json(['data'=>$orders],200);
            }
            
        }
    }


 
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = Orders::with('users')->where('id',$id)->get();
        $order_detail = Order_Detail::where('order_id',$id)->get();
        $order_status = Orders::where('id',$id)->first();
        $promotions = Promotions::get();
        // dd($promotions);


        return view('admin.order.detailr', compact('user','order_detail','order_status','promotions'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $orders=Orders::find($id);   
        return response()->json(['data'=>$orders],200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $orders= Orders::find($id);
        if ($request->deliver_status == 0 || $request->deliver_status == 1) {
            $orders->delivery_date = NULL;
            $orders->deliver_status = $request->deliver_status;
            $orders->save();
        }
        else {
            $orders->delivery_date = Carbon::now();
            $orders->deliver_status = 2;
            $orders->save();
        }
        
        return response()->json(['data'=>$orders,'message'=>'Update order successfully'],200);
    }
    public function detailr(Request $request,$id){
        $orders= Orders::find($id);
        $orders->deliver_status = $request->deliver_status;
        $orders->save();
        return response()->json(['data'=>$orders,'message'=>'Update order successfully'],200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $orders=Orders::find($id);
        $orders->delete($id);
        return response()->json(['data'=>'removed'],200);
    }
}
