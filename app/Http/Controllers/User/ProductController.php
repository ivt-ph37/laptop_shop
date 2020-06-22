<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Model\Products;
use App\Model\Promotions;
use App\Model\Product_Image;
use App\Model\Categoies;

class ProductController extends Controller
{

    public function getAllProduct()
    {
        $products = Products::with('product_images')->paginate(8);
        return view('user.product.product', ['products'=>$products]);
    }   
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       
        $products = Products::with('product_images')->take(4)->orderBy('created_at', 'DESC')->get();
        // dd($products);
        return view('user.index', compact('products'));
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
    public function show($id)
    {
        $product = Products::where('id', $id)->first();
        $promotionPrice = Promotions::where('product_id', $id)->where('end_date', '<', GETDATE())->take(1)->orderBy('created_at', 'ASC')->get();
       
         // dd($promotionPrice);
       
        $productImage = Products::with('product_images')->where('id', $id)->get();
        
        $productSuggests = $this->getProductSuggests($id);
        // dd($productSuggests);
        return view('user.product.product_detail', compact('product','promotionPrice','productImage', 'productSuggests'));
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
