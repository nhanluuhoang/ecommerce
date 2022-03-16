<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\Auth\LoginRequest;

class AuthController extends ApiBaseController
{
    /**
     * Login api
     *
     * @param LoginRequest $request
     * @return \Illuminate\Http\JsonResponse|object
     */
    public function login(LoginRequest $request) {
        $cred = $request->validated();

        if (! $token = auth()->attempt($cred)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->httpResponse([
            'access_token'   => $token
        ]);
    }

    /**
     * API info user
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me() {
        $user = auth()->user();
        return $this->httpOK($user);
    }

    /**
     * API logout
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout() {
        auth()->logout();

        return $this->httpResponse([
            'message' => 'Successfully logged out'
        ]);
    }
}
