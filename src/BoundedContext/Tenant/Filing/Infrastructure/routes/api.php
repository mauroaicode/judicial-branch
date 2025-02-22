<?php

use Illuminate\Support\Facades\Route;
use Core\BoundedContext\Tenant\Filing\Infrastructure\Controllers\{
    ListFilingController
};


Route::group(['prefix' => 'filings', 'middleware' => ['jwt.verify']], function () {

    Route::get('list', ListFilingController::class); //Lista de todos los radicados
});
