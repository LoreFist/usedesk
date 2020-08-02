<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Http\Request;

class LogoutController extends BaseController {

    public function __invoke(Request $request) {
        $request->user()->token()->revoke();

        return $this->sendResponse([], 'You are successfully logged out');
    }
}
