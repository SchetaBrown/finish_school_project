<?php

namespace App\Http\Controllers\Web\Admin\Education;

use App\Http\Controllers\Controller;
use Inertia\Inertia;

class AdminEducationSchoolController extends Controller
{
    public function index()
    {
        return Inertia::render('admin/education/Index');
    }
}
