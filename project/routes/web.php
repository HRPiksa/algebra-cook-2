<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RecipeController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\PageController;

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

// Route::get('/', function () {
//     return view('welcome');
// });

/*
 * GET - za čitanje
 * POST -
 * PUT -
 * DELETE -
 */

/* PUBLIC RUTA */
//Route::get( '/', array( HomeController::class, 'index' ) )->middleware( 'auth' );
Route::get('/', array(HomeController::class, 'index'))->name('home');

Route::get('/login', array(LoginController::class, 'index'))->name('login');
Route::get('/register', array(RegisterController::class, 'index'))->name('register');
Route::get('/logout', array(LoginController::class, 'logout'))->name('logout');

// POST rute za registraciju i prijavu
Route::post('/login', array(LoginController::class, 'login'));
Route::post('/register', array(RegisterController::class, 'register'));

// Ova ruta mora biti zaštićena -> middleware('auth')
Route::get('/dashboard', array(UserController::class, 'index'))->name('dashboard');

// Rute za recepte
//Route::get( '/recipe/create', array(RecipeController::class, 'create') )->name( 'recipe-create' )->middleware( 'auth' );
// Route::get('/recipe/create', array(HomeController::class, 'create'))->name('recipe-create');

// Route::post('/recipe/store', array(HomeController::class, 'store'))->name('recipe-store');

// Route::get( '/recipe/{recipe}', array( HomeController::class, 'show' ) )->name('recipe-show');

Route::resource( 'recipes', RecipeController::class );

// Rute za administraciju
Route::prefix('admin')->group(function () {

    // Users in admin panel
    Route::get('/user/create', array(UserController::class, 'create'))->name('user-create');
    Route::post('/user/store', array(UserController::class, 'store'))->name('user-store');

    //domena.com/admin/user/edit/$parametar
    Route::get('/user/edit/{user}', array(UserController::class, 'edit'))->name('user-edit');
    Route::post('/user/update/{user}', array(UserController::class, 'update'))->name('user-update');

    Route::get('/user/delete/{user}', array(UserController::class, 'delete'))->name('user-delete');
    Route::post( '/user/destroy/{user}', array( UserController::class, 'destroy' ) )->name( 'user-destroy' );

    // Rute za uloge
    Route::get('roles/delete/{role}', array(RoleController::class, 'delete'))->name('roles-delete');
    Route::resource('roles', RoleController::class)->middleware('can:manage-roles');

    // Rute za stranice
    Route::get( 'pages/delete/{page}', array( PageController::class, 'delete' ) )->name( 'pages-delete' );
    Route::resource('pages', PageController::class);
});
