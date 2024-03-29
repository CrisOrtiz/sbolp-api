<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;;

use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\Http\Controllers\Controller;
use Tymon\JWTAuth\Facades\JWTAuth;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $users = User::where('name', 'LIKE', '%' . $request->search . '%')
            ->orWhere('lastname', 'LIKE', '%' . $request->search . '%')
            ->orWhere('email', 'LIKE', '%' . $request->search . '%')
            ->orderBy($request->orderBy, $request->direction)
            ->with('notifications')
            ->paginate((int)$request->pageSize);

        return response()->json(compact(['users']), 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::findOrFail($id)->with('notifications');

        if (!$user) {
            return response()->json(['Usuario inexistente'], 400);
        }

        return response()->json(compact(['user']), 200);
    }

    public function updateUserData(Request $request)
    {
        $status = 'error';
        $message = '';

        $user = User::where('id', $request->id)->first();
        if ($user->email != $request->email) {
            if (count(User::where('email', $request->email)->get()) > 0) {
                $message = 'taken';
                return response()->json(compact('status', 'message'), 400);
            } else {
                $user->name = $request->name;
                $user->lastname = $request->lastname;
                $user->email = $request->email;
                $user->gender = $request->gender;
                $user->phone = $request->phone;
                $user->status = $request->status;
                $user->save();

                if ($user->save()) {
                    $status = 'success';
                    return response()->json(compact(['status']), 200);
                } else {
                    $message = 'user update data failed';
                    return response()->json(compact('status', 'message'), 401);
                }
            }
        } else {
            $user->name = $request->name;
            $user->lastname = $request->lastname;
            $user->gender = $request->gender;
            $user->phone = $request->phone;
            $user->status = $request->status;
            $user->save();

            if ($user->save()) {
                $status = 'success';
                $credentials = ['email' => $request->email, 'password' => $request->password];

                $token = auth()->attempt($credentials);
                auth()->login($user);

                return response()->json(compact(['status']), 200);
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

            return response()->json(compact(['token', 'status']), 200);
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

            return response()->json(compact([Auth::id(), 'status']), 200);
        } else {
            $message = 'user update role failed';
            return response()->json(compact('status', 'message'), 401);
        }
    }

    public function changeStatus(Request $request)
    {
        $status = 'update user status failed';

        $user = User::where('id', $request->id)->first();

        $user->status = !$user->status;

        if ($user->save()) {
            $status = 'success';
            return response()->json(compact(['user', 'status']), 200);
        } else {
            $message = 'user update status failed';
            return response()->json(compact('status', 'message'), 401);
        }
    }

    public function setEmailVerification(Request $request)
    {
        $status = 'Update user email verification';

        $user = User::where('id', $request->id)->first();
        $user->status = true;
        $user->email_verified_at = date('Y-m-d g:i:s');

        if ($user->save()) {
            $status = 'success';
           
            return response()->json(compact(['user', 'status']), 200);
        } else {
            $message = 'user update email_verified_at failed';
            return response()->json(compact('status', 'message'), 401);
        }
    }

    public function changeHasUnreadNotifications(Request $request)
    {
        $status = 'Change unread notifications failed';

        $user = User::where('id', $request->id)->first();
        if ($request->hasUnreadNotifications == false) {
            $user->hasUnreadNotifications = true;
        } elseif ($request->hasUnreadNotifications == true) {
            $user->hasUnreadNotifications = false;
        }
        $user->save();

        if ($user->save()) {
            $status = 'success';
            return response()->json(compact(['user', 'status']), 200);
        } else {
            $message = 'User update role failed';
            return response()->json(compact('status', 'message'), 401);
        }
    }
}
