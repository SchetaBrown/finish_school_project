<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OlympiadOrder extends Model
{
    // Поля
    protected $fillable = [
        'score',
        'place',
        'is_manager_accept',
        'is_olympiad_manager_accept',
        'is_hostel',
        'arrival_date',
        'departure_date',
        'participant_id',
        'manager_id',
        'olympiad_id',
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

    public function educationManager() {
        return $this->belongsTo(Manager::class);
    }
}
