<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OlympiadDirection extends Model
{
    // Поля
    protected $fillable = [
        'title',
        'slug',
    ];

    // Связи
    public function olympiads()
    {
        return $this->hasMany(Olympiad::class);
    }
}
