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
        }

        return [
            'surname' => $this->surname,
            'name' => $this->name,
            'patronymic' => $this->patronymic,
            'email' => $this->email,
            'phone' => $this->phone,
            'role' => $this->whenLoaded('role', fn() => $this->role->title),
        ];
    }
}
