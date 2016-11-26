<?php

namespace testmiguel;

use Illuminate\Database\Eloquent\Model;

class BlogPost extends Model
{

    protected $fillable = array('id', 'title', 'content', 'test', 'keywords');
    protected $table = 'blogpost';

}
