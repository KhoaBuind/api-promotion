<?php
/**
 * Created by PhpStorm.
 * User: khoabui
 * Date: 11/16/16
 * Time: 10:18 AM
 */

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public $fillable = ['name','details'];
}