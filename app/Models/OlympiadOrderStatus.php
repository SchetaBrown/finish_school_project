<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class OlympiadOrderStatus extends Model
{
    // Поля
    protected $fillable = ['title', 'slug'];

    // Связи
    public function olympiadOrder()
    {
        return $this->hasMany(OlympiadOrder::class);
    }

    // Мутаторы/Аксессоры

    protected function title(): Attribute
    {
        return Attribute::make(
            get: fn(string $value) => mb_ucfirst($value),
        );
    }
}
