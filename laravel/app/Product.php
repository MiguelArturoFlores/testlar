<?php

namespace testmiguel;

use Illuminate\Database\Eloquent\Model;
use testmiguel\ProductImage;

class Product extends Model
{
    //
    protected $fillable = array('name', 'description', 'image', 'price');
    protected $table = 'storeproduct';

	// DEFINE RELATIONSHIPS --------------------------------------------------
    public function images() {
        return $this->hasMany('testmiguel\ProductImage');
    }
}
