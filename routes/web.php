<?php

namespace App\Http\Controllers;
use App\Http\Controllers\articlecontroller;
use App\Http\Controllers\permissioncontroller;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Rolecontroller;
use App\Http\Controllers\usercontroller;
use App\Http\Controllers\TestController;


    // use App\Http\Controllers\PermissionController;
// use App\Http\Controllers\RoleController;
// use App\Http\Controllers\RoleController;
use App\Models\User;
use Illuminate\Support\Facades\Route;







// /*
// |--------------------------------------------------------------------------
// | Web Routes
// |--------------------------------------------------------------------------
// |
// | Here is where you can register web routes for your application. These
// | routes are loaded by the RouteServiceProvider and all of them will
// | be assigned to the "web" middleware group. Make something great!
// |
// */



Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

 Route::get('/admin', [TestController::class, 'adminOnly'])->middleware('role:admin');
 Route::resource('users', UserController::class);
Route::resource('roles', RoleController::class);
Route::resource('permissions', PermissionController::class);
Route::resource('articles', ArticleController::class);
Route::resource('permissions', PermissionController::class)->except(['show']);
// Route::resource('permissions', PermissionController::class);
// Route::resource('articles', ArticleController::class);

// Route::post('/articles/store', [ArticleController::class, 'store'])->name('articles.store');

});
    // PERMISION ROUTE PATHA
    
    Route::get('/permissions', [PermissionController::class, 'index'])->name('permissions.index');
    // Route::get ('/permissions', [permissioncontroller::class, 'index'])->name( 'permissions.index');
    Route::get ('/permissions/create', [permissioncontroller::class, 'create'])->name('permissions.create');
    Route::POST('/permissions/store', [permissioncontroller::class, 'store'])->name( 'permissions.store');
    Route::get('/permissions/{id}/edit', [permissioncontroller::class, 'edit'])->name( 'permissions.edit');
    Route::get('permissions/{id}', [permissioncontroller::class, 'update'])->name( 'permissions.update');
    // Route::delete('/permissions', [permissioncontroller::class, 'destroy'])->name( 'permissions.destroy');
    Route::delete('/permissions', [PermissionController::class, 'destroy'])->name('permissions.destroy');




    
    // ROLES ROUTE PATH



 // ----------- Roles Routes -----------
Route::get('/roles', [rolecontroller::class, 'index'])->name('roles.index');
Route::get('/roles/create', [rolecontroller::class, 'create'])->name('roles.create');
Route::POST('/roles', [rolecontroller::class, 'store'])->name('roles.store');
Route::get('/roles/{id}/edit', [rolecontroller::class, 'edit'])->name('roles.edit');
Route::get('/roles/{id}', [rolecontroller::class, 'update'])->name('roles.update');
Route::delete('/roles', [rolecontroller::class, 'destroy'])->name('roles.destroy');


 // ARTICLE ROUTE PATH
    
    Route::get ('/articles', [articlecontroller::class, 'index'])->name( 'articles.index');
    Route::get ('/articles/create', [articlecontroller::class, 'create'])->name('articles.create');
    Route::POST('/articles/store', [articlecontroller::class, 'store'])->name( 'articles.store');
    Route::get('/articles/{id}/edit', [articlecontroller::class, 'edit'])->name( 'articles.edit');
    Route::get('articles/{id}', [articlecontroller::class, 'update'])->name( 'articles.update');
  Route::delete('/articles', [articlecontroller::class, 'destroy'])->name('articles.destroy');


  Route::get ('/users', [usercontroller::class, 'index'])->name( 'users.index');
    Route::get ('/users/create', [usercontroller::class, 'create'])->name('users.create');
    Route::POST('/users/store', [usercontroller::class, 'store'])->name( 'users.store');
   Route::get('/users/{id}/edit', [usercontroller::class, 'edit'])->name( 'users.edit');
    Route::get('users/{id}', [usercontroller::class, 'update'])->name( 'users.update');
//   Route::delete('/articles', [articlecontroller::class, 'destroy'])->name('a




//

 // Admin Protected Route
   
//

Route::resource('roles', RoleController::class);

Route::get('/check-roles', function () {
    $user = \App\Models\User::find(1);
    return $user->getRoleNames(); // Should return ["Admin"]
});


Route::get('/check-roles', function () {
    $user = User::find(1); // Replace 1 with any user ID
    return $user->getRoleNames(); // Should return: ["Admin"]
});

//
//


require __DIR__.'/auth.php';