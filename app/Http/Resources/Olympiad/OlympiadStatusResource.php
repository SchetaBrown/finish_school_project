<?php

namespace App\Http\Resources\Olympiad;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OlympiadStatusResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        if ($request->routeIs('admin.olympiad.*')) {
            return [
                'id' => $this->id,
                'title' => $this->title,
            ];
        }
        return [
            'title' => $this->title,
        ];
    }
}
