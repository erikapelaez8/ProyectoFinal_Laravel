<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\WelcomeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


//Ruta para probar la conexión de la base de datos
Route::get(
    '/testDB',
    [\App\Http\Controllers\TestController::class, 'testDB']
);


//Ocultar la opción de register
Auth::routes(['register' => false]);

//Rutas de autenticación
Route::prefix('admin')->middleware(['auth'])->group(function () {
    //Ruta para la vista de usuarios
    Route::get('/users', [UserController::class, 'index'])->name('admin.users.index');
    Route::get('users/create', [UserController::class, 'create'])->name('admin.users.create');
    Route::post('users', [UserController::class, 'store'])->name('admin.users.store');
    Route::get('users/{user}', [UserController::class, 'show'])->name('admin.users.show');
    Route::get('users/{user}/edit', [UserController::class, 'edit'])->name('admin.users.edit');
    Route::put('users/{user}', [UserController::class, 'update'])->name('admin.users.update');
    Route::delete('users/{user}', [UserController::class, 'destroy'])->name('admin.users.destroy');
    //Ruta para la vista de categorias
    Route::get('/categories', [CategoryController::class, 'index'])->name('admin.categories.index');
    Route::get('categories/create', [CategoryController::class, 'create'])->name('admin.categories.create');
    Route::post('categories', [CategoryController::class, 'store'])->name('admin.categories.store');
    Route::get('categories/{id}/edit', [CategoryController::class, 'edit'])->name('admin.categories.edit');
    Route::delete('categories/{category}', [CategoryController::class, 'destroy'])->name('admin.categories.destroy');
    Route::put('categories/{category}', [CategoryController::class, 'update'])->name('admin.categories.update');
    //Ruta para la vista de productos
    Route::get('/products', [ProductController::class, 'index'])->name('admin.products.index');
    Route::get('products/create', [ProductController::class, 'create'])->name('admin.products.create');
    Route::post('products', [ProductController::class, 'store'])->name('admin.products.store');
    Route::get('products/{id}/edit', [ProductController::class, 'edit'])->name('admin.products.edit');
    Route::delete('products/{product}', [ProductController::class, 'destroy'])->name('admin.products.destroy');
    Route::put('products/{product}', [ProductController::class, 'update'])->name('admin.products.update');
});



//Ruta para la vista Welcome (vista del usuario final)
Route::get('/', [WelcomeController::class, 'index']);


//Ruta para usuarios autenticados
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


//Ruta para mostrar detalles de un producto
Route::get('products/{slug}', [ProductController::class, 'show'])->name('products.details');

