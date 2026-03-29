<?php

namespace App\Action\Olympiad;

use App\Http\Resources\Olympiad\OlympiadResource;
use App\Models\Olympiad;
use App\Models\OlympiadDirection;
use App\Models\OlympiadStatus;
use Illuminate\Http\Request;

class GetOlympiadsIndexDataAction
{
    public function execute(
        Request $request,
        ?bool $isAdminRoute = false,
    ): array {
        $olympiads = Olympiad::withDefaultRelations()->filter($request->all())->paginate(config('constants.per_page'))->withQueryString();
        $statuses = OlympiadStatus::withoutDraft($isAdminRoute)->get();
        $directions = OlympiadDirection::get();

        return [
            'olympiads' => OlympiadResource::collection($olympiads),
            'statuses' => $statuses,
            'directions' => $directions,
        ];
    }
}
