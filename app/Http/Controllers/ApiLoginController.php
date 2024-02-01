<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Resources\LoginResponse;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ApiLoginController extends Controller
{
    public function login(LoginRequest $request)
    {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $this->action = "dashboard";
            return $this->loginResponse();
        }
        if ($user = User::where('email', '=', $request->email)->first()) {
            if (Hash::check($request->password, $user->temporary_password)) {
                Auth::login($user);
                $this->action = "temporary_password";
                return $this->loginResponse();
            }
        }
        return $this->errorResponse('Your email or password is wrong');
    }

    public function loginResponse()
    {
        $expiry = request()->remember_token
            ? config('sanctum.expiration')
            : Carbon::now()->addMinutes(60 * 24);

        $user = Auth::user();
        $user->token = Auth::user()->createToken(request()->ip . ' ' . request()->getUserInfo(), expiresAt: $expiry)->plainTextToken;
        $user->action = $this->action;

        return $this->successResponse('Login Successfully', new LoginResponse($user));
    }

    public function logout()
    {
    
        Auth::guard('sanctum')->user()->currentAccessToken()->delete();

        return $this->successResponse('You have been logged out from current session.');
    }
}
