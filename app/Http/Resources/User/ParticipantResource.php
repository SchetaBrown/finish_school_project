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
            'birth_date' => $this->when($this->birth_date, fn() => $this->birth_date),
            'cours_number' => $this->when($this->birth_cours_numberdate, fn() => $this->cours_number),
            'is_hostel' => $this->when($this->is_hostel, fn() => $this->is_hostel),
            'arrival_date' => $this->when($this->arrival_date, fn() => $this->is_hostel),
            'departure_date' => $this->when($this->departure_date, fn() => $this->is_hostel),
            'school' => $this->whenLoaded('educationSchool', new EducationSchoolResource($this->educationSchool)),
            'attached_manager' => $this->whenLoaded('attachedManager', new UserResource($this->user)),
            'user_info' => $this->whenLoaded('user', new UserResource($this->user)),
        ];
    }
}
