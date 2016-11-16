<?php
/**
 * Created by PhpStorm.
 * User: khoabui
 * Date: 11/16/16
 * Time: 10:43 AM
 */

namespace App\Http\Controllers;


use App\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $product = Product::all();
        return response()->json($product);
    }

    public function getProduct($id)
    {
        $product = Product::find($id);
        return response()->json($product);
    }
    public function createProduct(Request $request)
    {
        $poduct = Product::create($request->all());
        return response()->json($poduct);
    }
    public function  updateProduct(Request $request,$id)
    {
        $product = Product::find($id);
        $product-> name = $request->input('name');
        $product-> details = $request->input('detail');
        $product-> save();
        return response()->json($product);
    }
    public function deleteProduct($id){
        $product  = Product::find($id);
        $product->delete();
        return response()->json('deleted');
    }
}