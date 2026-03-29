<?php

namespace App\Http\Resources\Olympiad;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OlympiadResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'title' => $this->title,
            'description' => $this->description,
            'register_start_date' => $this->register_start_date,
            'register_end_date' => $this->register_end_date,
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
            'news' => $this->whenLoaded('olympiadNews', function () {
                return OlympiadNewResource::collection($this->olympiadNews);
            })
        ];
    }
}
