<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\API\BaseController as BaseController;
use App\Http\Requests\Api\Auth\RegisterFormRequest;
use App\User;

class RegisterController extends BaseController {

    public function __invoke(RegisterFormRequest $request) {
        $user = User::create(array_merge(
            $request->only('name', 'email'),
            ['password' => bcrypt($request->password)]
        ));

        $success['id']   = $user->user_id;
        $success['name'] = $user->name;

        return $this->sendResponse($success, 'User register');
    }
}
