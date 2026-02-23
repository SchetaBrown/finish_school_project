<?php

namespace App\Http\Resources\Olympiad;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OlympiadResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'player_count' => $this->player_count,
            'player_limit' => $this->player_limit,
            'slug' => $this->slug,
            'status' => $this->whenLoaded('olympiadStatus', fn() => mb_ucfirst($this->olympiadStatus?->title)),
            'direction' => $this->whenLoaded('olympiadDirection', fn() => mb_ucfirst($this->olympiadDirection?->title)),
            'types' => $this->whenLoaded('types', function () {
                return $this->types->pluck('title')->toArray();
            }),
        ];
    }
}
