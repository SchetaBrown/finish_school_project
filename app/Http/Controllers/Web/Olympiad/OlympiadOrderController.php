<?php

namespace App\Http\Controllers\Web\Olympiad;

use App\Http\Controllers\Controller;
use App\Http\Resources\Olympiad\OlympiadResource;
use App\Models\Olympiad;

class OlympiadOrderController extends Controller
{
    public function create(string $slug)
    {
        return inertia('olympiad/Create', [
            'olympiad' => new OlympiadResource(Olympiad::withDefaultRelations()->where('slug', $slug)->first()),
        ]);
    }

    public function store()
    {

    }
}
