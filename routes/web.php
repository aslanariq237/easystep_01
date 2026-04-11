<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ModuleController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\ForumController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('', [ModuleController::class, 'dashboard'])->middleware(['auth', 'verified'])->name('dashboard');

Route::get('admin-dashboard', [ModuleController::class, 'adminDashboard'])
    ->middleware('auth', 'role:admin')
    ->name('adminDashboard');

Route::get('/module_parent', [ModuleController::class, 'indexParent'])->name('module.indexParent');
Route::get('/module_children', [ModuleController::class, 'indexChildren'])->name('module.indexChildren');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


    Route::resource('modules', ModuleController::class);
    Route::resource('articles', ArticleController::class);
    Route::resource('forum', ForumController::class)
        ->parameters(['forum' => 'forumPost']);
    Route::post('forum-comment/{forumPost}', [ForumController::class, 'storeComment'])->name('forum-comments.post');
    Route::post('/forum/{forumPost}/like', [ForumController::class, 'toggleLike'])->name('forum.like');
    Route::get('/modules/{module}/detail/{section?}', [ModuleController::class, 'detail'])->name('module.detail');
});

require __DIR__.'/auth.php';
