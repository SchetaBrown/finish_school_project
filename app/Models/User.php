<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'surname',
        'name',
        'patronymic',
        'email',
        'password',
        'is_ban',
    ];

    protected $hidden = [
        'id',
        'password',
        'remember_token',
        'created_at',
        'updated_at',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // Связи
    public function roles()
    {
        return $this->belongsToMany(
            Role::class,
            'user_roles',
            'user_id',
            'role_id'
        );
    }

    public function participants()
    {
        return $this->hasMany(Participant::class, 'user_id');
    }

    public function managers()
    {
        return $this->hasMany(Participant::class);
    }

    public function news()
    {
        return $this->hasMany(OlympiadNew::class);
    }

    public function olympiadDocuments()
    {
        return $this->hasMany(OlympiadDocument::class);
    }

    // Мутаторы/аксессоры
    protected function name()
    {
        return Attribute::make(
            get: fn($value) => mb_ucfirst($value),
        );
    }
}
