<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Model\Orders;
use App\Model\Order_Detail;
use App\Model\Products;
use App\Model\Product_Image;
use App\Model\Promotions;
use Cart;
use Session;
use Auth;
use Mail;
use App\Mail\ShoppingMail;


class CheckoutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cart = Cart::content();
        return view('user.cart.checkout', compact('cart'));
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
        // $cart =  Session::get('cart');
        $cart = Cart::content();
        // dd($cart);
        $order = new Orders();
        $order->user_id = $request->id;
        $order->fullname = $request->fullname;
        $order->username = $request->username;
        $order->fullname = $request->fullname;
        $order->email = $request->email;
        $order->telephone = $request->telephone;
        $order->delivery_address = $request->delivery_address;
        $order->order_date = date('Y-m-d H:i:s');
        $order->deliver_status = 0;
        $order->save();

        $order_details = [];
    
        foreach ($cart as $key => $value) {
           
            $order_detail['order_id'] = $order->id;
            $order_detail['product_id'] = $value->id;
            $order_detail['quantity'] = $value->qty;
            $order_detail['price'] = ($value->price/$value->qty);
            //tru va cap nhat so luong quantity trong product khi dat mua
            $product = Products::find($value->id);
            $product['quantity'] = $product['quantity']-$value->qty;

            $product->save();
            

            // $order_details[$key] =  $order_detail->save();
             $order_details[$key] = Order_Detail::create($order_detail);
            // dd($order_details);
        }

       
        // $order_details[$key] = $order_detail->save();
        // dd($order_details);
        Mail::to($order->email)->send(new ShoppingMail($order, $order_details));
        Session::forget('cart');
        return redirect()->back()->with('success','success');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
 
}
