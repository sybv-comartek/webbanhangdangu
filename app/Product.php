<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public $timestamps = false; //set time to false
    protected $fillable = [
    	'product_name', 'product_slug','category_id','brand_id','product_desc','product_content','product_price','product_image','product_status'
    ];
    protected $primaryKey = 'product_id';
 	protected $table = 'tbl_product';

 	public function rating()
    {
    	return $this->hasMany('App\Rating','product_id','product_id');
    }
    public function danhmuc()
    {
    	return $this->belongsTo('App\Category','category_id','category_id');
    }
    public function thuonghieu()
    {
    	return $this->belongsTo('App\Brand','brand_id','brand_id');
    }
}
