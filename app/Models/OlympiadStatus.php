<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class OlympiadStatus extends Model
{
    // Поля
    protected $fillable = [
        'title',
        'slug',
    ];

    // Скрытые поля
    protected $hidden = [
        'id',
        'created_at',
        'updated_at',
    ];

    // Связи
    public function olympiads()
    {
        return $this->hasMany(Olympiad::class);
    }

    public function scopeWithoutDraft(Builder $query, bool $condition)
    {
        return $condition ? $query : $query->where('title', '!=', 'черновик');
    }
}
