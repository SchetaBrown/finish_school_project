<?php

namespace App\Http\Resources\Education;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EducationSchoolResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        if ($request->routeIs('register.*')) {
            return [
                'id' => $this->id,
                'title' => $this->full_name,
                'subtitle' => $this->short_name,
                'city' => $this->whenLoaded('city', $this->city->title),
            ];
        }

        return [
            'title' => $this->full_name,
            'subtitle' => $this->short_name,
            'inn' => $this->inn,
            'phone' => $this->phone,
            'director_surname' => $this->director_surname,
            'director_name' => $this->director_name,
            'director_patronymic' => $this->director_patronymic,
            'email' => $this->email,
            'city' => $this->whenLoaded('city', $this->city->title),
        ];
    }
}
