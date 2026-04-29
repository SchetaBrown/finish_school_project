<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class OlympiadOrder extends Model
{
    // Поля
    protected $fillable = [
        'score',
        'place',
        'is_education_manager_accept',
        'is_olympiad_manager_accept',
        'reject_message',
        'is_hostel',
        'arrival_date',
        'departure_date',
        'participant_id',
        'education_manager_id',
        'olympiad_id',
        'olympiad_order_status_id',
    ];

    // Связи
    public function participant()
    {
        return $this->belongsTo(Participant::class);
    }

    public function olympiad()
    {
        return $this->belongsTo(Olympiad::class);
    }

    public function educationManager()
    {
        return $this->belongsTo(EducationManager::class);
    }

    public function olympiadDocument()
    {
        return $this->hasMany(OlympiadDocument::class);
    }

    public function olympiadOrderStatus()
    {
        return $this->belongsTo(OlympiadOrderStatus::class);
    }

    // Скоупы
    public function scopeFilter(Builder $query, array $filters): Builder
    {
        $query
            ->when($filters['search'] ?? null, function ($q, $title) {
                $q->whereHas('participant', function ($q) use ($title) {
                    $q->whereHas('user', function ($q) use ($title) {
                        $q->where('email', 'LIKE', "%{$title}%")
                            ->orWhere('surname', 'LIKE', "%{$title}%")
                            ->orWhere('name', 'LIKE', "%{$title}%");
                    });
                });
            })
            ->when($filters['status'] ?? null, function ($q, $status) {
                $q->whereHas('olympiadOrderStatus', function ($q) use ($status) {
                    $q->where('slug', $status)
                        ->orWhere('title', $status);
                });
            });

        return $query;
    }
}
