<?php

namespace App\Http\Controllers\Web\Admin\User;

use App\Action\User\GetUsersDataForAdminPageAction;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AdminUserController extends Controller
{
    public function index(GetUsersDataForAdminPageAction $action, Request $request)
    {
        return Inertia::render('admin/user/Index', $action->execute($request->all()));
    }

    public function edit($id)
    {
        dd($id);
    }
}
