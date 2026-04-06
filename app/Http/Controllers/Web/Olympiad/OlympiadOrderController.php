<?php

namespace App\Http\Controllers\Web\Olympiad;

use App\Http\Requests\Olympiad\StoreOlympiadOrderRequest;
use App\Http\Resources\User\ParticipantResource;
use App\Http\Resources\User\UserResource;
use App\Models\Role;
use Illuminate\Database\Eloquent\Builder;
use Inertia\Inertia;
use App\Models\Manager;
use App\Models\Olympiad;
use App\Models\Participant;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\User\ManagerResource;
use App\Http\Resources\Olympiad\OlympiadResource;

class OlympiadOrderController extends Controller
{
    public function create(string $slug)
    {
        $managers = ManagerResource::collection(Manager::with(['user', 'educationSchool'])->whereHas('educationSchool', function (Builder $query) {
            $participant = Participant::with(['educationSchool'])->first();
            $query->where('id', $participant->education_school_id);
        })->get());
        return Inertia::render('olympiad/Create', [
            'olympiad' => new OlympiadResource(Olympiad::withDefaultRelations()->whereSlug($slug)->first()),
            'managers' => $managers
        ]);
    }

    public function store(string $olympiad, StoreOlympiadOrderRequest $request)
    {
        $participant = Participant::with(['user', 'attachedManager', 'educationSchool', 'educationSchool.directions'])->whereHas('user', function (Builder $query) {
            $query->where('id', Auth::id());
        })->first();

        $full_name = $participant->user->fullName();
        $birth_date = $participant->birth_date;
        $cours_number = $participant->cours_number;
    }
}
