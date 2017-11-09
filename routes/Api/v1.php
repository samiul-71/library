<?php

Route::group(['namespace' => 'V1'], function () {

    Route::group([/*'middleware' => 'auth.basic.once'*/], function () {

        Route::resource('allergy-list', 'AllergyApiController', [
            'only' => [
                'index',
                'show'
            ]
        ]);
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