<?php

namespace App\Repositories\Interfaces;

use Illuminate\Http\Request;

interface OlympiadRepositoryInterface
{
    public function getAllOlympiads(Request $request, $paginate);
    public function getAllOlympiadStatuses();
    public function getAllOlympiadTypes();
    public function getAllOlympiadDirections();
    public function getOlympiadBySlug($slug);
}
