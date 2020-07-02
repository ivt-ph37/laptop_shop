<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Categoies;
use App\Model\Products;
use App\Model\Suppliers;
use App\Model\Product_Image;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\AddProRequest;
use Validator;
class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Products::with('product_images')->paginate(10);
        // dd($products);
        return view('admin.product.list',compact('products'));
    }
    public function like($id,Request $request){
        if ($request->ajax() || 'NULL') {
            $products = Products::find($id);
            if ($products->note == 0) {
                $products->note = 1;
              $products->save();
            $products = Products::with('product_images')->get();
            $categories = Categoies::get();
            return response()->json(['data'=>$products,'categories'=>$categories],200);
            } else {
                $products->note = 0;
              $products->save();
            $products = Products::with('product_images')->get();
            $categories = Categoies::get();
            return response()->json(['data'=>$products,'categories'=>$categories],200);
            }
              
        }
        
    }

    public function image(Request $request,$id){
        if($request->hasFile('image')){
            $files = $request->file('image');
            
            
            foreach ( $files as $file) {
                    $product_image = new Product_Image;
                    if (isset($file)) {
                    $product_image->product_id=$id;
                    $product_image->path = rand(0,100000).'.'.$file->getClientOriginalName();
                    
                    $file->move( public_path() . '/uploads/', $product_image->path); 
                    $product_image->save();
                    }
            }
         }
          $products = Products::where('id',$id)->get();
        return redirect()->route('product.show',$id)->with('thongbao','Thêm thành công')->with('products','products')->with('product_image','product_image');
        
    }
    public function fetch_data(Request $request){
        if ($request->ajax() || 'NULL') {
            $products= Products::get();
            return view('admin.product.list',compact('products'))->render();
        }
    }
     public function search(Request $request)
    {
        if ($request->ajax() || 'NULL') {
            $products = Products::with('product_images')->where('name', 'LIKE', '%' . $request->search . '%')->get();
            $categories = Categoies::get();
            return response()->json(['data'=>$products,'categories'=>$categories],200);
        }
    }

    public function sort(Request $request,$id)
    {
        if ($request->ajax() || 'NULL') {
            if ($id == 1) {
                $products= Products::with('product_images')->where('quantity','>',5)->get();
              $categories = Categoies::get();
             return response()->json(['data'=>$products,'categories'=>$categories],200); 
            }
            else if ($id == 2) {
               $products= Products::with('product_images')->where('quantity','>',0)->where('quantity','<=',5)->get();
            $categories = Categoies::get();
            return response()->json(['data'=>$products,'categories'=>$categories],200);
            }
            else {
                $products= Products::with('product_images')->where('quantity',0)->get();
            $categories = Categoies::get();
            return response()->json(['data'=>$products,'categories'=>$categories],200);
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
        $categories = Categoies::where('parent_id','>',0)->get();
        $suppliers = Suppliers::get();
        return view('admin.product.add',compact('categories','suppliers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AddProRequest $request)
    {
        $products=Products::create($request->all());
         $products_id = $products->id;
         if($request->hasFile('image')){
            $files = $request->file('image');
            
            
            foreach ( $files as $file) {
                // dd($file);
                    $product_image = new Product_Image;
                    if (isset($file)) {
                    $product_image->product_id=$products_id;
                    $product_image->path = rand(0,100000).'.'.$file->getClientOriginalName();
                    
                    $file->move( public_path() . '/uploads/', $product_image->path); 
                    $product_image->save();
                    }
            }
         }
        return redirect()->route('product.index')->with('thongbao','Thêm thành công');
   
}

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
        $products = Products::where('id',$id)->get();
        $product_image = Product_Image::where('product_id',$id)->get();
        $id=$id;
        return view('admin.product.detailr', compact('products','product_image','id'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $products=Products::find($id);   
        $categories = Categoies::get();
        $suppliers = Suppliers::get(); 
        $product_image=Product_Image::where('product_id',$id)->get();
        return response()->json(['suppliers'=>$suppliers,'categories'=>$categories,'product_image'=>$product_image,'data'=>$products],200);
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
                'name' => 'required',
                'quantity' => 'required',
                'price' => 'required'
            ],
        [
            'name.required' => 'Please Enter Name Product',
            'quantity.required' =>'Please Enter Name Quantity',
            'price.required' =>'Please Enter Name Price',

        ]);
        if ($validator->fails()) {
            return response()->json(['error'=>'true','mess'=>$validator->errors()],200);
        }
        $products= Products::find($id);
        $products->update($request->all());

        return response()->json(['data'=>$products,'message'=>'Update product successfully'],200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product_image = Product_Image::where('product_id',$id)->get();
        foreach ($product_image as $value) {
            File::delete(public_path('uploads/'.$value->path));
        }
        $products=Products::find($id);
        $products->delete($id);
        return response()->json(['data'=>'removed'],200);
    }
}
