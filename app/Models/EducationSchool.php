<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EducationSchool extends Model
{
    // Поля
    protected $fillable = [
        'full_name',
        'short_name',
        'inn',
        'phone',
        'email',
        'director_surname',
        'director_name',
        'director_patronymic',
        'city_id',
    ];

    // Связи
    public function directions()
    {
        return $this->belongsToMany(
            EducationDirection::class,
            'education_direction_schools',
            'education_school_id',
            'education_direction_id'
        );
    }

    public function managers()
    {
        return $this->hasMany(Manager::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }
}
