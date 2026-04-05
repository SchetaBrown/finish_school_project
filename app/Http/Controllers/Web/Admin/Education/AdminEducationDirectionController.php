<?php

namespace App\Http\Controllers\Web\Admin\Education;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Education\Direction\StoreEducationDirectionRequest;
use App\Http\Requests\Admin\Education\Direction\UpdateEducationDirectionRequest;
use App\Http\Resources\Education\EducationDirectionResource;
use App\Models\EducationDirection;
use Exception;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AdminEducationDirectionController extends Controller
{

    public function index(Request $request)
    {
        $directions = EducationDirection::filter($request->all())->paginate(config('constants.per_page'));
        return Inertia::render('admin/education/direction/Index', [
            'directions' => EducationDirectionResource::collection($directions),
        ]);
    }

    public function store(StoreEducationDirectionRequest $request)
    {
        try {
            $validated = $request->validated();

            EducationDirection::create($validated);

            return redirect()->back()->with('success', config('constants.flash_statuses.success'));
        } catch (Exception $e) {
            return back()->with('error', config('constants.flash_statuses.error'));
        }
    }

    public function update(UpdateEducationDirectionRequest $request, EducationDirection $direction)
    {
        try {
            $validated = $request->validated();

            $direction->update($validated);

            return redirect()->back()->with('success', config('constants.flash_statuses.success'));
        } catch (Exception $e) {
            return back()->with('error', config('constants.flash_statuses.error'));
        }
    }

    public function destroy(EducationDirection $direction)
    {
        try {
            $direction->deleteOrFail();
            return redirect()->back()->with('success', config('constants.flash_statuses.success'));
        } catch (Exception $e) {
            return back()->with('error', config('constants.flash_statuses.error'));
        }
    }
}

