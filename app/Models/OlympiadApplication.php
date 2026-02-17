<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OlympiadApplication extends Model
{
    // Поля
    protected $fillable = [
        'score',
        'participant_id',
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
