<?php

use App\Http\Controllers\PessoaController;
use App\Http\Controllers\UsuarioController;
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
    return redirect()->route("loginPage");
});
Route::get("/login", [UsuarioController::class, "loginPage"])->name("loginPage");
Route::post("/login", [UsuarioController::class, "login"])->name("login");
Route::get("/cadastro", [UsuarioController::class, "registerPage"])->name("registerPage");
Route::post("/cadastro", [UsuarioController::class, "register"])->name("register");
Route::get("/logout", [UsuarioController::class, "logout"])->name("logout");

Route::middleware(['auth'])->group(function () {
    Route::prefix("admin")->group(function(){
        Route::prefix("pessoas")->group(function(){
            Route::get("/listar", [PessoaController::class,"index"])->name("list_pessoa");
            Route::post("/store", [PessoaController::class,"store"])->name("store_pessoa");
            Route::post("/update", [PessoaController::class,"update"])->name("update_pessoa");
            Route::get("/destroy/{id}", [PessoaController::class,"destroy"])->name("destroy_pessoa");
        });
    });
});
