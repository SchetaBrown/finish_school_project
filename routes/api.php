<?php

use App\Http\Controllers\Api\Auth\ApiRegisterController;
use Illuminate\Support\Facades\Route;

Route::get('/get-education-directions', [ApiRegisterController::class, 'getEducationSchoolByTitle']);
