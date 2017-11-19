<?php

namespace App\Api\Transformers\V1;

use App\Api\Transformers\Transformer;

class UserTransformer extends Transformer
{
    /**
     * @property string image_uploaded_path
     */
    protected $image_uploaded_path;

    public function __construct()
    {
        //
    }

    public function transform($user) {
        return [
            'user_id'               => $user->id,
            'access_token'          => $user->api_token,
            'name'                  => trim($user->name),
            'email'                 => $user->email,
            'mobile'                => $user->mobile,
//            'username'              => $user->username,
        ];
    }
}
