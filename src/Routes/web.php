<?php

namespace Devnav2902\Utilitylog\Routes;

use Illuminate\Support\Facades\Route;

Route::namespace('Devnav2902\Utilitylog\Http\Controllers')->group(function () {
    Route::get('/view-log', 'UtilityLogController@index');
});