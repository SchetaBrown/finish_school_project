<?php

namespace App\Http\Controllers\Web\Olympiad;

use App\Http\Controllers\Controller;
use App\Http\Requests\Olympiad\StoreOlympiadOrderRequest;
use App\Http\Resources\Olympiad\OlympiadResource;
use App\Http\Resources\User\EducationManagerResource;
use App\Models\EducationManager;
use App\Models\Olympiad;
use App\Models\OlympiadDocument;
use App\Models\OlympiadOrder;
use App\Models\Participant;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Storage;

class OlympiadOrderController extends Controller
{
    public function create(string $slug)
    {
        $managers = EducationManagerResource::collection(EducationManager::with(['user', 'educationSchool'])->whereHas('educationSchool', function (Builder $query) {
            $participant = Participant::with(['educationSchool'])->first();
            $query->where('id', $participant->education_school_id);
        })->get());
        return Inertia::render('olympiad/Create', [
            'olympiad' => new OlympiadResource(Olympiad::withDefaultRelations()->whereSlug($slug)->first()),
            'managers' => $managers
        ]);
    }

    public function store(string $olympiad, StoreOlympiadOrderRequest $request)
    {
        try {
            $participant = Participant::with(['user', 'attachedManager', 'educationSchool', 'educationDirection'])->whereHas('user', function (Builder $query) {
                $query->where('id', Auth::id());
            })->first();

            $olympiad = Olympiad::with(['educationDirection'])->whereSlug($olympiad)->first();

            $existingOrder = OlympiadOrder::where('participant_id', $participant->id)
                ->where('olympiad_id', $olympiad->id)
                ->first();

            if ($existingOrder) {
                throw new Exception('Вы уже записаны на данную олимпиаду');
            }

            $validated = $request->validated();

            $age = Carbon::parse($participant->birth_date)->diffInYears(Carbon::parse($olympiad->register_start_date));

            $order = OlympiadOrder::create([
                'is_hostel' => $validated['is_hostel'] ?? false,
                'arrival_date' => $validated['arrival_date'] ?? null,
                'departure_date' => $validated['departure_date'] ?? null,
                'participant_id' => $participant->id,
                'education_manager_id' => $validated['education_manager_id'],
                'olympiad_id' => $olympiad->id,
            ]);

            $pdf = Pdf::loadView('docs.user.participant-document-pdf', [
                'full_name' => $participant->user->fullName(),
                'birth_date' => $participant->birth_date,
                'cours_number' => $participant->cours_number,
                'direction' => "{$participant->educationDirection->code} {$participant->educationDirection->title}",
                'manager_info' => "{$participant->attachedManager->fullname()}, {$participant->attachedManager->phone}",
                'needParentData' => $age < 18,
                'direction_code' => $olympiad->educationDirection->code,
                'direction_title' => $olympiad->educationDirection->title,
            ]);

            $output = $pdf->output();

            if (!Storage::disk('public')->exists('docs/participants')) {
                Storage::disk('public')->makeDirectory('docs/participants');
            }

            $filename = "docs/participants/Олимпиада - {$olympiad->title}/{$participant->user->login}/Участие в олимпиаде {$olympiad->title}" . '.pdf';
            Storage::disk('public')->put($filename, $output);

            OlympiadDocument::create([
                'type' => 'pdf',
                'path' => $filename,
                'user_id' => $participant->id,
                'olympiad_order_id' => $order->id,
            ]);

            return redirect()->route('olympiad.index')->with('success', config('constants.flash_statuses.success'));
        } catch (Exception $e) {
            dd($e->getMessage());
            return redirect()->back()->with('error', 'Возникла ошибка при оформлении');
        }
    }
}
