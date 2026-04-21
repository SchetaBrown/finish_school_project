<?php

namespace App\Http\Controllers\Web\Olympiad\Managment;

use App\Http\Controllers\Controller;
use App\Http\Resources\Education\EducationSchoolResource;
use App\Http\Resources\Olympiad\OlympiadOrderResource;
use App\Http\Resources\Olympiad\OlympiadResource;
use App\Http\Resources\User\EducationManagerResource;
use App\Models\Olympiad;
use App\Models\OlympiadOrder;
use Inertia\Inertia;

class OlympiadManagerOrderController extends Controller
{
    public function index(string $olympiad)
    {
        $orders = OlympiadOrder::with([
            'participant',
            'participant.educationSchool',
            'olympiad',
            'educationManager',
            'educationManager.educationSchool',
            'educationManager.user',
            'participant.user',
            'olympiadOrderStatus'
        ])
            ->whereHas('olympiad', function ($query) use ($olympiad) {
                $query->where('slug', $olympiad);
            })
            ->get();

        $groupedBySchool = [];
        foreach ($orders as $order) {
            $schoolId = $order->participant->educationSchool->id ?? 'no_school';
            $managerId = $order->educationManager->id ?? 'no_manager';

            $key = $managerId . '_' . $schoolId;

            if (!isset($groupedBySchool[$key])) {
                $groupedBySchool[$key] = [
                    'manager' => new EducationManagerResource($order->educationManager),
                    'school' => new EducationSchoolResource($order->participant->educationSchool),
                    'orders' => [],
                ];
            }

            $groupedBySchool[$key]['orders'][] = new OlympiadOrderResource($order);
        }

        $olympiad = new OlympiadResource(Olympiad::where('slug', $olympiad)->first());

        return Inertia::render('olympiad/management/olympiad-manager/Index', [
            'orders' => array_values($groupedBySchool),
            'olympiad' => $olympiad->title,
        ]);
    }

    public function update(string $olympiad, string $id)
    {

    }
}
