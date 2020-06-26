<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Model\Products;
use App\Model\Promotions;
use App\Model\Product_Image;
use App\Model\Categoies;
use Cookie;

class ProductController extends Controller
{

    public function getAllProduct()
    {
        $products = Products::with('product_images')->paginate(8);
        $categorys = Categoies::with('childrenCategories')->where('parent_id',0)->get();
        return view('user.product.product', compact('products','categorys'));
    }  
    public function getFeature(){
        $products = Products::where('sales_volume','>','quantity')->paginate(8);
        $categorys = Categoies::with('childrenCategories')->where('parent_id',0)->get();
        // dd($products);
        return view('user.product.product', compact('products','categorys'));
    } 
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
       
        $products = Products::with('product_images')->take(4)->orderBy('created_at', 'DESC')->get();
        // dd($products);
       $categorys = Categoies::with('childrenCategories')->where('parent_id',0)->get();
        // dd($categories);
        // dd(Cookie::get('BuiTu'));
                 // $value = $request->cookie('BuiTu');
      // dd($value);
      
        return view('user.index', compact('products','categorys'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $search = $request->search;
        $products = Products::where('name', 'like', '%'. $search .'%')->get();
        $categorys = Categoies::with('childrenCategories')->where('parent_id',0)->get();
        // dd($products);
        return view('user.index', compact('products','categorys'));
    }
    public function create()
    {
        //
    }
    public function checkAvailable(Request $request, $id)
    {
            // return response()->json(['available' => 1],200);

        $product= Products::where('quantity', '>=', $request->qty)->find($id);
        if($product)
        {
            return response()->json(['available' => 1],200);

        }
        return response()->json(['error'=>'not availables'],404);
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
    public function show(Request $request,$id)
    {
        $product = Products::where('id', $id)->first();
        $promotionPrice = Promotions::where('product_id', $id)->where('end_date', '<', GETDATE())->take(1)->orderBy('created_at', 'ASC')->get();
        $promotion = Promotions::where('product_id', $id)->where('status',0)->first();
         // dd($promotionPrice);
   
        $categorys = Categoies::with('childrenCategories')->where('parent_id',0)->get();
        $productImage = Products::with('product_images')->where('id', $id)->get();
        // dd($productImage);   
        $productSuggests = $this->getProductSuggests($id);




         Cookie('nam','12323',true,2);
         // dd(Cookie('nam'));

        // $response = new Response('abc');  
        //  $value = 'Lập trình 123';
        //  $time = 10;
        //  $response->withCookie('BuiTu',$value,$time);

         // dd($response);      
 //         $cookie_name = 'asd';
 // $cookie_value = '123';
 // setcookie($cookie_name,$cookie_value,1); //name,value,time,url

 // dd($_COOKIE["asd"]);

        return view('user.product.product_detail', compact('product','categorys','promotionPrice','productImage', 'productSuggests','promotion'));
    }

    private function getProductSuggests($id)
    {
        $product = Products::with('categoies')->where('category_id', $id)->take(4)->get();
        return $product;
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
