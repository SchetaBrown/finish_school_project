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

    private function baseArray()
    {
        return [
            'full_name' => $this->full_name,
            'short_name' => $this->short_name,
            'city' => $this->whenLoaded('city', $this->city->title),
            'directions' => $this->whenLoaded('educationDirections', $this->educationDirections),
        ];
    }

    public function toArray(Request $request): array
    {
        if ($request->routeIs('register.*')) {
            return [
                'id' => $this->id,
                'title' => $this->short_name
            ];
        }

        return array_merge($this->baseArray(), [
            'inn' => $this->inn,
            'phone' => $this->phone,
            'director_surname' => $this->director_surname,
            'director_name' => $this->director_name,
            'director_patronymic' => $this->director_patronymic,
            'email' => $this->email,
        ]);
    }
}
