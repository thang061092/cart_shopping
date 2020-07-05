<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    public function customer(){
        return $this->belongsTo('App\Customer');
    }
    public function products(){
        return$this->belongsToMany('App\Product','details','bill_id','product_id');
    }
}
