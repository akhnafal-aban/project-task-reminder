<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\TaskController as AdminTaskController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register']);
});

Route::post('/logout', [LoginController::class, 'logout'])->middleware('auth')->name('logout');

Route::middleware('auth')->get('/dashboard', function () {
    $user = auth()->user();
    if ($user->isAdmin()) {
        return redirect()->route('admin.dashboard');
    }
    if ($user->isMember()) {
        return redirect()->route('member.dashboard');
    }
    abort(403);
})->name('dashboard');

Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');
    // Project resource
    Route::resource('projects', ProjectController::class);
    // Project custom routes
    Route::get('projects/{project}/tasks/create', [ProjectController::class, 'createTask'])->name('projects.tasks.create');
    Route::post('projects/{project}/tasks', [ProjectController::class, 'storeTask'])->name('projects.tasks.store');
    Route::get('projects/{project}/tasks/{task}/edit', [ProjectController::class, 'editTask'])->name('projects.tasks.edit');
    Route::put('projects/{project}/tasks/{task}', [ProjectController::class, 'updateTask'])->name('projects.tasks.update');

    // User management
    Route::resource('users', UserController::class);

    // Task management (index, show, comment)
    Route::prefix('tasks')->name('tasks.')->group(function () {
        Route::get('/', [AdminTaskController::class, 'index'])->name('index');
        Route::get('/create', [AdminTaskController::class, 'create'])->name('create');
        Route::get('/{task}/edit', [AdminTaskController::class, 'edit'])->name('edit');
        Route::get('/{task}', [AdminTaskController::class, 'show'])->name('show');
        Route::post('/{task}/comment', [AdminTaskController::class, 'storeComment'])->name('comment');
        Route::post('/', [AdminTaskController::class, 'store'])->name('store');
        Route::put('/{task}', [AdminTaskController::class, 'update'])->name('update');
        Route::delete('/{task}', [AdminTaskController::class, 'destroy'])->name('destroy');
    });
});

Route::middleware(['auth', 'role:member'])->prefix('member')->name('member.')->group(function () {
    Route::get('/dashboard', function () {
        return view('member.dashboard');
    })->name('dashboard');
    // Tambahkan route member lain di sini
});
