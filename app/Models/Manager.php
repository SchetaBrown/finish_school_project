<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Manager extends Model
{
    // Поля
    protected $fillable = [
        'phone',
        'user_id',
        'education_school_id',
    ];

    // Связи
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function school()
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

    protected function phone(): Attribute
    {
        return Attribute::make(
            get: fn(string $value) => $this->formatPhoneForDisplay($value),
            set: fn(string $value) => preg_replace('/[^0-9]/', '', $value)
        );
    }

    private function formatPhoneForDisplay(string $phone): string
    {
        return '+7 (' . substr($phone, 1, 3) . ') '
            . substr($phone, 4, 3) . '-'
            . substr($phone, 7, 2) . '-'
            . substr($phone, 9, 2);
    }
}
