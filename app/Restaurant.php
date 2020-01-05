<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Restaurant extends Model
{
    use SoftDeletes;
    protected $table = 'restaurants';
    protected $fillable = ['restaurant_name','address','lat','long'];
}
