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

        try {
            if (!$token = auth()->attempt($credentials)) {
                return response()->json(['error' => 'credenciales invalidas', 'request-email' => $request->email, 'request-password' => $request->password, 'token' => $token], 400);
            }
        } catch (JWTException $e) {
            return response()->json(['error' => 'could_not_create_token'], 500);
        }

        auth()->login($user);
        $status = 'success';

        return response()->json(compact([Auth::id(),'token', 'status']));
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
            $user->image_name = 'default-user.jpg';
            $user->save();

            if ($user->save()) {
                $status = 'success';
                $credentials = ['email' => $request->email, 'password' => $request->password];

                $token = auth()->attempt($credentials);
                auth()->login($user);

                return response()->json(compact([Auth::id(),'token', 'status']));
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

    public function updateUserData(Request $request)
    {
        $status = 'error';
        $message = '';

        $user = User::where('id', $request->id)->first();
        if($user->email != $request->email){
            if (count(User::where('email', $request->email)->get()) > 0) {
                $message = 'taken';
                return response()->json(compact('status', 'message'), 400);
            } else {
                $user->name = $request->name;
                $user->lastname = $request->lastname;
                $user->email = $request->email;               
                $user->save();

                if ($user->save()) {
                    $status = 'success';                

                    return response()->json(compact([Auth::id(), 'status']));
                } else {
                    $message = 'user update data failed';
                    return response()->json(compact('status', 'message'), 401);
                }
            }
        }else{
            $user->name = $request->name;
            $user->lastname = $request->lastname;            
            $user->save();

            if ($user->save()) {
                $status = 'success';
                $credentials = ['email' => $request->email, 'password' => $request->password];

                $token = auth()->attempt($credentials);
                auth()->login($user);

                return response()->json(compact([Auth::id(), 'status']));
            } else {
                $message = 'user update data failed';
                return response()->json(compact('status', 'message'), 401);
            }
        }
    }

    public function updateUserPassword(Request $request)
    {
        $status = 'failed';

        $user = User::where('id', $request->id)->first();
            $user->password = Hash::make($request->password);    
            $user->save();
         

        if ($user->save()) {
            $status = 'success';
            $credentials = ['email' => $user->email, 'password' => $request->password];

            $token = auth()->attempt($credentials);
            auth()->login($user);

            return response()->json(compact([Auth::id(), 'token', 'status']));
        } else {
            $message = 'user update password failed';
            return response()->json(compact('status', 'message'), 401);
        }

       
    }

    public function changeRole(Request $request)
    {
        $status = 'update user role failed';

        $user = User::where('id', $request->id)->first();
        $user->role = $request->role;
        $user->save();

        if ($user->save()) {
            $status = 'success';
    
            return response()->json(compact([Auth::id(), 'status']));
        } else {
            $message = 'user update role failed';
            return response()->json(compact('status', 'message'), 401);
        }
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
