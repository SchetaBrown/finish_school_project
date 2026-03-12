<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OlympiadDocument extends Model
{
    // Поля
    protected $fillable = ['type', 'path', 'user_id', 'olympiad_id'];

    // Связи
    public function user() {
        return $this->belongsTo(User::class);
    }

    public function olympiad() {
        return $this->belongsTo(Olympiad::class);
    }
}
