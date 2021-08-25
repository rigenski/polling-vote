<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PollController;
use App\Http\Controllers\DivisionController;
use App\Http\Controllers\UserController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/login', function () {
    return view('login');
})->name('login');

Route::get('/register', [AuthController::class, 'indexRegister']);
Route::post('/postRegister', [AuthController::class, 'register']);

Route::post('/postLogin', [AuthController::class, 'login']);

Route::group(['middleware' => ['auth', 'checkRole:admin,user']], function() {
    Route::get('/', [PollController::class, 'index']);
    Route::get('/change_password', function () {
        return view('change_password');
    });
    
    Route::post('/postChangePassword', [AuthController::class, 'changePassword']);
    Route::get('/logout', [AuthController::class, 'logout']);
    
    
    Route::get('/suggest', [PollController::class, 'indexSuggest']);
    Route::post('/suggest/store', [PollController::class, 'storeSuggest']);
    Route::get('/suggest/{suggest_id}/delete', [PollController::class, 'deleteSuggest']);
}) ;

Route::group(['middleware' => ['auth', 'checkRole:admin']], function() {
    Route::post('/poll', [PollController::class, 'store']);
    Route::get('/poll/{poll_id}/edit', [PollController::class, 'edit']);
    Route::post('/poll/{poll_id}/update', [PollController::class, 'update']);
    Route::get('/poll/{poll_id}/delete', [PollController::class, 'delete']);
    Route::post('/poll/{poll_id}/vote/{vote_id}', [PollController::class, 'vote']);
    Route::get('/division', [DivisionController::class, 'index']);
    Route::post('/division/store', [DivisionController::class, 'store']);
    Route::get('/division/{division_id}', [DivisionController::class, 'edit']);
    Route::get('/division/{division_id}/update', [DivisionController::class, 'update']);
    Route::get('/division/{division_id}/delete', [DivisionController::class, 'delete']);
    Route::get('/user', [UserController::class, 'index']);
    Route::post('/user/store', [UserController::class, 'store']);
    Route::get('/user/{user_id}/', [UserController::class, 'edit']);
    Route::post('/user/{user_id}/update', [UserController::class, 'update']);
    Route::get('/user/{user_id}/delete', [UserController::class, 'delete']);
});

Route::group(['middleware' => ['auth', 'checkRole:user']], function() {
    Route::get('/poll/{poll_id}/vote/{choice_id}', [PollController::class, 'vote']);
});
