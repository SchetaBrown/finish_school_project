<?php

namespace App\Http\Controllers\Web\Olympiad;

use App\Action\Olympiad\GetOlympiadsIndexDataAction;
use App\Http\Controllers\Controller;
use App\Http\Resources\Olympiad\OlympiadResource;
use App\Models\Olympiad;
use App\Models\OlympiadOrder;
use Auth;
use Illuminate\Http\Request;
use Inertia\Inertia;

class OlympiadController extends Controller
{
    public function index(GetOlympiadsIndexDataAction $action, Request $request)
    {
        return Inertia::render(
            'Index',
            $action->execute(request: $request)
        );
    }

    public function show($olympiad)
    {
        $olympiad = Olympiad::withDefaultRelations()->whereSlug($olympiad)->first();
        $is_register_participant = null;

        if (Auth::user() && Auth::user()->participant) {
            $is_register_participant = OlympiadOrder::where('participant_id', Auth::user()->participant->id)
                ->where('olympiad_id', $olympiad->id)
                ->first();
        }

        return Inertia::render(
            'olympiad/Show',
            [
                'olympiad' => new OlympiadResource($olympiad),
                'is_register_participant' => $is_register_participant ? true : false,
            ]
        );
    }
}
