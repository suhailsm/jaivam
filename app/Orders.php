<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    protected $fillable = [
        'pro_id','quantity',
    ];
    public function product()
    {
    	return $this->hasMany('App\Products','pro_id');
    }
}
