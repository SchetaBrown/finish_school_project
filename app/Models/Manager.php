<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Manager extends Model
{
    // Поля
    protected $fillable = [
        'user_id',
        'education_school_id',
    ];

    // Связи
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function educationSchool()
    {
        return $this->belongsTo(EducationSchool::class);
    }

    // Мутаторы/аксессоры
    protected function surname()
    {
        return Attribute::make(
            get: fn(string $value) => mb_ucfirst($value),
            set: fn(string $value) => Str::lower($value)
        );
    }
}
