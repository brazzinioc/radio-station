<?php

namespace App\Http\Controllers;

use Illuminate\Http\{Request, Response};
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Http\Requests\{ LoginRequest, RegisterRequest };
use App\Http\Resources\UserRegisterResource;

class AuthController extends Controller
{
    /**
     * Login user and create tokens
     *
     * @param  \Illuminate\Http\LoginRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function login(LoginRequest $request)
    {

        $request->validated();

        // Get User where email is equal to the email in the request, email verified and User is active.
        $user = User::where('email', $request->email)
                    ->where('email_verified_at', '!=', null)
                    ->where('deleted_at', null)
                    ->first();

        if( isset($user) && Auth::attempt( [ 'email' => $user->email, 'password' => $request->password ] ) ){
            return response()->json([
                'token' => $request->user()->createToken($request->name)->plainTextToken,
                'message' => 'success'
            ], Response::HTTP_OK);
        }

        // Login failed
        return response()->json([
            'message' => 'unauthorized'
        ], Response::HTTP_UNAUTHORIZED);
    }


    /**
     * Register a User
     *
     * @param  \Illuminate\Http\RegisterRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function register(RegisterRequest $request)
    {
        $request->validated();

        $user = User::create([
            'name' => $request->name,
            'last_name' => $request->lastName,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);

        // Assign Default Role.
        $user->assignRole('Listener');

        return new UserRegisterResource($user);
    }
}
