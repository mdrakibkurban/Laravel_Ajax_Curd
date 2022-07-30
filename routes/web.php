<?php

use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\StudentInformationController;
use App\Models\Post;
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
});

Route::get('admin/dashboard', function () {
    $data['posts'] = Post::latest()->simplePaginate(5);
    return view('admin.dashboard.index',$data);
})->middleware(['auth'])->name('dashboard');



Route::prefix('admin')->middleware(['auth'])->group(function(){

    Route::post('/posts/store',[PostController::class,'store']);
    Route::get('/posts/edit/{id}',[PostController::class,'edit']);
    Route::post('/posts/update/{id}',[PostController::class,'update']);
    Route::post('/posts/delete/{id}',[PostController::class,'destroy']);

});
require __DIR__.'/auth.php';
