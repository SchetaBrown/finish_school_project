<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EducationDirection extends Model
{
    // Поля
    protected $fillable = [
        'title',
        'code',
    ];

    // Связи
    public function educationSchools()
    {
        return $this->belongsToMany(
            EducationSchool::class,
            'education_direction_schools',
            'education_direction_id',
            'education_school_id'
        );
    }

    public function participants()
    {
        return $this->hasMany(Participant::class);
    }
}
