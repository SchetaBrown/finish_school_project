<?php

namespace App\Http\Controllers\Web\Olympiad;

use App\Http\Controllers\Controller;
use App\Http\Resources\Olympiad\OlympiadResource;
use App\Models\Olympiad;
use App\Models\Participant;
use Illuminate\Support\Facades\Auth;

class OlympiadOrderController extends Controller
{
    public function create(string $slug)
    {
        return inertia('olympiad/Create', [
            'olympiad' => new OlympiadResource(Olympiad::withDefaultRelations()->whereSlug($slug)->first()),
        ]);
    }

    public function store()
    {
        $participant = Participant::with(['user', 'attachedManager', 'educationSchool', 'educationSchool.directions'])->where('user_id', Auth::id())->first();

        $full_name = $participant->user->fullName();
        $birth_date = $participant->birth_date;
        $cours_number = $participant->cours_number;
    }
}
