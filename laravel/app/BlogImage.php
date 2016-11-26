<?php

namespace testmiguel;

use Illuminate\Database\Eloquent\Model;

class BlogImage extends Model
{

    protected $fillable = array('id', 'entire_name', 'folder', 'original_name');
    protected $table = 'blogimage';

}
