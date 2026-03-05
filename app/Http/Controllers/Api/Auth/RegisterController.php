<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Models\EducationDirection;

class RegisterController extends Controller
{
    public function getEducationSchoolById($id)
    {
        $directions = EducationDirection::with(['schools'])->where('education_school_id', $id)->get();
        return response()->json($directions);
    }
}
