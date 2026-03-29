<?php

namespace App\Http\Resources\Education;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EducationDirectionResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        if ($request->routeIs('register.*') || $request->routeIs('olympiad.order.create')) {
            return [
                'id' => $this->id,
                'title' => "$this->code $this->title",
            ];
        }

        return [
            'id' => $this->id,
            'title' => $this->title,
            'code' => $this->code,
        ];
    }
}
