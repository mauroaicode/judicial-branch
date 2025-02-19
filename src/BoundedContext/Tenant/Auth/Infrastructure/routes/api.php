<?php

use Core\BoundedContext\Tenant\Auth\Infrastructure\Controllers\{LoginPostController, LogoutPostController};

Route::group(['middleware' => 'api'], function () {
    Route::post('login', LoginPostController::class);

});
Route::group(['middleware' => ['jwt.verify']], function () {
    Route::post('logout', LogoutPostController::class);
});
