<?php

namespace App\Http\Controllers\Web\Olympiad\Managment;

use App\Http\Controllers\Controller;
use App\Http\Resources\Olympiad\OlympiadResource;
use App\Models\Olympiad;
use App\Models\OlympiadOrder;
use Inertia\Inertia;

class OlympiadManagerOrderController extends Controller
{
    public function index(string $olympiad)
    {
        $orders = OlympiadOrder::with(['participant'])->get();
        $olympiad = new OlympiadResource(Olympiad::where('slug', $olympiad)->first());

        return Inertia::render('olympiad/management/olympiad-manager/Index', [
            'orders' => $orders,
            'olympiad' => $olympiad->title
        ]);
    }
}
