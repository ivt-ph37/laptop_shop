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
use Session;

class ProductController extends Controller
{
    public function getAllProduct()
    {
        $products = Products::with('product_images')->paginate(8);
        $categorys = Categoies::with('childrenCategories')->where('parent_id',0)->get();
        return view('user.product.product', compact('products','categorys'));
    }  
    
    public function getFeature(){
        $products = Products::with('product_images')->where('sales_volume', '>=', '10')->orderBy('sales_volume', 'DESC')->paginate(8);
        $categorys = Categoies::with('childrenCategories')->where('parent_id',0)->get();
        // dd($products);
        return view('user.product.product', compact('products','categorys'));
    } 

    public function getHighlight(){
        $products = Products::where('note','=','1')->paginate(8);
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
 

        $products = Products::with('product_images')->orderBy('created_at', 'DESC')->limit(4)->get();

        $categorys = Categoies::with('childrenCategories')->where('parent_id',0)->get();
        $promotionPrice = Products::with('promotions')->take(1)->get();

                $products_view=Session::get('products_views');

        $key=0;
        if (Session::get('products_views') != NULL){
            $products_array = array($key=>array('id'=>0));// ta tạo thêm một mảng bỏ nó vào mac dinh no la 0 ha thì mình pải tạo 1 cái đe mình foreach đk bén đo t xét vs khác 0 ok?? roi đe a xoa sesion tạo cái khác đa chứ lỗi rồi mà trc đó t pải tạo NULL vì mới vào làm gi mình sesion liền c
           // dd($a);
            // dd($products_views);
           foreach ($products_view as $value) { //1,5,5,7
                $b=0;
               foreach ($products_array as $item) {
                   if ($value->id == $item['id']) {
                       $b++;
                   }
               }
               if ($b == 0) {//có đang xem ko đó ko thây trả lời co
                $key++;
                   $products_array += array($key=>array('id'=>$value->id,'name'=>$value->name,'quantity'=>$value->quantity,'price'=>$value->price,'supplier_id'=>$value->supplier_id,'category_id'=>$value->category_id,'RAM'=>$value->RAM,'VGA'=>$value->VGA,'operating_system'=>$value->operating_system,'CPU'=>$value->CPU,'guarantee'=>$value->guarantee,'note'=>$value->note,'description'=>$value->description,'sales_volume'=>$value->sales_volume,'product_images'=>$value->product_images,'promotions'=>$value->promotions));
                  
               }
           }
           return view('user.index', compact('products','categorys','products_array','promotionPrice'));
        }else {   
            return view('user.index', compact('products','categorys','promotionPrice'));
        }
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $search = $request->search;
        $products = Products::where('name', 'like', '%'. $search .'%')->paginate(8);
        $categorys = Categoies::with('childrenCategories')->where('parent_id',0)->get();
        // dd($products);
        return view('user.product.product', compact('products','categorys'));
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
        $productCategory = Products::where('category_id',$product->category_id)->where('id','!=',$product->id)->take(4)->get();
        $productImage = Products::with('product_images')->where('id', $id)->get();
        // dd($productImage);   
        $productSuggests = $this->getProductSuggests($id);



        Session::push('products_views',$product);




        return view('user.product.product_detail', compact('product','categorys','promotionPrice','productImage', 'productSuggests','promotion','productCategory'));
    }

    private function getProductSuggests($id)
    {
        $product = Products::with('childrenCategories')->where('category_id', $id)->take(4)->get();
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




