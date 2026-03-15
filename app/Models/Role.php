<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    // Поля
    protected $fillable = [
        'title'
    ];

    // Связи
    public function users()
    {
        return $this->hasMany(User::class);
    }

    // Мутаторы/аксессоры
    protected function title()
    {
        
        return Attribute::make(
            get: fn($value) => mb_ucfirst($value)
        );
    }
}
