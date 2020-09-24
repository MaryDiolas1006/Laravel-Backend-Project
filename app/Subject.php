<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Subject extends Model
{
     use SoftDeletes;

    protected $fillable = ["name", "category_id", "image"];

    public function category()
    {
        return $this->belongsTo('App\Category')
            ->withTrashed();
    }

    public function units()
    {
        return $this->hasMany('App\Unit');
    }
}
