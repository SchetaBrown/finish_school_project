<?php

namespace App\Http\Controllers\Web\Admin\Education;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Education\StoreEducationSchoolRequest;
use App\Http\Resources\Education\EducationDirectionResource;
use App\Http\Resources\Education\EducationSchoolResource;
use App\Http\Resources\Other\CityResource;
use App\Models\City;
use App\Models\EducationDirection;
use App\Models\EducationSchool;
use Exception;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AdminEducationSchoolController extends Controller
{
    public function index(Request $request)
    {
        $schools = EducationSchool::with(['city'])->filter($request->all())->paginate(config('constants.per_page'));
        return Inertia::render('admin/education/school/Index', [
            'schools' => EducationSchoolResource::collection($schools),
        ]);
    }

    public function create()
    {
        $cities = CityResource::collection(City::get());
        $directions = EducationDirectionResource::collection(EducationDirection::get());
        return Inertia::render('admin/education/school/Create', compact(['cities', 'directions']));
    }

    public function store(StoreEducationSchoolRequest $request)
    {
        $validated = $request->validated();

        try {
            $school = EducationSchool::create([
                'full_name' => $validated['full_name'],
                'short_name' => $validated['short_name'],
                'inn' => $validated['inn'],
                'phone' => $validated['phone'],
                'director_surname' => $validated['director_surname'],
                'director_name' => $validated['director_name'],
                'director_patronymic' => $validated['director_patronymic'],
                'email' => $validated['email'],
                'max_player_count' => $validated['max_player_count'],
                'city_id' => $validated['city_id'],
            ]);

            $school->educationDirections()->attach($validated['education_directions']);

            return redirect()->route('admin.education.school.index')->with('success', 'Учебное заведение создано');
        } catch (Exception $e) {
            dd($e->getMessage());
            return back()->with('error', 'Возникла ошибка при создании учебного заведения, попробуйте позже');
        }
    }

    public function edit()
    {

    }

    public function update()
    {

    }

    public function destroy(EducationSchool $school)
    {
        try {
            $school->deleteOrFail();

            return redirect()->route('admin.education.school.index')->with('success', config('constants.flash_statuses.success'));
        } catch (Exception $e) {
            return back()->with('error', 'Возникла ошибка при создании учебного заведения, попробуйте позже');
        }
    }
}
