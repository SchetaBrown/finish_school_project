<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    // Поля
    protected $fillable = [
        'title'
    ];

    // Связи
    public function schools()
    {
        return $this->hasMany(EducationSchool::class);
    }

    // Аксессоры
    protected function title(): Attribute
    {
        return Attribute::make(
            get: function (string $value) {
                return mb_ucfirst($value);
            }
        );
    }
}
