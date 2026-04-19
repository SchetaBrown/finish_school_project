<?php

namespace App\Http\Resources\User;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        if ($request->routeIs('admin.user.index')) {
            return [
                'id' => $this->id,
                'full_name' => "{$this->surname} {$this->name}",
                'role' => $this->whenLoaded('role', fn() => $this->role->title),
                'email' => $this->email,
                'is_ban' => $this->is_ban,
            ];
        } else if ($request->routeIs('admin.olympiad.create') || $request->routeIs('admin.olympiad.edit')) {
            return [
                'id' => $this->id,
                'title' => "$this->surname $this->name $this->patronymic",
            ];
        }

        return [
            'surname' => $this->surname,
            'name' => $this->name,
            'patronymic' => $this->patronymic,
            'email' => $this->email,
            'phone' => $this->phone,
            'role' => $this->role->title,
            'initial_name' => $this->surname . ' ' . mb_substr($this->name, 0, 1, 'UTF-8') . '.' . mb_substr($this->patronymic, 0, 1, 'UTF-8') . '.'
        ];
    }
}
