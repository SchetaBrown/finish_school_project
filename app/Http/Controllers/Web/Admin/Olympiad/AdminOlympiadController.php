<?php

namespace App\Http\Controllers\Web\Admin\Olympiad;

use App\Http\Controllers\Controller;
use App\Http\Resources\Olympiad\OlympiadDirectionResource;
use App\Http\Resources\Olympiad\OlympiadResource;
use App\Http\Resources\Olympiad\OlympiadStatusResource;
use App\Models\Olympiad;
use App\Models\OlympiadDirection;
use App\Models\OlympiadStatus;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AdminOlympiadController extends Controller
{
    public function index(Request $request)
    {
        $olympiads = Olympiad::withDefaultRelations()->filter($request->all())->paginate(10);

        $olympiads_count = $olympiads->count();

        $directions = OlympiadDirectionResource::collection(OlympiadDirection::get());
        $statuses = OlympiadStatusResource::collection(OlympiadStatus::get());

        return Inertia::render('admin/olympiad/Index', [
            'olympiads' => OlympiadResource::collection($olympiads),
            'olympiads_count' => $olympiads_count,
            'directions' => $directions,
            'statuses' => $statuses,
        ]);
    }

    public function create()
    {

    }

    public function store()
    {

    }

    public function destroy()
    {

    }
}
