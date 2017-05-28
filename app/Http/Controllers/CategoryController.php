<?php
/**
 * Created by PhpStorm.
 * User: khoabui
 * Date: 11/16/16
 * Time: 10:43 AM
 */

namespace App\Http\Controllers;


use App\Category;
use App\Product;
use App\Promotion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $idCate = $request->input('id');
        if($idCate)
        {

            $category = Promotion::all()->where('cate_id',$idCate);
            if(!$category){
                return response()->json(['error'=> 404,'message' => 'Cate does not exit'], 404);
            }
        }
        else
        {
            $category = Category::all();
        }
        return response()->json(['error'=> 200,'data' => $category], 200);
    }
    public function getPromotion($id)
    {
//        $limit = $request->input('limit')?$request->input('limit'):100;
        if($id)
        {
            $params[] = array('key' => 'cate_id', 'value' => $id, 'comparison' => '=');
            $result = Promotion::getAllPromotion($params);
            if(!$result){
                return response()->json(['error'=> 404,'message' => 'Promotion does not exist'], 404);
            }
        }
        return response()->json(['error'=> 200,'detail' => $result], 200);
    }
}