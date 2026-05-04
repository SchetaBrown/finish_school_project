<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class OlympiadDocument extends Model
{
    // Поля
    protected $fillable = ['type', 'path', 'participant_id', 'olympiad_order_id'];

    // Связи
    public function participant()
    {
        return $this->belongsTo(Participant::class);
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
