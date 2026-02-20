<?php

namespace App\Repositories;

use App\Http\Resources\Olympiad\OlympiadDirectionResource;
use App\Http\Resources\Olympiad\OlympiadResource;
use App\Http\Resources\Olympiad\OlympiadStatusResource;
use App\Http\Resources\Olympiad\OlympiadTypeResource;
use App\Models\Olympiad;
use App\Models\OlympiadDirection;
use App\Models\OlympiadStatus;
use App\Models\OlympiadType;
use App\Repositories\Interfaces\OlympiadRepositoryInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class OlympiadRepository implements OlympiadRepositoryInterface
{
    // Получение всех олимпиад
    public function getAllOlympiads(Request $request, $paginate = 10)
    {
        $query = $this->getOlympiadWithCalls();

        $filterRequest = $this->filterOlympiadRequest($request, $query);

        $olympiads = $filterRequest->paginate($paginate)->withQueryString();

        return OlympiadResource::collection($olympiads);
    }

    // Получение всех статустов олимпиад
    public function getAllOlympiadStatuses()
    {
        return OlympiadStatusResource::collection(OlympiadStatus::get());
    }

    // Получение всех типов учатстия олимпиад
    public function getAllOlympiadTypes()
    {
        return OlympiadTypeResource::collection(OlympiadType::get());
    }

    // Получение всех направлений олимпиад
    public function getAllOlympiadDirections()
    {
        return OlympiadDirectionResource::collection(OlympiadDirection::get());
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
        $search_parameters = [
            'title' => 'title',
            'direction' => 'olympiad_direction_id',
            'status' => 'olympiad_status_id',
        ];

        foreach ($search_parameters as $key => $value) {
            if ($request->has($key) && $request->$key) {
                if ($key == 'title') {
                    $query->where($value, 'LIKE', "%{$request->$key}%");
                } else {
                    $query->where($value, $request->$key);
                }
            }
        }

        return $query;
    }
}
