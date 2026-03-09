<?php

namespace App\Models;

use App\Models\OlympiadApplication;
use App\Models\OlympiadDirection;
use App\Models\OlympiadNew;
use App\Models\OlympiadStatus;
use App\Models\OlympiadType;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

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

    protected function slug(): Attribute
    {
        return Attribute::make(
            set: function ($value, $attributes) {
                if (!empty($value)) {
                    return Str::slug($value);
                }

                if (!empty($attributes['title'])) {
                    return Str::slug($attributes['title']);
                }

                return 'olympiad-' . now()->timestamp . '-' . rand(1000, 9999);
            }
        );
    }

    // Скоупы

    public function scopeWhereSlug(Builder $query, string $slug): Builder
    {
        return $query->where('slug', $slug);
    }

    public function scopeFilter(Builder $query, array $filters): Builder
    {
        return $query
            ->when($filters['title'] ?? null, function ($q, $title) {
                $q->where('title', 'LIKE', "%{$title}%");
            })
            ->when($filters['direction'] ?? null, function ($q, $direction) {
                $q->whereHas(
                    'olympiadDirection',
                    fn($subQ) =>
                    $subQ->where('slug', $direction)
                        ->orWhere('title', $direction)
                );
            })
            ->when($filters['status'] ?? null, function ($q, $status) {
                $q->whereHas(
                    'olympiadStatus',
                    fn($subQ) =>
                    $subQ->where('slug', $status)
                        ->orWhere('title', $status)
                );
            })
            ->when($filters['type'] ?? null, function ($q, $type) {
                $q->whereHas(
                    'types',
                    fn($subQ) =>
                    $subQ->where('slug', $type)
                        ->orWhere('id', $type)
                );
            });
    }

    public function scopeWithDefaultRelations(Builder $query): Builder
    {
        return $query->with([
            'olympiadStatus',
            'olympiadDirection',
            'types'
        ]);
    }
}
