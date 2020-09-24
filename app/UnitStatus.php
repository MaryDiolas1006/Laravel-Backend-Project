<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UnitStatus extends Model
{
    public function units()
    {
        return $this->hasMany('App\Unit');
    }
}
