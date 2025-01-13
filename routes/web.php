<?php

use App\Http\Controllers\PetStoreController;
use Illuminate\Support\Facades\Route;

Route::controller(PetStoreController::class)->group(function () {
    Route::get('/', 'getPetsByStatus')->name('pets.index');
    Route::get('/add', 'renderAddPet')->name('pets.add');
    Route::post('/', 'addPet')->name('pets.store');
    Route::get('/{id}', 'getPet')->name('pets.show');
    Route::get('/{id}/edit', 'renderEditPet')->name('pets.edit');
    Route::put('/{id}', 'updatePet')->name('pets.update');
    Route::delete('/{id}', 'deletePet')->name('pets.destroy');
});
