<?php

namespace App\Http\Controllers\Web\Olympiad\Managment;

use App\Http\Controllers\Controller;
use App\Http\Requests\Olympiad\UpdateOlympiadOrderByEducationManagerRequest;
use App\Http\Resources\Olympiad\OlympiadOrderResource;
use App\Models\Olympiad;
use App\Models\OlympiadDocument;
use App\Models\OlympiadOrder;
use App\Models\OlympiadOrderStatus;
use Exception;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class OlympiadEducationManagerOrderController extends Controller
{
    public function index(string $olympiad)
    {
        $orders = OlympiadOrder::with(['participant', 'olympiadDocument', 'participant.educationSchool', 'olympiad', 'Manager', 'olympiadOrderStatus'])
            ->whereHas('olympiad', function ($query) use ($olympiad) {
                $query->where('slug', $olympiad);
            })
            ->paginate(config('constants.per_page'));
        $olympiad = Olympiad::where('slug', $olympiad)->first();
        return Inertia::render('olympiad/management/education-manager/Index', [
            'orders' => OlympiadOrderResource::collection($orders),
            'olympiad' => $olympiad->slug,
        ]);
    }

    public function update(string $olympiad, string $id, UpdateOlympiadOrderByEducationManagerRequest $request)
    {
        try {
            $order = OlympiadOrder::findOrFail($id);
            $reject_status = OlympiadOrderStatus::where('slug', 'rejected')->first();
            $accept_status = OlympiadOrderStatus::where('slug', 'accepted')->first();

            $validated = $request->validated();

            if (!empty($validated['reject_message']) && $validated['reject_message'] !== null) {
                $order->update([
                    'reject_message' => $validated['reject_message'],
                    'olympiad_order_status_id' => $reject_status->id,
                    'is_education_manager_accept' => false,
                ]);
            } else {
                $order->update([
                    'reject_message' => null,
                    'olympiad_order_status_id' => $accept_status->id,
                    'is_education_manager_accept' => true,
                ]);
            }

            return redirect()->back()->with('success', config('constants.flash_statuses.success'));
        } catch (Exception $e) {
            dd($e->getMessage());
            return redirect()->back()->with('error', config('constants.flash_statuses.error'));
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
