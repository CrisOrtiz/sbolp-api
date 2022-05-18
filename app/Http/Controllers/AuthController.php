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
        $status = 'error';
        $credentials = ['email' => $request->email, 'password' => $request->password];

        $user = User::where('email', $request->email)->first();
        
        if(!$user){
            return response()->json(['error' => 'Email no encontrado'], 401);
        }
        
        if($user->status == false){
            return response()->json(['error' => 'Usuario inactivo, contactese con un administrador.'], 401);
        }

        try {
            if (!$token = auth()->attempt($credentials)) {
                return response()->json(['error' => 'Revise sus credenciales', 'request-email' => $request->email, 'request-password' => $request->password, 'token' => $token], 400);
            }
        } catch (JWTException $e) {
            return response()->json(['error' => 'Error en el servidor'], 500);
        }

        auth()->login($user);
        $status = 'success';

        return response()->json(compact(['token', 'status']),200);
    }

    public function test()
    {
        $status = 'success';
        return response()->json(compact(['status']),200);
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
            $user->lastname = $request->lastname;
            $user->email = $request->email;
            $user->role = $request->role;
            $user->password = Hash::make($request->password);
            $user->status = true;
            $user->image_name = 'default-user.jpg';
            $user->save();

            if ($user->save()) {
                $status = 'success';
                $credentials = ['email' => $request->email, 'password' => $request->password];

                $token = auth()->attempt($credentials);
                auth()->login($user);

                return response()->json(compact(['token', 'status']));
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

    

    public function getAuthenticatedUser()
    {
        $status = 'failed';
        $message = '';
        try {
            if (!$user = JWTAuth::parseToken()->authenticate()) {
                $message = 'user_not_found';
                return response()->json(compact('message','status'), 404);
            }
        } catch (TokenExpiredException $e) {
            $message = 'token_expired';
            return response()->json(compact('message','status'), 400);
        } catch (TokenInvalidException $e) {
            $message = 'token_invalid';
            return response()->json(compact('message','status'), 401);
        } catch (JWTException $e) {
            $message = 'token_absent';
            return response()->json(compact('message','status'), 400);
        }
        $status = 'success';
        return response()->json(compact('user','status'));
    }

    public function refreshToken()
    {
        JWTAuth::setToken(JWTAuth::refresh());
        $user = JWTAuth::authenticate();
        return response()->json(compact($user));
    }
}
