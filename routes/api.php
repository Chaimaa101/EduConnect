<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CourController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\UserController;
use App\Models\Cour;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

// Route::get('/', function () {  
//     return 'api';
// });


Route::apiResource('cours', CourController::class)->except('index')->middleware('auth:sanctum');

Route::middleware(['auth:sanctum', 'isAdmin'])->group(function () {
Route::apiResource('users', UserController::class);

});

Route::post('register', [AuthController::class,'register']);
Route::post('login', [AuthController::class,'login'])->name('login');

Route::post('logout', [AuthController::class,'logout'])->middleware('auth:sanctum');

Route::get('cours', [CourController::class,'index']);


Route::get('mycourses', [StudentController::class,'index'])->middleware('auth:sanctum');
Route::post('/cours/{cour}/enroll', [StudentController::class,'store'])->middleware('auth:sanctum');

Route::get('test-enroll', function () {
    $user = User::find(2); // Student
    $cour = Cour::find(1); // Course

    $user->coursesEnrolled()->attach($cour->id);

    return $user->coursesEnrolled;
});