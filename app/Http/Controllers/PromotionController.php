<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Products;
use App\Http\Requests\AddPromotionRequest;
use App\User;
use App\Model\Promotions;
use Validator;
use App\Model\Suppliers;
use Carbon\Carbon;
class PromotionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $promotions = Promotions::paginate(5);
        $dt = Carbon::today();
        foreach ($promotions as $item) {
            if ($item->end_date < $dt->toDateString() || $item->quantity == 0 ) {
               $item->status = 1;
           }else{
                $item->status = 0;
           }

        }
        // $promotions->save();
        return view('admin.promotions.list',compact('promotions'));
    }
    public function fetch_data(Request $request){
        if ($request->ajax() || 'NULL') {
            $promotions= Promotions::get();
            return view('admin.promotions.list',compact('promotions'))->render();
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // dd(Carbon::today());
        $suppliers = Suppliers::get();
        $users = User::get();
        return view('admin.promotions.add',compact('suppliers','users'));
    }
    public function ajax($idSup){
        $products = Products::where('supplier_id',$idSup)->get();
        return response()->json(['data'=>$products],200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AddPromotionRequest $request)
    {
        if ($request->end_date >= $request->start_date) {
            $dt = Carbon::today();
            // dd($dts);
           // Promotions::create($request->all());
            $promotions = new Promotions();
            $promotions->user_id  = $request->user_id   ;
            $promotions->product_id  = $request->product_id   ;
            $promotions->price  = $request->price   ;
            $promotions->quantity  = $request->quantity   ;
            $promotions->start_date  = $request->start_date   ;
            $promotions->end_date  = $request->end_date   ;
            // dd($request->end_date,$dt->toDateString() );
           if ($request->end_date < $dt->toDateString() || $request->quantity == 0 ) {
               $promotions->status = 1;
           }else{
                $promotions->status = 0;
           }
           $promotions->save();
        return redirect()->route('promotion.index')->with('thongbao','Thêm thành công'); 
        }else {
            return redirect()->route('promotion.create')->with('thongbao','End_date phải sau ngày Start_date'); 
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $promotions = Promotions::where('id',$id)->first();
        return view('admin.promotions.detailer',compact('promotions'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $promotions=Promotions::find($id);   
        $products = Products::get();
        $users = User::get();
        return response()->json(['users'=>$users,'products'=>$products,'data'=>$promotions],200);
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
        $validator = Validator::make($request->all(),
            [
                'price' => 'required',
            'quantity' => 'required'
            ],
        [
            'price.required' => 'Please Enter Name Price',
            'quantity.required' =>'Please Enter Name Quantity',
        ]);
        if ($validator->fails()) {
            return response()->json(['error'=>'true','mess'=>$validator->errors()],200);
        }
        if ($request->end_date >= $request->start_date) {
            $dt = Carbon::today();
        $promotions= Promotions::find($id);
        if ($request->end_date < $dt->toDateString() || $request->quantity == 0 ) {
               $promotions->status = 1;
           }else{
                $promotions->status = 0;
           }
        $promotions->update($request->all());
        return response()->json(['data'=>$promotions,'message'=>'Update promotions successfully'],200);
        }else { 
            return response()->json(['errorss'=>'true','thongbao'=>'End_date phải sau ngày Start_date'],200);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Promotions::find($id)->delete();
        return response()->json(['data'=>'removed'],200);
    }
}
