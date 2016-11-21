<?php
/**
 * Created by PhpStorm.
 * User: khoabui
 * Date: 11/16/16
 * Time: 10:43 AM
 */

namespace App\Http\Controllers;


use App\Product;
use App\Promotion;
use Illuminate\Http\Request;

class PromotionController extends Controller
{
    public function index(Request $request)
    {

        $product = Promotion::all();
        return response()->json(['error'=> 200,'data' => $product], 200);
        //return response()->json($product,500);
    }

    public function getProduct($id)
    {
        $product = Promotion::find($id);
        return response()->json($product);
    }
    public function createProduct(Request $request)
    {
        $poduct = Promotion::create($request->all());
        return response()->json($poduct);
    }
    public function  updateProduct(Request $request,$id)
    {
        $product = Promotion::find($id);
        $product-> name = $request->input('name');
        $product-> details = $request->input('detail');
        $product-> save();
        return response()->json($product);
    }
    public function deleteProduct($id){
        $product  = Promotion::find($id);
        $product->delete();
        return response()->json('deleted');
    }
}