<?php

namespace App\Http\Controllers\Web\Admin\Olympiad;

use App\Http\Controllers\Controller;
use App\Http\Resources\Olympiad\OlympiadResource;
use App\Models\Olympiad;
use Inertia\Inertia;

class AdminOlympiadController extends Controller
{
    public function index()
    {
        $olympiads = Olympiad::withDefaultRelations()->paginate(10);

        $olympiads_count = $olympiads->count();

        return Inertia::render('admin/olympiad/Index', [
            'olympiads' => OlympiadResource::collection($olympiads),
            'olympiads_count' => $olympiads_count,
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
