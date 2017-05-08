<?php
/**
 * Created by PhpStorm.
 * User: khoabui
 * Date: 11/16/16
 * Time: 10:18 AM
 */

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Promotion extends Model
{
    protected $table = 'promotion_list';
    public $fillable = ['name','description','start_time','end_time','image','cate_id','address','lat','long'];
    public static function getAllPromotion($params = array())
    {
        $where = [];
        foreach ($params as $key => $value) {
            if (isset($value['key']))
                $key = $value['key'];
            $comparison = "=";
            if (isset($value['comparison']))
                $comparison = $value['comparison'];
            $value = $value['value'];
            $where[] = [$key,$comparison,$value];
        }
//        print_r($where); exit();
//        $promotion = Promotion::select(DB::raw(" *,DATE_FORMAT(start_time,'%d-%m-%Y') as start_time,DATE_FORMAT(end_time,'%d-%m-%Y') as end_time"));
        $promotions = Promotion::where($where);
        $promotions = $promotions->get();
        foreach ($promotions as $k => $promotion)
        {
            $promotions[$k]['start_time'] = strtotime($promotion->start_time);
            $promotions[$k]['end_time'] = strtotime($promotion->end_time );
        }
        return $promotions;

    }
}