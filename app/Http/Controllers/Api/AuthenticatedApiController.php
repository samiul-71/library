<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Access\User\User;
use Illuminate\Http\Response as IlluminateResponse;
use Illuminate\Pagination\Paginator;

/**
 * Description of ApiController
 *
 * @author nasirkhan
 */
class AuthenticatedApiController extends ApiController
{
    public function getAuthenticatedUser()
    {
        // first check if the user is authenticated or not
        $userId =   \Auth::guard('api')->user()->id;

        $user = User::find($userId);

        if( ! $user instanceof User) {
            $this->setStatusCode(204);
            throw new \Exception('Sorry, this user is not found in database');
        }

        return $user;
    }
}
