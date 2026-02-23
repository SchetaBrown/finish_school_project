<?php

namespace App\Repositories\Olympiad;

use App\Http\Resources\Olympiad\OlympiadResource;
use App\Models\Olympiad;
use App\Models\OlympiadDirection;
use App\Models\OlympiadStatus;
use App\Models\OlympiadType;
use App\Repositories\BaseRepository;
use App\Repositories\Interfaces\OlympiadRepositoryInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class OlympiadRepository extends BaseRepository implements OlympiadRepositoryInterface
{
    // Получение всех олимпиад
    public function getAllOlympiads(Request $request, $paginate = 10)
    {
        $query = $this->getOlympiadWithCalls();

        $filterRequest = $this->filterOlympiadRequest($request, $query);

        $olympiads = $filterRequest->paginate(parent::PER_PAGE)->withQueryString();

        return OlympiadResource::collection($olympiads);
    }

    // Получение всех статустов олимпиад
    public function getAllOlympiadStatuses()
    {
        return OlympiadStatus::get();
    }

    // Получение всех типов учатстия олимпиад
    public function getAllOlympiadTypes()
    {
        return OlympiadType::get();
    }

    // Получение всех направлений олимпиад
    public function getAllOlympiadDirections()
    {
        return OlympiadDirection::get();
    }

    // Получение конкретных данных об олимпиаде
    public function getOlympiadById($id)
    {
        return new OlympiadResource($this->getOlympiadWithCalls()->findOrFail($id));
    }

    // Получить Query-запрос для олимпиад с загруженными связями
    private function getOlympiadWithCalls()
    {
        return Olympiad::with(['olympiadStatus', 'olympiadDirection', 'types']);
    }

    // Фильтрация олимпиад по запросу пользователя
    private function filterOlympiadRequest(Request $request, Builder $query)
    {
        return $query
            ->when($request->filled('title'), function ($q) use ($request) {
                $q->where('title', 'LIKE', "%{$request->title}%");
            })
            ->when($request->filled('direction'), function ($q) use ($request) {
                $q->whereHas('olympiadDirection', function ($subQ) use ($request) {
                    $subQ->where('slug', $request->direction);
                });
            })
            ->when($request->filled('status'), function ($q) use ($request) {
                $q->whereHas('olympiadStatus', function ($subQ) use ($request) {
                    $subQ->where('slug', $request->status);
                });
            });
    }
}
