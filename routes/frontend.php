<?php

use Astrogoat\Locations\Http\Controllers\LocationsController;
use Illuminate\Support\Facades\Route;

Route::group([
    'as' => 'locations.',
    'prefix' => 'locations',
    'middleware' => ['enabled:Astrogoat\Locations\Settings\LocationsSettings']
], function () {
    Route::get('{location:slug}', [LocationsController::class, 'show'])->name('show');
});
