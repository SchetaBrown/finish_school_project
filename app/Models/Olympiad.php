<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Olympiad extends Model
{
    // Поля
    protected $fillable = [
        'title',
        'description',
        'start_date',
        'end_date',
        'olympiad_status_id',
        'olympiad_direction_id',
    ];

    // Связи
    public function types()
    {
        return $this->belongsToMany(OlympiadType::class, 'olympiad_olympiad_types', 'olympiad_id', 'olympiad_type_id');
    }

    public function status()
    {
        return $this->belongsTo(OlympiadStatus::class);
    }

    public function direction()
    {
        return $this->belongsTo(OlympiadDirection::class);
    }

    public function applications()
    {
        return $this->hasMany(OlympiadApplication::class);
    }

    public function news()
    {
        return $this->hasMany(OlympiadNew::class);
    }
}
