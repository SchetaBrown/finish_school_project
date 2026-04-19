<?php

namespace App\Http\Controllers\Web\Admin\Olympiad;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Olympiad\StoreOlympiadRequest;
use App\Http\Resources\Olympiad\OlympiadDirectionResource;
use App\Http\Resources\Olympiad\OlympiadResource;
use App\Http\Resources\Olympiad\OlympiadStatusResource;
use App\Http\Resources\Olympiad\OlympiadTypeResource;
use App\Http\Resources\User\UserResource;
use App\Models\Olympiad;
use App\Models\OlympiadDirection;
use App\Models\OlympiadStatus;
use App\Models\OlympiadType;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AdminOlympiadController extends Controller
{
    public function index(Request $request)
    {
        $olympiads = Olympiad::withDefaultRelations()->filter($request->all())->paginate(config('constants.per_page'));

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
        $olympiad_managers = UserResource::collection(User::with(['role'])->whereHas('role', function ($query) {
            $query->where('title', 'ответственный');
        })->get());
        $directions = OlympiadDirectionResource::collection(OlympiadDirection::get());
        $types = OlympiadTypeResource::collection(OlympiadType::get());
        return Inertia::render('admin/olympiad/Create', compact(['olympiad_managers', 'directions', 'types']));
    }

    public function edit(string $slug)
    {
        $directions = OlympiadDirectionResource::collection(OlympiadDirection::get());
        $olympiad_managers = UserResource::collection(User::with(['role'])->whereHas('role', function ($query) {
            $query->where('title', 'ответственный');
        })->get());

        $olympiad = new OlympiadResource(Olympiad::with(['types', 'olympiadDirection', 'olympiadStatus', 'olympiadManager'])->where('slug', $slug)->first());
        $types = OlympiadTypeResource::collection(OlympiadType::get());
        return Inertia::render('admin/olympiad/Edit', compact(['olympiad', 'directions', 'olympiad_managers', 'types']));
    }

    public function store(StoreOlympiadRequest $request)
    {
        try {
            $validated = $request->validated();

            $new_status = OlympiadStatus::where('title', 'открыта регистрация')->first();

            $olympiad = Olympiad::create([
                'title' => $validated['title'],
                'description' => $validated['description'],
                'register_start_date' => $validated['register_start_date'],
                'register_end_date' => $validated['register_end_date'],
                'start_date' => $validated['start_date'],
                'slug' => '',
                'end_date' => $validated['end_date'],
                'max_player_register_count' => $validated['max_player_register_count'],
                'olympiad_status_id' => $new_status->id,
                'olympiad_manager_id' => $validated['olympiad_manager_id'],
                'olympiad_direction_id' => $validated['olympiad_direction_id'],
            ]);

            $olympiad->types()->attach($validated['olympiad_types']);

            return redirect()->route('admin.olympiad.index')->with('success', 'Олимпиада создан');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Возникла ошибка, попробуйте позже');
        }
    }

    public function destroy($slug)
    {
        try {
            Olympiad::where('slug', $slug)->delete();

            return redirect()->back()->with('success', 'Олимпиада удалена');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Возникла ошибка, попробуйте позже');
        }
    }
}
