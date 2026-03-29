<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OlympiadOrder extends Model
{
    // Поля
    protected $fillable = [
        'score',
        'is_hostel',
        'arrival_date',
        'departure_date',
        'participant_id',
        'manager_id',
        'olympiad_id',
        'olympiad_order_status_id',
    ];

    // Связи
    public function participant()
    {
        return $this->belongsTo(Participant::class);
    }

    public function olympiad()
    {
        return $this->belongsTo(Olympiad::class);
    }
}
