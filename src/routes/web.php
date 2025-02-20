<?php

use Itpathsolutions\Sessionmanager\Http\Controllers\SessionManagerController;
use Illuminate\Support\Facades\Route;
Route::group(['middleware' => ['web', 'auth']], function () {
    Route::get('/session-manager-info', [SessionManagerController::class, 'index']);
    Route::post('/sessionmanager/update-session', [SessionManagerController::class, 'updateSession'])
        ->name('sessionmanager.updateSession');
});
