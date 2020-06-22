<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Orders;
use App\Model\Order_Detail;
use App\Model\Promotions;
use App\Model\Products;
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


    public function new(Request $request)
    {
        if ($request->ajax() || 'NULL') {
            $orders= Orders::orderBy('id','desc')->get();
            return response()->json(['data'=>$orders],200);
        }
    }
    public function old(Request $request)
    {
        if ($request->ajax() || 'NULL') {
            $orders= Orders::orderBy('id','asc')->get();
            return response()->json(['data'=>$orders],200);
        }
    }
    public function status_c(Request $request)
    {
         if ($request->ajax() || 'NULL') {
            $orders= Orders::where('deliver_status',0)->get();
            return response()->json(['data'=>$orders],200);
        }
    }
    public function status_d(Request $request)
    {
         if ($request->ajax() || 'NULL') {
            $orders= Orders::where('deliver_status',1)->get();
            return response()->json(['data'=>$orders],200);
        }
    }
    public function status_h(Request $request)
    {
         if ($request->ajax() || 'NULL') {
            $orders= Orders::where('deliver_status',2)->get();
            return response()->json(['data'=>$orders],200);
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
        $order_details = Order_Detail::where('order_id',$id)->get();
        $promotion1 = Promotions::where('status',1)->orWhere('quantity',0)->get();
        $promotion = Promotions::where('status',0)->get();
        $promotion35 = Promotions::get();

        foreach ($order_detail as $it) {
            // $promotion = Promotions::where('product_id',$it->product_id)->where('status',0)->get();
            // $promotion = Promotions::get();




            foreach ($order_details as $value) {
            // dd($value->orders->deliver_status); //0
            // $promotions = Promotions::where('product_id',$value->product_id)->get();
            // $a = 0;
            
            if ($value->orders->deliver_status == 0) {
               $promotions = Promotions::where('product_id',$value->product_id)->get();
            
                
                        if ($promotions != NULL) {
                            // dd($order_details);
                        
                        foreach ($promotions as $item) {
                            // dd($item->products->name);
                           if ($item->status == 0 ) {  //neu bien ko rong
                            // dd($promotions);
                                // dd($item->id);
                                $promotionss = Promotions::where('id',$item->id)->first();
                                // dd($promotionss);
                                if ($item->quantity < $value->quantity) {
                                    $promotionss->quantity = 0;
                                    // dd($promotions->quantity);
                                    $promotionss->save();
                                }
                                else {
                                     $promotionss->quantity = $item->quantity - $value->quantity;
                                    $promotionss->save();
                                }


                            } 
                        }

                        }
            // return view('admin.order.detailr', compact('user','order_detail','promotions','a'));
             } 
         }
         // dd($promotion35);
        return view('admin.order.detailr', compact('user','order_detail','promotion','promotion1','promotion35'));
        }
        // dd($order_detail);
        // dd($promo);
        return view('admin.order.detailr', compact('user','order_detail'));
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
        $orders->update($request->all());
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
