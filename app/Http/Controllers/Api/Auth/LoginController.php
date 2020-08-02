<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\API\BaseController as BaseController;
use App\Logs;
use App\Services\LogService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends BaseController {

    /**
     * Handle the incoming request.
     *
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function __invoke(Request $request) {
        $credentials = $request->only('email', 'password');

        if ( !Auth::attempt($credentials)) {
            return $this->sendError('Unauthorised', 'You cannot sign with those credentials', 401);
        }

        $token = Auth::User()->createToken(config('app.name'));
        LogService::save(Logs::TYPE_LOGIN);
        return $this->sendResponse([
            'token' => $token->accessToken
        ], 'user signin');
    }
}
