<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Inertia\Inertia;

class AdminIndexController extends Controller
{
    public function index()
    {
        return Inertia::render('admin/Index');
    }
}
