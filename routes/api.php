<?php

use App\Http\Controllers\Api\Olympiad\ApiOlympiadController;
use Illuminate\Support\Facades\Route;

Route::get('/get-olympiads', [ApiOlympiadController::class, 'index']);
