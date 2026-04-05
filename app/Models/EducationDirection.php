<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

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

    public function scopeFilter(Builder $query, array $filters): Builder
    {
        $query
            ->when($filters['title'] ?? null, function ($q, $title) {
                $q
                    ->where('title', 'LIKE', "%{$title}%")
                    ->orWhere('code', 'LIKE', "%{$title}%");
            });

        return $query;
    }
}
