<?php

namespace App\Http\Controllers\Web\Olympiad\Managment;

use App\Http\Controllers\Controller;
use App\Models\OlympiadOrder;
use Inertia\Inertia;

class OlympiadEducationManagerOrderController extends Controller
{
    public function index(string $olympiad)
    {
        $orders = OlympiadOrder::with(['participant', 'olympiad', 'educationManager'])
            ->whereHas('olympiad', function ($query) use ($olympiad) {
                $query->where('slug', $olympiad);
            })
            ->get();
        return Inertia::render('olympiad/management/education-manager/Index', [
            'orders' => $orders
        ]);
    }
}
