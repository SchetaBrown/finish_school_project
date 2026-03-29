<?php

namespace App\Http\Controllers\Web\Admin\Education;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Education\StoreEducationSchoolRequest;
use App\Http\Resources\Education\EducationSchoolResource;
use App\Models\EducationSchool;
use Exception;
use Inertia\Inertia;

class AdminEducationSchoolController extends Controller
{
    public function index()
    {
        $schools = EducationSchool::with(['city'])->paginate(config('constants.per_page'));
        return Inertia::render('admin/education/school/Index', [
            'schools' => EducationSchoolResource::collection($schools),
        ]);
    }

    public function create()
    {

    }

    public function store(StoreEducationSchoolRequest $request)
    {
        $validated = $request->validated();

        try {
            EducationSchool::create($validated);
            return redirect()->back()->with('success', 'Учебное заведение создано');
        } catch (Exception $e) {
            return back()->with('error', 'Возникла ошибка при создании учебного заведения, попробуйте позже');
        }
    }

    public function show(string $id)
    {
        $school = EducationSchool::with(['educationDirections'])->find($id);
    }

    public function edit(string $id)
    {

    }

    public function update()
    {

    }
}
