<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\StudentController;
use App\Http\Controllers\Api\TaskController;
use App\Http\Controllers\Api\TaskSubmissionController;

Route::apiResource('students', StudentController::class);
Route::apiResource('tasks', TaskController::class);
Route::apiResource('task-submissions', TaskSubmissionController::class);
Route::get('task-submission', [TaskSubmissionController::class, 'studentWise']);
Route::get('/task-submission/{student_id}', [TaskSubmissionController::class, 'getByStudent']);
Route::apiResource('products', App\Http\Controllers\ProductController::class);
