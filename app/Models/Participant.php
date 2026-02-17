<?php

namespace App\Models;

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
        return $this->belongsTo(User::class, 'user_id');
    }

    public function attachedManager()
    {
        return $this->belongsTo(User::class, 'attached_manager_id');
    }

    public function educationSchool()
    {
        return $this->belongsTo(EducationSchool::class);
    }

    public function olympiadApplications()
    {
        return $this->hasMany(OlympiadApplication::class);
    }
}
