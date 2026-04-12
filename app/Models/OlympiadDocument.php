<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class OlympiadDocument extends Model
{
    // Поля
    protected $fillable = ['type', 'path', 'user_id', 'olympiad_order_id'];

    // Связи
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function olympiadOrder()
    {
        return $this->belongsTo(OlympiadOrder::class);
    }

    // Мутаторы/Аксессоры
    protected function type(): Attribute
    {
        return Attribute::make(
            get: fn(string $value) => mb_ucfirst($value)
        );
    }
}
