<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OlympiadOrder extends Model
{
    // Поля
    protected $fillable = [
        'score',
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
}
