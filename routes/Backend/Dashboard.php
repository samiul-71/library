<?php

/**
 * All route names are prefixed with 'admin.'.
 */
Route::get('dashboard', 'DashboardController@index')->name('dashboard');

Route::get('medicine-type/trash', 'MedicineTypeController@trash')->name('medicine-type.trash');
Route::patch('medicine-type/{id}/restore', 'MedicineTypeController@restore')->name('medicine-type.restore');
Route::delete('medicine-type/{id}/permanently-delete', 'MedicineTypeController@permanentlyDelete')->name('medicine-type.permanently-delete');

Route::resource('medicine-type', 'MedicineTypeController', ['names' => [
    'index'     => 'medicine-type.index',
    'create'    => 'medicine-type.create',
    'store'     => 'medicine-type.store',
    'show'      => 'medicine-type.show',
    'edit'      => 'medicine-type.edit',
    'update'    => 'medicine-type.update',
    'destroy'   => 'medicine-type.destroy'
]]);

/**
 * Routes for accessing indications info.
 */
Route::get('indications/trash', 'IndicationsController@trash')->name('indications.trash');
Route::patch('indications/{id}/restore', 'IndicationsController@restore')->name('indications.restore');
Route::delete('indications/{id}/permanently-delete', 'IndicationsController@permanentlyDelete')->name('indications.permanently-delete');

Route::resource('indications', 'IndicationsController', ['names' => [
    'index'     => 'indications.index',
    'create'    => 'indications.create',
    'store'     => 'indications.store',
    'show'      => 'indications.show',
    'edit'      => 'indications.edit',
    'update'    => 'indications.update',
    'destroy'   => 'indications.destroy'
]]);
