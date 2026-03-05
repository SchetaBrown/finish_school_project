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
        ?int $perPage = 10,
        ?bool $isAdminRoute = false,
    ): array {
        $olympiads = OlympiadResource::collection(Olympiad::withDefaultRelations()->filter($request->all())->paginate($perPage)->withQueryString());
        $olympiad_count = $olympiads->count();
        $statuses = OlympiadStatus::withoutDraft($isAdminRoute)->get();
        $directions = OlympiadDirection::get();

        return compact(['olympiads', 'olympiad_count', 'statuses', 'directions']);
    }
}
