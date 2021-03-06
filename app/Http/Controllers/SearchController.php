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
        $distance = $request->input('distance');
        $limit = $request->input('limit')?$request->input('limit'):100;
        $result = [];
        if($search_term && $lat && $lon && $distance)
        {
            list($latitudeMin, $longitudeMin) = self::subDistance($lat, $lon, $distance);
            list($latitudeMax, $longitudeMax) = self::addDistance($lat, $lon, $distance);
            $result = Promotion::orderBy('id', 'DESC')->where('name', 'LIKE', "%$search_term%")
                ->whereBetween('lat',[$latitudeMax,$latitudeMin])
                ->whereBetween('long',[$longitudeMax,$longitudeMin])
                ->get();
        }
        else if ($search_term)
        {
            $result = Promotion::orderBy('id', 'DESC')->where('name', 'LIKE', "%$search_term%")->get();
        }
        else if ($lat && $lon && $distance)
        {
            list($latitudeMin, $longitudeMin) = self::subDistance($lat, $lon, $distance);
            list($latitudeMax, $longitudeMax) = self::addDistance($lat, $lon, $distance); //exit();
            $result = Promotion::orderBy('id', 'DESC')
                ->whereBetween('lat',array($latitudeMin,$latitudeMax))
                ->whereBetween('long',array($longitudeMin,$longitudeMax))
                ->get();
        }

        return response()->json(['error'=> 200,'detail' => $result], 200);
        //return response()->json($product,500);
    }
}