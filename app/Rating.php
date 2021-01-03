<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    protected $table = "tbl_product_rating";

    public function product()
    {
    	return $this->belongsTo('App\Product','product_id','product_id');
    }

    // Một Comment chỉ thuộc một user,và một user thì có một hoặc nhiều comment
    // public function user() 
    // {
    // 	return $this->belongsTo('App\Customer','customer_id','customer_id');   
    // }
    public function user() 
    {
        return $this->belongsTo('App\User','customer_id','id');   
    }
}
