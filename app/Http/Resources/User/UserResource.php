<?php

namespace App\Http\Resources\User;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'surname' => $this->surname,
            'name' => $this->name,
            'patronymic' => $this->patronymic,
            'email' => $this->email,
            'password' => $this->password,
            'roles' => $this->whenLoaded('roles', function () {
                return $this->roles->pluck('title')->toArray();
            }),
        ];
    }
}
