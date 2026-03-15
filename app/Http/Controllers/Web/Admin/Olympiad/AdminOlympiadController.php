<?php

namespace App\Http\Controllers\Web\Admin\Olympiad;

use App\Http\Controllers\Controller;
use Inertia\Inertia;

class AdminOlympiadController extends Controller
{
    public function index()
    {
        return Inertia::render('admin/olympiad/Index');
    }
}
