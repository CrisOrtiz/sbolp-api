<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\RequestHelper;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;


class UpdatePasswordController extends Controller
{
    public function resetPassword(RequestHelper $request)
    {
        return $this->validateToken($request)->count() > 0 ? $this->changePassword($request) : $this->noToken($request);
    }

    private function validateToken($request)
    {
        return DB::table('password_resets')->where([
            'email' => $request->email,
            'token' => $request->passwordToken,
        ])->where(
            'created_at',
            '>=',
            Carbon::now()->subHours(1)->toDateTimeString()
        );
    }

    /**
     * Check if token is valid 
     *
     * @return \Illuminate\Http\Response
     */
    public function isValidToken(Request $request)
    {
        $status = 'invalid';
        if ($this->validateToken($request)->count() > 0) {
            $status = 'valid';
            return response()->json(compact('status'), Response::HTTP_OK);
        } else {
            DB::table('password_resets')->where([
                'email' => $request->email,
                'token' => $request->passwordToken,
            ])->delete();
            return response()->json(compact('status'), Response::HTTP_UNPROCESSABLE_ENTITY);
        }
    }

    private function noToken($request)
    {
        DB::table('password_resets')->where([
            'email' => $request->email,
            'token' => $request->passwordToken,
        ])->delete();
        $status = 'invalid';
        $message = 'Email o token invalidos.';
        return response()->json(compact('status', 'message'), Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    private function changePassword($request)
    {
        $status = 'failed';
        $user = User::whereEmail($request->email)->first();
        $user->password = Hash::make($request->password);
        $user->save();

        if ($user->save()) {
            $status = 'success';
            $this->validateToken($request)->delete();
            return response()->json(compact(['status']), Response::HTTP_OK);
        } else {
            $message = 'user update password failed';
            return response()->json(compact('status', 'message'), Response::HTTP_BAD_REQUEST);
        }
    }
}
