<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Suggets;

class SuggestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $suggets = Suggets::paginate(5);
        return view('admin.suggests.list',compact('suggets'));
    }
    public function fetch_data(Request $request){
        if ($request->ajax() || 'NULL') {
            $suggets= Suggets::get();
            return view('admin.suggests.list',compact('suggets'))->render();
        }
    }

    
    public function search(Request $request){
        $search = $request->search;
        $suggets = Suggets::where('username','like','%'.$search.'%')->paginate(5);
        return view('admin.suggests.list',compact('suggets'));
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
        $suggets = Suggets::where('id',$id)->first();
        $suggets->status= 1;
        $suggets->save();
        return view('admin.suggests.detailer', compact('suggets'));
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
        $suggets=Suggets::find($id);
        $suggets->delete($id);
        return response()->json(['data'=>'removed'],200);
    }
}
