<?php

use Illuminate\Support\Facades\Route;

Route::group([
    'as' => 'locations.',
    'prefix' => 'locations'
], function () {
    Route::get('/', [\Astrogoat\Locations\Http\Controllers\LocationsController::class, 'index'])->name('index');
    Route::get('/create', [\Astrogoat\Locations\Http\Controllers\LocationsController::class, 'create'])->name('create');
    Route::get('/{location}/edit', [\Astrogoat\Locations\Http\Controllers\LocationsController::class, 'edit'])->name('edit');
    Route::get('/{location}/editor/{editor_view?}', [\Astrogoat\Locations\Http\Controllers\LocationsController::class, 'editor'])->name('editor');
});
