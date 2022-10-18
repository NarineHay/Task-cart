<?php

use App\Http\Controllers\Api\FilteringTasksByAssignedUserController;
use App\Http\Controllers\Api\GetUsersController;
use App\Http\Controllers\Api\TasksController;
use App\Http\Controllers\Api\TasksHistoriesController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResources([
    'users' => GetUsersController::class,
    'task' => TasksController::class,
    'task/create' => TasksController::class,
    'task/{id}/show' => TasksController::class,
    'task/{id}/destroy' => TasksController::class,
    // 'task-histories' => TasksHistoriesController::class
]);
Route::post('task/{id}',[TasksController::class ,'update' ]);
Route::get('task-histories',[TasksHistoriesController::class , 'index']);
Route::get('filter-tasks-by-assigned-user/{user_id}',[FilteringTasksByAssignedUserController::class , 'index']);


