<?php

use Core\BoundedContext\Tenant\Vehicle\Infrastructure\Controllers\{
    ListVehicleController
};


Route::group(['prefix' => 'vehicle', 'middleware' => ['jwt.verify']], function () {

    Route::get('list', ListVehicleController::class); //Lista de todos los vehiculos
});
