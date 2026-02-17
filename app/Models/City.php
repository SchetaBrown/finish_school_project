<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $fillable = [
        'title'
    ];

    public function schools()
    {
        return $this->hasMany(EducationSchool::class);
    }
}
