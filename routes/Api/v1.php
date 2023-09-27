<?php

Route::group(['namespace' => 'V1'], function () {

    Route::group([/*'middleware' => 'auth.basic.once'*/], function () {

        /* 01. Start of Allergy API */
        Route::resource('allergy-list', 'AllergyApiController', [
            'only' => [
                'index',
                'show'
            ]
        ]);
        /* End of Allergy API */

        /* 02. Start of Medicine API */
        Route::resource('medicine-list', 'MedicineApiController', [
            'only' => [
                'index',
                'show'
            ]
        ]);
        /* End of Medicine API */

        /* 03. Start of Lab test API */
        Route::resource('lab-test', 'LabTestApiController', [
            'only' => [
                'index',
                'show'
            ]
        ]);
        /* End of Medicine API */


        /* 04. Start of Disease API */
        Route::resource('disease', 'DiseasesApiController', [
            'only' => [
                'index',
                'show'
            ]
        ]);
        /* End of Disease API */

        /* 05. Start of chronic disease API */
        Route::resource('chronic-disease', 'ChronicDiseaseApiController', [
            'only' => [
                'index',
                'show'
            ]
        ]);
        /* End of Disease API */
    });

    /* 14. Start of Authentication API */
    Route::post('auth/register', 'AuthController@register');
    Route::post('auth/signin', 'AuthController@signIn');
    /* End of Authentication API */

    /* Start of Secured API */

    Route::group(['middleware' => 'auth:api'], function () {
        //
    });
    /* End of Secured API */
});
