<?php

namespace App\Models;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
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
        'max_player_count',
        'city',
    ];

    // Связи
    public function educationDirections()
    {
        return $this->belongsToMany(
            EducationDirection::class,
            'education_direction_schools',
            'education_school_id',
            'education_direction_id'
        );
    }

    // Связи
    public function managers()
    {
        return $this->hasMany(Manager::class);
    }

    public function scopeFilter(Builder $query, array $filters): Builder
    {
        $query
            ->when($filters['title'] ?? null, function ($q, $title) {
                $q
                    ->where('full_name', 'LIKE', "%{$title}%")
                    ->orWhere('short_name', 'LIKE', "%{$title}%");
            });

        return $query;
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
            . substr($phone, 8, 2);
    }
}
