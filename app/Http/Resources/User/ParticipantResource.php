<?php

namespace App\Http\Resources\User;

use App\Http\Resources\Education\EducationSchoolResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ParticipantResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'birth_date' => $this->birth_date,
            'cours_number' => $this->cours_number,
            'is_hostel' => $this->is_hostel,
            'arrival_date' => $this->arrival_date,
            'departure_date' => $this->departure_date,
            'school' => $this->whenLoaded('educationSchool', new EducationSchoolResource($this->educationSchool)),
            'attached_manager' => $this->whenLoaded('user', new UserResource($this->user)),
            'user_info' => $this->whenLoaded('user', new UserResource($this->user))
        ];
    }
}
