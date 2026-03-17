<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class Participant extends Model
{
    // Поля
    protected $fillable = [
        'birth_date',
        'cours_number',
        'is_hostel',
        'arrival_date',
        'departure_date',
        'education_school_id',
        'user_id',
        'attached_manager_id',
    ];

    // Связи
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function attachedManager()
    {
        return $this->belongsTo(User::class, 'attached_manager_id');
    }

    public function educationSchool()
    {
        return $this->belongsTo(EducationSchool::class);
    }

    public function olympiadOrders()
    {
        return $this->hasMany(OlympiadOrder::class);
    }

    // Мутаторы/аксессоры
    protected function birthDate() : Attribute
    {
        return Attribute::make(
            get: function ($value) {
                $carbon = new Carbon($value);
                return $carbon->format('d.m.Y');
            }
        );
    }
}
