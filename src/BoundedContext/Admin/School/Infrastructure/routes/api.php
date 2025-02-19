<?php

use Core\BoundedContext\Admin\School\Infrastructure\Controllers\{
    FindSchoolController, CreateSchoolController, ListSchoolController, DeleteSchoolController
};

Route::group(['prefix' => 'school', 'middleware' => ['jwt.verify']], function () {

    Route::get('list', ListSchoolController::class); //Lista de todas las escuelas
    Route::post('create', CreateSchoolController::class); //Crear o agregar una escuela
    Route::get('find/{id}', FindSchoolController::class); //Buscar escuela
    Route::delete('delete/{id}', DeleteSchoolController::class); //Eliminar escuela
});


