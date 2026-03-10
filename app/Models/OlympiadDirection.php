<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OlympiadDirection extends Model
{
    // Поля
    protected $fillable = [
        'title',
    ];

    // Скрытые поля
    protected $hidden = [
        'id',
        'created_at',
        'updated_at',
    ];

    // Связи
    public function olympiads()
    {
        return $this->hasMany(Olympiad::class);
    }
}
