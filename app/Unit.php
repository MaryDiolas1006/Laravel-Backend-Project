<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Unit extends Model
{
    use SoftDeletes;

    protected $fillable = ['control_code', 'image', 'subject_id'];

    public function subject()
    {
        return $this->belongsTo('App\Subject')
            ->withTrashed();
    }

    public function unit_status()
    {
        return $this->belongsTo(UnitStatus::class, 'status_id');
    }

    public function tickets()
    {
        return $this->belongsToMany('App\Ticket')
            ->withTimestamps();
    }
}
