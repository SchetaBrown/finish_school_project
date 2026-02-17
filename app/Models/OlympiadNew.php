<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OlympiadNew extends Model
{
    // Поля
    protected $fillable = [
        'title',
        'description',
        'olympiad_id',
        'user_id',
    ];

    // Связи
    public function olympiad()
    {
        return $this->belongsTo(Olympiad::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }
}
