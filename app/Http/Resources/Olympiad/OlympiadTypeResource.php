<?php

namespace App\Http\Resources\Olympiad;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OlympiadTypeResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
        ];
    }
}
