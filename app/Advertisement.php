<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Advertisement extends Model
{
    public $timestamps = false;
    protected $fillable = [
          'adv_image',  'adv_content',  'adv_status'
    ];
    protected $primaryKey = 'adv_id';
 	protected $table = 'tbl_adv';
 	
 	
}
