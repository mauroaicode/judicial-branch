<?php

use Core\BoundedContext\Admin\Customer\Infrastructure\Controllers\{
    FindCustomerController, CreateCustomerController, ListCustomerController, DeleteCustomerController
};
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'customer', 'middleware' => ['jwt.verify']], function () {

    Route::get('list', ListCustomerController::class); //Lista de todas las escuelas
    Route::post('create', CreateCustomerController::class); //Crear o agregar una escuela
    Route::get('find/{id}', FindCustomerController::class); //Buscar escuela
    Route::delete('delete/{id}', DeleteCustomerController::class); //Eliminar escuela
});


