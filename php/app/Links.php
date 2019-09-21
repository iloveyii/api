<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Links extends Model
{
    protected $fillable = ['name', 'url', 'location_id', 'category'];
}
