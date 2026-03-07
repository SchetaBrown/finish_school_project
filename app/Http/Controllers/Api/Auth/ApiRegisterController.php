<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Models\EducationDirection;

class ApiRegisterController extends Controller
{
    public function getEducationSchoolByTitle()
    {
        $directions = EducationDirection::with(['schools'])->first();

        return response()->json($directions);
    }
}
