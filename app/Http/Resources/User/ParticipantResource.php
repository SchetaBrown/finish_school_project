<?php

namespace App\Http\Resources\User;

use App\Http\Resources\Education\EducationDirectionResource;
use App\Http\Resources\Education\EducationSchoolResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ParticipantResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'birth_date' => $this->when($this->birth_date, fn() => $this->birth_date),
            'cours_number' => $this->when($this->cours_number, fn() => $this->cours_number),
            'attached_manager' => $this->whenLoaded('attachedManager', new UserResource($this->user)),
            'school' => $this->whenLoaded('educationSchool', new EducationSchoolResource($this->educationSchool)),
            'direction' => $this->whenLoaded('educationDirection', new EducationDirectionResource($this->educationDirection)),
            'user_info' => $this->whenLoaded('user', new UserResource($this->user)),
        ];
    }
}
