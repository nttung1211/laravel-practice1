<?php

use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::prefix('/posts')->group(function () {
	Route::name('posts.')->group(function () {

		Route::get('', [PostController::class, 'index'])
			->name('index')->middleware('auth');

		Route::get('create', [PostController::class, 'create'])
			->name('create')->middleware('auth');

		Route::post('store', [PostController::class, 'store'])
			->name('store')->middleware('auth');

		Route::delete('delete/{id}', [PostController::class, 'delete'])
			->name('delete')->middleware('auth');

	});
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
