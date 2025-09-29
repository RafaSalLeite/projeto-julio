<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FornecedorController;

Route::get('/',[HomeController::class,'index']);
Route::get('/home',[HomeController::class,'index']);
Route::get('/produto/listar',[ProdutoController::class,'listar']);
Route::get('/produto/cadastrar',[ProdutoController::class,'cadastrar']);
Route::post('/produto/salvar',[ProdutoController::class,'salvar']);
Route::get('/produto/editar/{id}',[ProdutoController::class,'editar']);
Route::post('/produto/atualizar',[ProdutoController::class,'atualizar']);
Route::get('/produto/confirmaExcluir/{id}/{nome}', function($id, $nome){
    return view('produto.confirmaExcluir', ['id' => $id, 'nome' => $nome]);
});
Route::delete('/produto/excluir/{id}',[ProdutoController::class,'excluir']);

Route::get('/user',[UserController::class,'index']);
Route::post('/user/salvarnovo',[UserController::class,'salvarnovo']);
Route::post('/user/salvarEditado', [UserController::class, 'salvarEditado']);
Route::post('/user/atualizarSenha', [UserController::class, 'atualizarSenha']);
Route::post('/user/excluir', [UserController::class, 'excluir']);

Route::get('/date', function () {
    return date("d/m/Y h:i:sa");
});

Route::get('/phpinfo', function () {
    return phpinfo();
});
Route::resource('fornecedores', FornecedorController::class);
Route::get('/fornecedor', [FornecedorController::class, 'index'])->name('fornecedor.index');
Route::post('/fornecedor/salvar', [FornecedorController::class, 'salvar'])->name('fornecedor.salvar');
Route::post('/fornecedor/salvarEditado', [FornecedorController::class, 'salvarEditado'])->name('fornecedor.salvarEditado');
Route::post('/fornecedor/excluir', [FornecedorController::class, 'excluir'])->name('fornecedor.excluir');
Route::post('/fornecedor/confirmaExcluir', [FornecedorController::class, 'confirmaExcluir'])->name('fornecedor.confirmaExcluir');
