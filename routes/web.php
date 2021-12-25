<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RoleController as PeranController;
use App\Http\Controllers\Permissions\RoleController;
use App\Http\Controllers\Permissions\UserController;
use App\Http\Controllers\Permissions\AssignController;
use App\Http\Controllers\Permissions\PermissionController;

Route::get('/', function () {
    return view('welcome');    
});

Route::middleware('has.role')->group(function() {
    Route::view('dashboard', 'dashboard')->name('dashboard');

    Route::prefix('role-and-permission')->namespace('Permissions')->group(function() {
        Route::get('assign/user', [UserController::class, 'create'])->name('assign.user.create');
        Route::post('assign/user', [UserController::class, 'store']);
        Route::get('assign/{user}/user', [UserController::class, 'edit'])->name('assign.user.edit');
        Route::put('assign/{user}/user', [UserController::class, 'update']);

        Route::prefix('assignable')->group(function() {
            Route::get('', [AssignController::class, 'create'])->name('assign.create');
            Route::post('', [AssignController::class, 'store']);    
            Route::get('{role}/edit', [AssignController::class, 'edit'])->name('assign.edit');
            Route::put('{role}/edit', [AssignController::class, 'update']);
        });

        Route::prefix('roles')->group(function() {
            Route::get('', [RoleController::class, 'index'])->name('roles.index');
            Route::post('create', [RoleController::class, 'store'])->name('roles.create');
            Route::get('{role}/edit', [RoleController::class, 'edit'])->name('roles.edit');
            Route::put('{role}/edit', [RoleController::class, 'update']);
        });

        Route::prefix('permissions')->group(function() {
            Route::get('', [PermissionController::class, 'index'])->name('permissions.index');
            Route::post('create', [PermissionController::class, 'store'])->name('permissions.create');
            Route::get('{permission}/edit', [PermissionController::class, 'edit'])->name('permissions.edit');
            Route::put('{permission}/edit', [PermissionController::class, 'update']);
        });
    });
});

Route::prefix('post')->group(function () {
    Route::get('', [PostController::class, 'index'])->name('posts.index');    
    Route::get('create', [PostController::class, 'create'])->name('posts.create');
    Route::post('create', [PostController::class, 'store']);

    Route::group(['middleware' => ['permission:edit post']], function () {
        Route::get('{post}/edit', [PostController::class, 'edit'])->name('posts.edit');
        Route::put('{post}/edit', [PostController::class, 'update']);
    });

    Route::group(['middleware' => ['permission:delete post']], function () {
        Route::get('{post}/delete', [PostController::class, 'delete'])->name('posts.delete');
    });
});

Route::get('role/create', [PeranController::class, 'create'])->name('role.create');
Route::post('role/create', [PeranController::class, 'store']);

Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// $role = Role::whereName('admin')->first();
// $hasRole = auth()->user()->hasAnyRole($roles);
// dd($role->givePermissionTo('create category'));
// $role = Role::find(2);
// $role->givePermissionTo('create post', 'delete post');