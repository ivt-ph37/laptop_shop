<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Categoies;
use App\Model\Products;
use App\Http\Requests\AddCateRequest;
use Validator;
use Carbon\Carbon;
class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categoies = Categoies::paginate(7);
        $categories = Categoies::with('childrenCategories')->where('parent_id',0)->get();

        return view('admin.cate.list',compact('categoies','categories'));
    }
    public function fetch_data(Request $request){
        if ($request->ajax() || 'NULL') {
            $categoies= Categoies::get();
            return view('admin.cate.list',compact('categoies'))->render();

        }
    }
        public function search(Request $request)
    {
        if ($request->ajax() || 'NULL') {
            $categoies = Categoies::where('name', 'LIKE', '%' . $request->search . '%')->get();
            $categories = Categoies::with('childrenCategories')->where('parent_id',0)->get();
            return response()->json(['data'=>$categoies,'categories'=>$categories],200);
        }
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $dt = Carbon::now();
        // dd($dt);
        $categories = Categoies::with('childrenCategories')->where('parent_id',0)->get();
        return view('admin.cate.add', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AddCateRequest $request)
    {
        Categoies::create($request->all());
        return redirect()->route('category.index')->with('thongbao','Thêm thành công');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $products = Products::where('category_id',$id)->paginate(10);
        // dd($categoies);
        return view('admin.product.list', compact('products'));


    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {  
        $categoies=Categoies::find($id);
        return response()->json(['data'=>$categoies],200); // 200 là mã lỗi
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
                'name' => 'required|min:3|max:255'
            ],
        [
            'name.required' => 'Please Enter Name Category',
            'name.min' => 'Attribute length of 3-255 characters ',
            'name.max' => 'Attribute length of 3-255 characters ',
        ]);
        if ($validator->fails()) {
            return response()->json(['error'=>'true','mess'=>$validator->errors()],200);
        }
        $categoies= Categoies::find($id);
        $categoies->name = $request->name;
        if ($request->parent_id != 0) {
            $categoies->parent_id = $request->parent_id;
                    }
        else {
            $categoies->parent_id = 0;

        }
        
        $categoies->desription = $request->desription;
        $categoies->save();
        return response()->json(['data'=>$categoies,'message'=>'Update category successfully'],200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function children($childrens){
        foreach ($childrens as $item) {
            Categoies::destroy($item->id);
            $this->children($item->childrenCategories);
        }
        

    }


    public function destroy($id)
    {
        $categoies = Categoies::find($id);
        $childrenID = Categoies::with('childrenCategories')->where('parent_id',$id)->get();
        foreach ($childrenID as $value) {
            Categoies::destroy($value->id);
            $this->children($value->childrenCategories);
        }
        $categoies->delete();
            return response()->json(['data'=>'removed'],200);

        
    }
}
