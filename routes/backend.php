<?php

use Astrogoat\Locations\Http\Livewire\Models\LocationForm;
use Illuminate\Support\Facades\Route;

Route::group([
    'as' => 'locations.',
    'prefix' => 'locations'
], function () {
    Route::get('/', [\Astrogoat\Locations\Http\Controllers\LocationsController::class, 'index'])->name('index');
    Route::get('/create', LocationForm::class)->name('create');
    Route::get('/{location}/edit', LocationForm::class)->name('edit');
    Route::get('/{location}/editor/{editor_view?}', [\Astrogoat\Locations\Http\Controllers\LocationsController::class, 'editor'])->name('editor');
});
