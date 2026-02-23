<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Olympiad extends Model
{
    // Поля
    protected $fillable = [
        'title',
        'description',
        'start_date',
        'end_date',
        'player_count',
        'player_limit',
        'slug',
        'olympiad_status_id',
        'olympiad_direction_id',
    ];

    // Связи
    public function types()
    {
        return $this->belongsToMany(OlympiadType::class, 'olympiad_olympiad_types', 'olympiad_id', 'olympiad_type_id');
    }

    public function olympiadStatus()
    {
        return $this->belongsTo(OlympiadStatus::class);
    }

    public function olympiadDirection()
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

    // Мутаторы и аксессоры
    protected function startDate(): Attribute
    {
        return Attribute::make(
            get: function ($value) {
                $carbon = new Carbon($value);
                return $carbon->format('d.m.Y');
            }
        );
    }

    protected function endDate(): Attribute
    {
        return Attribute::make(
            get: function ($value) {
                $carbon = new Carbon($value);
                return $carbon->format('d.m.Y');
            }
        );
    }
}
