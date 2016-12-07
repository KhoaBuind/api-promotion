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
use Illuminate\Support\Facades\DB;

class PromotionController extends Controller
{
    public function index(Request $request)
    {

//        $search_term = $request->input('search');
        $idPromotion = $request->input('id');
        $limit = $request->input('limit')?$request->input('limit'):100;

        if($idPromotion)
        {
            $params[] = array('key' => 'id', 'value' => $idPromotion, 'comparison' => '=');
            $result = Promotion::getAllPromotion($params);
            if(!$result){
                return response()->json(['error'=> 404,'message' => 'Promotion does not exist'], 404);
            }
        }
        else
        {
            $params = [];
            $result['new'] = Promotion::getAllPromotion($params);
            $result['hot'] = Promotion::getAllPromotion($params);

        }
        return response()->json(['error'=> 200,'detail' => $result], 200);
        //return response()->json($product,500);
    }
}