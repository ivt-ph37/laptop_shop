<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\User;
use App\Model\Products;
use App\Model\Ratings;

class RatingController extends Controller
{
    public function saveRating(Request $request, $id)
    {
    	if($request->ajax())
    	{

    		Ratings::insert([
    			'product_id'=>$id,
    			'number_rating'=>$request->number,
    		]);

    		$product = Products::find($id);
    		$product->total_number_point += $request->number;
    		$product->total_rating +=1;
    		$product->save();
           
    		return response()->json(['data'=>'1'], 200);

    	}
    }
}
