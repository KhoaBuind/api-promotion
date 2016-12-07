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

class SearchController extends Controller
{
    public function index(Request $request)
    {

        $search_term = $request->input('search');
        $lat = $request->input('lat');
        $lon = $request->input('long');
        $currentLocation = $request->input('current');
        $limit = $request->input('limit')?$request->input('limit'):100;
        if($search_term)
        {
            $result = Promotion::orderBy('id', 'DESC')->where('name', 'LIKE', "%$search_term%")->get();
            if(!$result){
                return response()->json(['error'=> 404,'message' => 'Not Found!!!!'], 404);
            }
        }
        else if ($lat && $lon && $currentLocation)
        {
            $result = Promotion::all();
            if(!$result){
                return response()->json(['error'=> 404,'message' => 'Not Found!!!!'], 404);
            }
        }

        return response()->json(['error'=> 200,'detail' => $result], 200);
        //return response()->json($product,500);
    }
}