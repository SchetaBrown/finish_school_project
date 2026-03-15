<?php

namespace App\Http\Resources\User;

use App\Http\Resources\Education\EducationSchoolResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ManagerResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'is_accept' => $this->is_accept,
            'school' => $this->whenLoaded('educationSchool', function () {
                return new EducationSchoolResource($this->educationSchool);
            }),
            'user_info' => $this->whenLoaded('user', function () {
                return new UserResource($this->user);
            }),
        ];
    }
}
