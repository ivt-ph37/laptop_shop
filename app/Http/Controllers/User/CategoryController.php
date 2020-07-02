<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Categoies;
use App\Model\Products;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        if ($id == 1) {
            $products = Products::where('RAM', 'LIKE', '%' . '4' . '%')->paginate(8);
            // dd($products);
        } elseif ($id == 2) {
            $products = Products::where('RAM', 'LIKE', '%' . '8GB' . '%')->paginate(8);
        }
        elseif ($id == 3) {
            $products = Products::where('RAM', 'LIKE', '%' . '16GB' . '%')->paginate(8);
        }
        elseif ($id == 4) {
            $products = Products::where('price','<',13)->where('CPU','!=',NULL)->paginate(8);
        }
        elseif ($id == 5) {
            $products = Products::where('price','>=',13)->where('price','<=',17)->where('CPU','!=',NULL)->paginate(8);
        }elseif ($id == 6) {
            $products = Products::where('price','>',17)->where('CPU','!=',NULL)->paginate(8);
        }
        else {
            $products = Products::where('category_id',$id)->paginate(8);
        }
      
        $categorys = Categoies::with('childrenCategories')->where('parent_id',0)->get();
        return view('user.product.product', compact('products','categorys'));
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
