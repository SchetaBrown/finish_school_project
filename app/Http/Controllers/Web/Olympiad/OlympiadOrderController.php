<?php

namespace App\Http\Controllers\Web\Olympiad;

use App\Http\Controllers\Controller;
use App\Http\Resources\Olympiad\OlympiadResource;
use App\Http\Resources\User\ParticipantResource;
use App\Models\Olympiad;
use App\Models\Participant;
use App\Models\User;

class OlympiadOrderController extends Controller
{
    public function create(string $slug)
    {
        return inertia('olympiad/Create', [
            'olympiad' => new OlympiadResource(Olympiad::withDefaultRelations()->where('slug', $slug)->first()),
            'user' => new ParticipantResource(Participant::with(['user', 'attachedManager', 'educationSchool'])
                ->whereHas('user', function ($query) {
                    $query->where('email', auth()->user()->email);
                })
                ->first()),
        ]);
    }

    public function store()
    {

    }
}
