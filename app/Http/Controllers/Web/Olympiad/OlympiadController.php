<?php

namespace App\Http\Controllers\Web\Olympiad;

use App\Action\Olympiad\GetOlympiadsIndexDataAction;
use App\Http\Controllers\Controller;
use App\Http\Resources\Olympiad\OlympiadResource;
use App\Models\Olympiad;
use App\Models\OlympiadOrder;
use Auth;
use Illuminate\Database\Eloquent\Builder;
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

    public function show(string $olympiad)
    {
        $user = Auth::user();
        $show_olympiad = Olympiad::withDefaultRelations()->whereSlug($olympiad)->first();
        $is_register_participant = null;
        $order_status = null;

        if (Auth::check() && $user->participant) {
            $is_register_participant = OlympiadOrder::where('participant_id', $user->participant->id)
                ->where('olympiad_id', $show_olympiad->id)
                ->first();

            $olympiadOrder = OlympiadOrder::with(['olympiadOrderStatus'])->where('participant_id', $user->participant->id)->whereHas('olympiad', function (Builder $query) use ($olympiad) {
                $query->where('slug', $olympiad);
            })->first();

            if ($olympiadOrder) {
                $order_status = $olympiadOrder->olympiadOrderStatus->title ?? null;
            }
        }

        return Inertia::render(
            'olympiad/Show',
            [
                'olympiad' => new OlympiadResource($show_olympiad),
                'is_register_participant' => $is_register_participant ? true : false,
                'order_status' => $order_status
            ]
        );
    }
}
