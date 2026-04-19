<?php

namespace App\Http\Controllers\Web\Profile;

use App\Http\Controllers\Controller;
use App\Http\Resources\Olympiad\OlympiadOrderResource;
use App\Models\OlympiadOrder;
use Auth;
use Inertia\Inertia;

class ProfileController extends Controller
{
    public function index()
    {
        $participantOlympiadOrders = [];
        $educationManagerOlympiadOrders = [];
        if (auth()->user()->role->title === 'Участник') {
            $participantOlympiadOrders = OlympiadOrder::with(['participant', 'olympiad', 'Manager', 'olympiadDocument', 'olympiadOrderStatus', 'olympiad.olympiadStatus', 'olympiad.olympiadDirection'])
                ->where('participant_id', Auth::user()->participant->id)
                ->paginate(config('constants.per_page'));
        } elseif (auth()->user()->role->title === 'Руководитель') {
            $educationManagerOlympiadOrders = OlympiadOrder::with(['participant', 'olympiad', 'Manager', 'olympiadDocument', 'olympiadOrderStatus', 'olympiad.olympiadStatus', 'olympiad.olympiadDirection'])
                ->where('manager_id', Auth::user()->manager->id)
                ->orderByDesc('created_at')
                ->paginate(config('constants.per_page'));
        }

        return Inertia::render('profile/Index', [
            'participantOlympiadOrders' => OlympiadOrderResource::collection($participantOlympiadOrders),
            'educationManagerOlympiadOrders' => OlympiadOrderResource::collection($educationManagerOlympiadOrders),
            'role' => auth()->user()->role->title
        ]);
    }

    public function destroy()
    {
        Auth::logout();

        return redirect()->route('olympiad.index');
    }
}
