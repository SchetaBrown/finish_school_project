<?php

namespace App\Http\Controllers\Web\Admin\Olympiad;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Olympiad\Direction\StoreOlympiadDirectionRequest;
use App\Http\Requests\Admin\Olympiad\Direction\UpdateOlympiadDirectionRequest;
use App\Models\OlympiadDirection;
use Exception;

class AdminOlympiadDirectionController extends Controller
{
    public function index()
    {

    }

    public function store(StoreOlympiadDirectionRequest $request)
    {
        try {
            OlympiadDirection::create($request->validated());
            return redirect()->back()->with('success', 'Направление олимпиады создано');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Возникла ошибка, попробуйте позже');
        }
    }

    public function edit(UpdateOlympiadDirectionRequest $request)
    {
        try {
            OlympiadDirection::update($request->validated());
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Возникла ошибка, попробуйте позже');
        }
    }

    public function destroy()
    {

    }
}
