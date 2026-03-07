<?php

use App\Http\Controllers\Api\Auth\RegisterController;
use Illuminate\Support\Facades\Route;

Route::get('/get-education-directions/{title}', [RegisterController::class, 'getEducationSchoolByTitle']);
