<?php

namespace App\Http\Controllers\Web\Admin\Education;

use App\Http\Controllers\Controller;
use Inertia\Inertia;

class AdminEducationController extends Controller
{
    public function __invoke()
    {
        return Inertia::render('admin/education/Index');
    }
}
