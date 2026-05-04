<?php

namespace App\Http\Controllers\Web\Olympiad;

use App\Http\Controllers\Controller;
use App\Http\Requests\Olympiad\New\StoreOlympiadNewRequest;
use App\Http\Resources\Olympiad\OlympiadNewResource;
use App\Models\Olympiad;
use App\Models\OlympiadNew;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use Inertia\Inertia;

class OlympiadNewController extends Controller
{
    public function index()
    {

    }
    public function show(string $olympiad, string $new)
    {
        try {
            $olympiad_title = Olympiad::whereSlug($olympiad)->first();
            $olympiad_new = new OlympiadNewResource(OlympiadNew::with(['olympiad'])->where('slug', $new)->first());
            $olympiad_news = OlympiadNewResource::collection(OlympiadNew::with(['olympiad'])->whereHas('olympiad', function(Builder $query) use($olympiad) {
                $query->whereSlug($olympiad);
            })->get());
            return Inertia::render('olympiad/new/Show', [
                'new' => $olympiad_new,
                'olympiad_title' => $olympiad_title->title,
                'olympiad_news' => $olympiad_news
            ]);
        } catch (Exception $e) {
            return back()->with('info', 'Такой новости не существует.');
        }
    }

    public function store(StoreOlympiadNewRequest $request)
    {
        try {
            OlympiadNew::create($request->validated());
            return redirect()->back()->with('success', config('constants.flash_statuses.success'));
        } catch (Exception $e) {
            return back()->with('info', config('constants.flash_statuses.error'));
        }
    }

    public function destroy()
    {

    }
}
