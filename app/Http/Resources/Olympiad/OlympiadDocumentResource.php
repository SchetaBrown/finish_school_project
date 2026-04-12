<?php

namespace App\Http\Resources\Olympiad;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OlympiadDocumentResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        if ($request->routeIs('olympiad.student-orders.index')) {
            return [
                'id' => $this->id,
                'type' => $this->type,
                'path' => $this->path,
            ];
        }

        return [

        ];
    }
}
