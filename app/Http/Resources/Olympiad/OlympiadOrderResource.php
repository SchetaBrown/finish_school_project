<?php

namespace App\Http\Resources\Olympiad;

use App\Http\Resources\User\ParticipantResource;
use App\Http\Resources\User\UserResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OlympiadOrderResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'score' => $this->score,
            'place' => $this->place,
            'reject_message' => $this->reject_message,
            'is_education_manager_accept' => $this->is_education_manager_accept,
            'school' => $this->whenLoaded('participant', fn() => $this->participant->educationSchool->short_name),
            'documents' => $this->whenLoaded('olympiadDocument', OlympiadDocumentResource::collection($this->olympiadDocument)),
            'status' => $this->whenLoaded('olympiadOrderStatus', $this->olympiadOrderStatus->title),
            'olympiad' => $this->whenLoaded('olympiad', new OlympiadResource($this->olympiad)),
            'user_info' => $this->whenLoaded('participant', new UserResource($this->participant->user)),
            'participant_info' => $this->whenLoaded('participant', new ParticipantResource($this->participant))
        ];
    }
}
