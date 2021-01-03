<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    public $timestamps = false; //set time to false
    protected $fillable = [
    	 'post_title','post_slug', 'post_desc','post_content','post_meta_desc','post_meta_keyword','post_status','post_image','cate_post_id','created_at','post_image_adv','post_author'
    ];
    protected $primaryKey = 'post_id';
 	protected $table = 'tbl_post';
 	
 	public function cate_post(){
 		return $this->belongsTo('App\CategoryPost','cate_post_id');
 	}
}
