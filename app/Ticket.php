<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ticket extends Model
{
    use SoftDeletes;

    protected $fillable = ['ticket_code', 'date_needed', 'date_returned'];


    public function ticket_status()
    {
        return $this->belongsTo(TicketStatus::class, 'status_id');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
            // ->withTrashed();
    }

    public function units()
    {
        return $this->belongsToMany('App\Unit')
            ->withTimestamps();
            // ->withTrashed();
    }
}
