<?php

namespace testmiguel;

use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    //
    protected $fillable = array('extension', 'product_id');
    protected $table = 'storeproductimage';

    // DEFINE RELATIONSHIPS --------------------------------------------------
    public function product() {
        return $this->belongsTo('testmiguel\Product');
    }
}
