<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class OlympiadStatus extends Model
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
