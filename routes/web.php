<?php

use App\Http\Controllers\CasosPruebaController;
use App\Http\Controllers\RequerimientoAnalistaCalidadController;
use App\Http\Controllers\ProyectoController;
use App\Http\Controllers\RequerimientoFechaTentativaController;
use App\Http\Controllers\RequerimientoController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

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


Auth::routes();

Route::middleware(['auth'])->group(function () {
    Route::get('/', [HomeController::class, 'index']);
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::resource('user', UserController::class, [
        'names' => 'users'
    ]);
    //Proyectos
    Route::resource('projects', ProyectoController::class);

    //Requerimientos
    Route::get('projects/{project}/requirement', [RequerimientoController::class, 'index'])->name('projects.requerimiento');
    Route::get('requeriments/{project}/create', [RequerimientoController::class, 'create'])->name('requirements.create');
    Route::post('requeriments/{project}/store', [RequerimientoController::class, 'store'])->name('requirements.store');
    Route::get('requeriments/{project}/{requirement}/edit', [RequerimientoController::class, 'edit'])->name('requirements.edit');
    Route::patch('requeriments/{project}/{requirement}/update', [RequerimientoController::class, 'update'])->name('requirements.update');
    Route::delete('requeriments/{project}/{requirement}/destroy', [RequerimientoController::class, 'destroy'])->name('requirements.destroy');
    Route::get('requerimiento/{project}/{requirement}/detail', [RequerimientoController::class, 'detail'])->name('requeriments.detail');

    //historial de analistas
    Route::get('/requirements_analistas/{project}/{requirement}', [RequerimientoAnalistaCalidadController::class, 'analistas'])->name('requirements.analista');
    Route::post('/requirements_analistas/{project}/{requirement}', [RequerimientoAnalistaCalidadController::class, 'save_change'])->name('requirements.save_analista');
    Route::get('/requirements_fecha_tentativa/{project}/{requirement}', [RequerimientoFechaTentativaController::class, 'index'])->name('requirements.fecha_tentativa');
    Route::post('/requirements_fecha_tentativa/{project}/{requirement}', [RequerimientoFechaTentativaController::class, 'save_date'])->name('requirements.save_date');

    //casos de prueba
    Route::get('/casos_de_prueba/{project}/{requirement}', [CasosPruebaController::class, 'index'])->name('casos_prueba.index');
    Route::get('/casos_de_prueba/{project}/{requirement}/create', [CasosPruebaController::class, 'create'])->name('casos_prueba.create');
    Route::post('/casos_de_prueba/{project}/{requirement}/store', [CasosPruebaController::class, 'store'])->name('casos_prueba.store');
    Route::get('/casos_de_prueba/{project}/{requirement}/{caso_prueba}/edit', [CasosPruebaController::class, 'edit'])->name('casos_prueba.edit');
    Route::patch('/casos_de_prueba/{project}/{requirement}/{caso_prueba}/update', [CasosPruebaController::class, 'update'])->name('casos_prueba.update');
    Route::delete('requeriments/{project}/{requirement}/{caso_prueba}/destroy', [CasosPruebaController::class, 'destroy'])->name('casos_prueba.destroy');
});