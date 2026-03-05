<?php

namespace App\Http\Controllers\Web\Olympiad;

use App\Action\Olympiad\GetOlympiadsIndexDataAction;
use App\Http\Controllers\Controller;
use App\Models\Olympiad;
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

    public function show(string $slug)
    {
        return Inertia::render(
            'olympiad/Show',
            [
                'olympiad' => Olympiad::whereSlug($slug)->first(),
            ]
        );
    }
}
