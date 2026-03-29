<?php

namespace App\Http\Resources\Olympiad;

use App\Models\Olympiad;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OlympiadNewResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        if ($request->routeIs('olympiad.show')) {
            return [
                'title' => $this->title,
                'short_description' => $this->short_description,
                'slug' => $this->slug,
                'description' => $this->description,
                'published_at' => $this->published_at,
            ];
        } else {
            return [
                'title' => $this->title,
                'short_description' => $this->short_description,
                'slug' => $this->slug,
                'description' => $this->description,
                'published_at' => $this->published_at,
                'olympiad' => $this->whenLoaded('olympiad', function (Olympiad $olympiad) {
                    return $olympiad->slug;
                }),
            ];
        }
    }
}
