<?php

namespace testmiguel;

use Illuminate\Database\Eloquent\Model;

class CountryState extends Model
{
    protected $fillable = array('name', 'country_id');
    protected $table = 'storecountrystate';
}
