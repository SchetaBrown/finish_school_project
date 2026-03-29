<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class OlympiadNew extends Model
{
    // Поля
    protected $fillable = [
        'title',
        'short_description',
        'description',
        'slug',
        'olympiad_id',
        'user_id',
        'published_at',
    ];

    // Связи
    public function olympiad()
    {
        return $this->belongsTo(Olympiad::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Скоупы
    protected function slug(): Attribute
    {
        $now = "-" . now()->timestamp . '-' . rand(1000, 9999);
        return Attribute::make(
            set: function ($value, $attributes) use ($now) {
                if (!empty($value)) {
                    return Str::slug($value) . $now;
                }

                if (!empty($attributes['title'])) {
                    return Str::slug($attributes['title']) . $now;
                }

                return 'olympiad' . $now;
            }
        );
    }

    // Аксессесоры
    protected function publishedAt(): Attribute
    {
        return Attribute::make(
            get: function ($value) {
                $carbon = new Carbon($value);
                return $carbon->format('d.m.Y');
            }
        );
    }
}
