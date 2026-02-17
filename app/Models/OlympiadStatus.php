<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OlympiadStatus extends Model
{
    // Поля
    protected $fillable = [
        'title',
    ];

    // Связи
    public function olympiads() {
        return $this->hasMany(Olympiad::class);
    }
}
