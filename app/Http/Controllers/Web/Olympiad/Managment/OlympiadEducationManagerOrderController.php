<?php

namespace App\Http\Controllers\Web\Olympiad\Managment;

use App\Http\Controllers\Controller;
use App\Http\Requests\Olympiad\UpdateOlympiadOrderByEducationManagerRequest;
use App\Http\Resources\Olympiad\OlympiadOrderResource;
use App\Http\Resources\Olympiad\OlympiadOrderStatusResource;
use App\Models\Olympiad;
use App\Models\OlympiadDocument;
use App\Models\OlympiadOrder;
use App\Models\OlympiadOrderStatus;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class OlympiadEducationManagerOrderController extends Controller
{
    public function index(Request $request, string $olympiad)
    {
        $orders = OlympiadOrder::with(['participant', 'olympiadDocument', 'participant.educationSchool', 'olympiad', 'educationManager', 'olympiadOrderStatus'])
            ->filter($request->all())
            ->whereHas('olympiad', function ($query) use ($olympiad) {
                $query->where('slug', $olympiad);
            })
            ->paginate(config('constants.per_page'));
        $olympiad = Olympiad::whereSlug($olympiad)->first();

        $statuses = OlympiadOrderStatusResource::collection(OlympiadOrderStatus::get());

        return Inertia::render('olympiad/management/education-manager/Index', [
            'orders' => OlympiadOrderResource::collection($orders),
            'olympiad' => $olympiad->slug,
            'statuses' => $statuses
        ]);
    }

    public function update(string $olympiad, string $id, UpdateOlympiadOrderByEducationManagerRequest $request)
    {
        try {
            $order = OlympiadOrder::with('olympiad')->findOrFail($id);

            if (now()->startOfDay()->greaterThanOrEqualTo($order->olympiad->register_end_date)) {
                throw new Exception('Регистрация на данную олимпиаду закрыта. Изменение заявки невозможно');
            }

            $statuses = OlympiadOrderStatus::get()->keyBy('slug');

            $validated = $request->validated();

            if (!empty($validated['reject_message'])) {
                $updateData = [
                    'reject_message' => $validated['reject_message'],
                    'olympiad_order_status_id' => $statuses['rejected']->id,
                    'is_education_manager_accept' => false,
                ];
            } elseif (isset($validated['is_education_manager_accept'])) {
                $value = filter_var($validated['is_education_manager_accept'], FILTER_VALIDATE_BOOLEAN);

                if ($value === false) {
                    $updateData = [
                        'reject_message' => null,
                        'olympiad_order_status_id' => $statuses['out_application']->id,
                        'is_education_manager_accept' => false,
                    ];
                } else {
                    $updateData = [
                        'reject_message' => null,
                        'olympiad_order_status_id' => $statuses['for_consideration']->id,
                        'is_education_manager_accept' => true,
                    ];
                }
            } else {
                $updateData = [
                    'reject_message' => null,
                    'olympiad_order_status_id' => $statuses['accepted']->id,
                    'is_education_manager_accept' => true,
                ];
            }

            $order->update($updateData);

            return redirect()->back()->with('success', config('constants.flash_statuses.success'));

        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function download(string $olympiad, string $id)
    {
        $document = OlympiadDocument::findOrFail($id);

        if (!Storage::disk('public')->exists($document->path)) {
            abort(404, 'Файл не найден на сервере');
        }

        return Storage::disk('public')->download($document->path);
    }
}
