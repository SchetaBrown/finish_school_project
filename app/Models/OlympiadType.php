<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OlympiadType extends Model
{
    // Поля
    protected $fillable = [
        'title'
    ];

    public function olympiads()
    {
        return $this->belongsToMany(Olympiad::class, 'olympiad_olympiad_types', 'olympiad_type_id', 'olympiad_id');
    }
}
