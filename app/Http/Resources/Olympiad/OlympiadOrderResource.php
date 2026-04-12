<?php

namespace App\Http\Resources\Olympiad;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OlympiadOrderResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        if ($request->routeIs('olympiad.student-orders.index')) {
            return [
                'id' => $this->id,
                'full_name' => $this->whenLoaded('participant', fn() => $this->participant->user->fullName()),
                'email' => $this->whenLoaded('participant', fn() => $this->participant->user->email),
                'phone' => $this->whenLoaded('participant', fn() => $this->participant->user->phone),
                'school' => $this->whenLoaded('participant', fn() => $this->participant->educationSchool->short_name),
                'cours_number' => $this->whenLoaded('participant', fn() => $this->participant->cours_number),
                'documents' => $this->whenLoaded('olympiadDocument', OlympiadDocumentResource::collection($this->olympiadDocument)),
                'status' => $this->whenLoaded('olympiadOrderStatus', $this->olympiadOrderStatus->title),
                'olympiad' => $this->whenLoaded('olympiad', $this->olympiad->slug),
            ];
        }

        return [
            'score' => $this->score
        ];
    }
}
