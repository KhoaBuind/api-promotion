<?php
/**
 * Created by PhpStorm.
 * User: khoabui
 * Date: 11/16/16
 * Time: 10:18 AM
 */

namespace App;

use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    protected $table = 'promotion_list';
    public $fillable = ['name','description','start_time','end_time','image','address','lat','long'];
}