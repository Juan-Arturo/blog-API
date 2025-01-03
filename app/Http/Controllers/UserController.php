<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Exceptions\JWTException;

class UserController extends Controller
{
    public function authenticate(Request $request)
    {
       $credentials = $request->only('email', 'password');

       try {
         if (!$token = JWTAuth::attempt($credentials)) {
           return response()->json(['error' => 'Invalid_credentials'], 400);
         }
       } catch (JWTException $e) {
         return response()->json(['error' => 'could_not_create_token'], 500);
       }
       return response()->json(compact('token'));
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->toJson()], 400);
        }

        $user = User::create([
                'name' => $request->get('name'),
                'email' => $request->get('email'),
                'password' => Hash::make($request->get('password')),
            ]);

        $token = JWTAuth::fromUser($user);

        return response()->json(compact('user', 'token'), 201);
    }

    public function getAuthenticatedUser()
    {
        try {
          if (!$user = JWTAuth::parseToken()->authenticate()) {
            return response()->json(['error' => 'user_not_found'], 404);
          }
        } catch (TokenExpiredException $e) {
          return response()->json(['error' => 'token_expired'], 401);
        } catch (TokenInvalidException $e) {
          return response()->json(['error' => 'token_invalid'],401);
        } catch (JWTException $e) {
          return response()->json(['error' => 'token_absent'], 500);
        }
        return response()->json(compact('user'));
  }
}