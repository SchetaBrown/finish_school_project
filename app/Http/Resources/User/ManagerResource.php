<?php

namespace App\Http\Resources\User;

use App\Http\Resources\Education\EducationSchoolResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ManagerResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'school' => $this->whenLoaded('educationSchool', new EducationSchoolResource($this->educationSchool)),
            'user_info' => $this->whenLoaded('user', new UserResource($this->user)),
        ];
    }
}
