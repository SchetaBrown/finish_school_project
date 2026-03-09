<?php

namespace App\Http\Controllers\Api\Olympiad;

use App\Action\Olympiad\GetOlympiadsIndexDataAction;
use App\Http\Controllers\Controller;
use App\Http\Resources\Olympiad\OlympiadResource;
use App\Models\Olympiad;
use Illuminate\Http\Request;

class ApiOlympiadController extends Controller
{
    public function index(GetOlympiadsIndexDataAction $action, Request $request)
    {

        $olympiads = OlympiadResource::collection(Olympiad::withDefaultRelations()->filter($request->all())->paginate(10)->withQueryString());

        return response()->json($olympiads);
    }
}
