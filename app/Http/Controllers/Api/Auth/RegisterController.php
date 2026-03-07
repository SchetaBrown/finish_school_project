<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Models\EducationDirection;

class RegisterController extends Controller
{
    public function getEducationSchoolByTitle($title)
    {
        $directions = EducationDirection::with(['schools'])->where('education_schools.title', $title)->get();

        return response()->json($directions);
    }
}
