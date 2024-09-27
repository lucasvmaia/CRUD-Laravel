<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/usuarios', [App\Http\Controllers\ControllerUsuario::class, 'index'])->name('usuarios');
Route::get('/usuarios/novo', [App\Http\Controllers\ControllerUsuario::class, 'create'])->name('criarUsuario');
Route::post('/usuarios', [App\Http\Controllers\ControllerUsuario::class, 'store'])->name('storeUsuario');
Route::get('/usuarios/deletar/{id}', [App\Http\Controllers\ControllerUsuario::class, 'destroy'])->name('deletarUsuario');
Route::get('/usuarios/editar/{id}', [App\Http\Controllers\ControllerUsuario::class, 'edit'])->name('editarUsuario');
Route::post('/usuarios/{id}', [App\Http\Controllers\ControllerUsuario::class, 'update'])->name('updateUsuario');

Route::get('/afiliados', [App\Http\Controllers\ControllerAfiliado::class, 'index'])->name('afiliados');
Route::post('/afiliados', [App\Http\Controllers\ControllerAfiliado::class, 'store'])->name('storeAfiliados');
Route::get('/afiliados/deletar/{id}', [App\Http\Controllers\ControllerAfiliado::class, 'destroy'])->name('destroyAfiliados');
Route::get('/afiliados/editar/{id}', [App\Http\Controllers\ControllerAfiliado::class, 'edit'])->name('editAfiliados');
Route::post('/afiliados/{id}', [App\Http\Controllers\ControllerAfiliado::class, 'update'])->name('updateAfiliados');
// Route::get('/afiliados', [App\Http\Controllers\ControllerAfiliado::class, 'indexView'])->name('filiados'); 

Route::get('/comissoes', [App\Http\Controllers\ControllerComissao::class, 'index'])->name('comissoes');
Route::post('/comissoes', [App\Http\Controllers\ControllerComissao::class, 'store'])->name('storeComissoes');
Route::get('/comissoes/deletar/{id}', [App\Http\Controllers\ControllerComissao::class, 'destroy'])->name('destroyComissoes');
Route::get('/comissoes/editar/{id}', [App\Http\Controllers\ControllerComissao::class, 'edit'])->name('editComissoes');
Route::post('/comissoes/{id}', [App\Http\Controllers\ControllerComissao::class, 'update'])->name('updateComissoes');
// Route::get('/comissoes', [App\Http\Controllers\ControllerComissao::class, 'index'])->name('comissoes');

