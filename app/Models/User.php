<?php

namespace App\Models;

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
        'phone',
        'password',
        'role_id',
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
    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function participant()
    {
        return $this->hasOne(Participant::class);
    }

    public function manager()
    {
        return $this->hasOne(Manager::class);
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

    protected function phone(): Attribute
    {
        return Attribute::make(
            get: fn(string $value) => $this->formatPhoneForDisplay($value),
            set: fn(string $value) => preg_replace('/[^0-9]/', '', $value)
        );
    }

    private function formatPhoneForDisplay(string $phone): string
    {
        return '+7 (' . substr($phone, 1, 3) . ') '
            . substr($phone, 4, 3) . '-'
            . substr($phone, 7, 2) . '-'
            . substr($phone, 8, 2);
    }
}
