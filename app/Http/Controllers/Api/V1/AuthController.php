<?php

namespace App\Http\Controllers\Api\V1;

use App\Api\Transformers\V1\UserTransformer;
use App\Events\Frontend\Auth\UserLoggedIn;
use App\Events\Frontend\Auth\UserRegistered;
use App\Http\Controllers\Api\AuthenticatedApiController;
use App\Models\Access\User\User;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;
use DB;
use Validator;

class AuthController extends AuthenticatedApiController
{
    use SendsPasswordResetEmails;
    protected $user;
    protected $userTransformer;

    /**
     * @param User $user
     * @param UserTransformer $userTransformer
     */
    public function __construct(User $user, UserTransformer $userTransformer)
    {
        $this->user = $user;
        $this->userTransformer = $userTransformer;
    }

    public function register(Request $request)
    {
        $data = [];

        try {

            if (!$request->has('email') || !$request->has('password')) {
                throw new \Exception('You need to provide at least the essential credentials');
            }

            $validate = Validator::make($request->all(), [
                'email' => 'required|unique:users'
            ]);

            if ($validate->fails()) {
                throw new \Exception('You need to provide unique email address');
            }


            $user = new $this->user;

            $user->name = ($request->has('name')) ? trim($request->input('name')) : '';
            $user->email = trim($request->input('email'));
            $user->password = bcrypt($request->input('password'));
            $user->confirmation_code = md5(uniqid(mt_rand(), true));
            $user->status = 1;
            $user->confirmed = 1;
            $user->save();

            event(new UserRegistered($user));

            $data['user'] = $this->userTransformer->transform($user);
            $data['registration_status'] = true;
            $data['status_code'] = '200';
            $data['status'] = 'success';

        } catch (\Exception $exception) {
            $data['user'] = new \stdClass();
            $data['registration_status'] = false;
            $data['status_code'] = '400';
            $data['status'] = $exception->getMessage();

        } finally {
            return response()->json($data);
        }
    }

    public function signIn(Request $request)
    {
        $data = [];

        try {

            if ($request->has('email') && $request->has('password')) {
                $input['email'] = trim($request->input('email'));
                $field = 'email';
            } else {
                throw new \Exception('Email ID is required.');
            }

            $userCredentials = [$field => $input[$field], 'password' => $request->input('password')];

            if (auth()->attempt($userCredentials, $request->has('remember'))) {


                event(new UserLoggedIn(access()->user()));

                $data['user'] = $this->userTransformer->transform(access()->user());
                $data['login_status'] = true;
                $data['status_code'] = '200';
                $data['status'] = 'success';

            } else {
                $data['user'] = new \stdClass();
                $data['login_status'] = false;
                $data['status_code'] = '400';
                $data['status'] = 'Credential not matched';
            }

        } catch (\Exception $exception) {

            $data['user'] = new \stdClass();
            $data['login_status'] = false;
            $data['status_code'] = '400';
            $data['status'] = $exception->getMessage();

        } finally {
            return response()->json($data);
        }
    }
}
