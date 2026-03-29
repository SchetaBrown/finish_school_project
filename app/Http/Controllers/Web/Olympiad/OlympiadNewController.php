<?php

namespace App\Http\Controllers\Web\Olympiad;

use App\Http\Controllers\Controller;
use App\Http\Resources\Olympiad\OlympiadNewResource;
use App\Models\Olympiad;
use App\Models\OlympiadNew;
use Exception;
use Inertia\Inertia;

class OlympiadNewController extends Controller
{
    public function index()
    {

    }
    public function show(string $olympiad, string $new)
    {
        try {
            $new = new OlympiadNewResource(OlympiadNew::with(['olympiad', 'user'])->where('slug', $new)->first());
            return Inertia::render('olympiad/new/Show', [
                'new' => $new
            ]);
        } catch (Exception $e) {
            return back()->with('info', 'Такой новости не существует.');
        }
    }
}
