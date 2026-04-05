<?php

namespace App\Http\Resources\Olympiad;

use App\Http\Resources\User\UserResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OlympiadResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        if ($request->routeIs('admin.olympiad.index')) {
            return [
                'title' => $this->title,
                'slug' => $this->slug,
                'status' => $this->whenLoaded('olympiadStatus', fn() => mb_ucfirst($this->olympiadStatus?->title)),
                'direction' => $this->whenLoaded('olympiadDirection', fn() => mb_ucfirst($this->olympiadDirection?->title)),
            ];
        }

        if ($request->routeIs('olympiad.*')) {
            return [
                'title' => $this->title,
                'description' => $this->description,
                'slug' => $this->slug,
                'status' => $this->whenLoaded('olympiadStatus', fn() => mb_ucfirst($this->olympiadStatus?->title)),
                'direction' => $this->whenLoaded('olympiadDirection', fn() => mb_ucfirst($this->olympiadDirection?->title)),
                'register_start_date' => $this->register_start_date,
                'register_end_date' => $this->register_end_date,
                'start_date' => $this->start_date,
                'end_date' => $this->end_date,
                'news' => $this->whenLoaded('olympiadNews', function () {
                    return OlympiadNewResource::collection($this->olympiadNews);
                }),
                'types' => $this->whenLoaded('types', function () {
                    return $this->types->pluck('title')->toArray();
                }),
            ];
        }


        return [
            'title' => $this->title,
            'description' => $this->description,
            'register_start_date' => $this->register_start_date,
            'register_end_date' => $this->register_end_date,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'max_player_register_count' => $this->max_player_register_count,
            'slug' => $this->slug,
            'status' => $this->whenLoaded('olympiadStatus', fn() => mb_ucfirst($this->olympiadStatus?->title)),
            'olympiad_direction_id' => $this->whenLoaded('olympiadDirection', fn() => new OlympiadDirectionResource($this->olympiadDirection)),
            'olympiad_manager_id' => $this->whenLoaded('olympiadManager', fn() => new UserResource($this->olympiadManager)),
            'types' => $this->whenLoaded('types', function () {
                return $this->types->pluck('title')->toArray();
            }),
            'news' => $this->whenLoaded('olympiadNews', function () {
                return OlympiadNewResource::collection($this->olympiadNews);
            })
        ];
    }
}
