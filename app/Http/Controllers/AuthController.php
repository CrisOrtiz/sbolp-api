<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;;

use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\Http\Controllers\Controller;
use Tymon\JWTAuth\Facades\JWTAuth;


class AuthController extends Controller
{

    public function login(Request $request)
    {
        $credentials = ['email' => $request->email, 'password' => $request->password];

        $user = User::where('email', $request->email)->first();

        try {
            if (!$token = auth()->attempt($credentials)) {
                return response()->json(['error' => 'credenciales invalidas', 'request-email' => $request->email, 'request-password' => $request->password, 'token' => $token], 400);
            }
        } catch (JWTException $e) {
            return response()->json(['error' => 'could_not_create_token'], 500);
        }

        auth()->login($user);

        return response()->json([Auth::id(), 'login succesful', compact('token')]);
    }

    public function register(Request $request)
    {
        $status = 'error';
        $message = '';

        if (count(User::where('email', $request->email)->get()) > 0) {
            $message = 'taken';
            return response()->json(compact('status', 'message'), 400);
        } else {
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->role = $request->role;
            $user->password = Hash::make($request->password);
            $user->save();

            if ($user->save()) {
                $status = 'success';
                $credentials = ['email' => $request->email, 'password' => $request->password];

                $token = auth()->attempt($credentials);
                auth()->login($user);

                return response()->json([Auth::id(), 'register succesful', compact('token')]);
            } else {
                $message = 'register error';
                return response()->json(compact('status', 'message'), 401);
            }
        }
    }


    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out'], 200);
    }

    public function updateUser(Request $request)
    {
        $status = 'update user failed';

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:6|confirmed',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors()->toJson(), 400);
        }

        $user = User::where('id', $request->id)->first();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();

        if ($user->save()) {
            $status = 'update user success';
        }

        $token = JWTAuth::fromUser($user);

        return response()->json(compact('status', 'user', 'token'), 201);
    }

    public function changeRole(Request $request)
    {
        $status = 'update user failed';

        $validator = Validator::make($request->all(), [
            'role' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors()->toJson(), 400);
        }

        $user = User::where('id', $request->id)->first();
        $user->role = $request->role;
        $user->save();

        if ($user->save()) {
            $status = 'update user role success';
        }

        $token = JWTAuth::fromUser($user);

        return response()->json(compact('status', 'user', 'token'), 201);
    }

    public function getAuthenticatedUser()
    {
        try {
            if (!$user = JWTAuth::parseToken()->authenticate()) {
                return response()->json(['user_not_found'], 404);
            }
        } catch (TokenExpiredException $e) {

            return response()->json(['token_expired'], 400);
        } catch (TokenInvalidException $e) {

            return response()->json(['token_invalid'], 401);
        } catch (JWTException $e) {

            return response()->json(['token_absent'], 400);
        }

        return response()->json(compact('user'));
    }

    public function refreshToken()
    {
        JWTAuth::setToken(JWTAuth::refresh());
        $user = JWTAuth::authenticate();
        return response()->json(compact($user));
    }
}
