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

Route::get('generic-name/trash', 'GenericNameController@trash')->name('generic-name.trash');
Route::patch('generic-name/{id}/restore', 'GenericNameController@restore')->name('generic-name.restore');
Route::delete('generic-name/{id}/permanently-delete', 'GenericNameController@permanentlyDelete')->name('generic-name.permanently-delete');

Route::resource('generic-name', 'GenericNameController', ['names' => [
    'index'     => 'generic-name.index',
    'create'    => 'generic-name.create',
    'store'     => 'generic-name.store',
    'show'      => 'generic-name.show',
    'edit'      => 'generic-name.edit',
    'update'    => 'generic-name.update',
    'destroy'   => 'generic-name.destroy'
]]);


Route::get('medicine/trash', 'MedicinesController@trash')->name('medicine.trash');
Route::patch('medicine/{id}/restore', 'MedicinesController@restore')->name('medicine.restore');
Route::delete('medicine/{id}/permanently-delete', 'MedicinesController@permanentlyDelete')->name('medicine.permanently-delete');

Route::resource('medicine', 'MedicinesController', ['names' => [
    'index'     => 'medicine.index',
    'create'    => 'medicine.create',
    'store'     => 'medicine.store',
    'show'      => 'medicine.show',
    'edit'      => 'medicine.edit',
    'update'    => 'medicine.update',
    'destroy'   => 'medicine.destroy'
]]);

/**
 * Routes for accessing/adding pharmaceutical info.
 */
Route::get('pharmaceutical-companies/trash', 'PharmaceuticalCompaniesController@trash')->name('pharmaceutical-companies.trash');
Route::patch('pharmaceutical-companies/{id}/restore', 'PharmaceuticalCompaniesController@restore')->name('pharmaceutical-companies.restore');
Route::delete('pharmaceutical-companies/{id}/permanently-delete', 'PharmaceuticalCompaniesController@permanentlyDelete')->name('pharmaceutical-companies.permanently-delete');

Route::resource('pharmaceutical-companies', 'PharmaceuticalCompaniesController', ['names' => [
    'index'     => 'pharmaceutical-companies.index',
    'create'    => 'pharmaceutical-companies.create',
    'store'     => 'pharmaceutical-companies.store',
    'show'      => 'pharmaceutical-companies.show',
    'edit'      => 'pharmaceutical-companies.edit',
    'update'    => 'pharmaceutical-companies.update',
    'destroy'   => 'pharmaceutical-companies.destroy'
]]);

/**
 * Routes for accessing/adding Lab Test info.
 */
Route::get('lab-test/trash', 'LabTestController@trash')->name('lab-test.trash');
Route::patch('lab-test/{id}/restore', 'LabTestController@restore')->name('lab-test.restore');
Route::delete('lab-test/{id}/permanently-delete', 'LabTestController@permanentlyDelete')->name('lab-test.permanently-delete');

Route::resource('lab-test', 'LabTestController', ['names' => [
    'index'     => 'lab-test.index',
    'create'    => 'lab-test.create',
    'store'     => 'lab-test.store',
    'show'      => 'lab-test.show',
    'edit'      => 'lab-test.edit',
    'update'    => 'lab-test.update',
    'destroy'   => 'lab-test.destroy'
]]);

/**
 * Routes for accessing/adding Allergies info.
 */
Route::get('allergies/trash', 'AllergiesController@trash')->name('allergies.trash');
Route::patch('allergies/{id}/restore', 'AllergiesController@restore')->name('allergies.restore');
Route::delete('allergies/{id}/permanently-delete', 'AllergiesController@permanentlyDelete')->name('allergies.permanently-delete');

Route::resource('allergies', 'AllergiesController', ['names' => [
    'index'     => 'allergies.index',
    'create'    => 'allergies.create',
    'store'     => 'allergies.store',
    'show'      => 'allergies.show',
    'edit'      => 'allergies.edit',
    'update'    => 'allergies.update',
    'destroy'   => 'allergies.destroy'
]]);

/**
 *  Routes for accessing/adding Therapeutic Class Group info.
 */
Route::get('therapeutic-class-group/trash', 'TherapeuticClassGroupController@trash')->name('therapeutic-class-group.trash');
Route::get('therapeutic-class-group/getChildren/{id}', 'TherapeuticClassGroupController@getChildren')->name('therapeutic-class-group.get-children');
Route::patch('therapeutic-class-group/{id}/restore', 'TherapeuticClassGroupController@restore')->name('therapeutic-class-group.restore');
Route::delete('therapeutic-class-group/{id}/permanently-delete', 'TherapeuticClassGroupController@permanentlyDelete')->name('therapeutic-class-group.permanently-delete');

Route::resource('therapeutic-class-group', 'TherapeuticClassGroupController', ['names' => [
    'index'     => 'therapeutic-class-group.index',
    'create'    => 'therapeutic-class-group.create',
    'store'     => 'therapeutic-class-group.store',
    'show'      => 'therapeutic-class-group.show',
    'edit'      => 'therapeutic-class-group.edit',
    'update'    => 'therapeutic-class-group.update',
    'destroy'   => 'therapeutic-class-group.destroy'
]]);
