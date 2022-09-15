<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Carbon\Carbon;
use App\Models\User;
use App\Mail\SendResetPasswordMail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Symfony\Component\HttpFoundation\Response;

class ResetPasswordRequestController extends Controller
{
    public function requestForgotPassword(Request $request)
    {
        if (!$this->validEmail($request->email)) {
            return response()->json([
                'message' => 'Email not found.'
            ], Response::HTTP_NOT_FOUND);
        } else {
            if ($this->expireValidation($request->email)) {
                return response()->json([
                    'error' => 'Ya existe solicitud activa, revise su correo.'
                ], Response::HTTP_UNPROCESSABLE_ENTITY);
            }
            $this->sendEmail($request->email);
            return response()->json([
                'message' => 'Se envio un correo de restauración de contraseña.'
            ], Response::HTTP_OK);
        }
    }

    public function expireValidation($email)
    {
        return !!DB::table('password_resets')->where('email', $email)->where(
            'created_at',
            '>=',
            Carbon::now()->subMinutes(30)->toDateTimeString()
        )->first();
    }

    public function sendEmail($email)
    {
        $token = $this->createToken($email);
        Mail::to($email)->send(new SendResetPasswordMail($token, $email));
    }

    public function validEmail($email)
    {
        return !!User::where('email', $email)->first();
    }

    public function createToken($email)
    {
        $isToken = DB::table('password_resets')->where('email', $email)->first();

        if ($isToken) {
            DB::table('password_resets')->where('email', $email)->delete();
        }

        $token = Str::random(80);;
        $this->saveToken($token, $email);
        return $token;
    }

    public function saveToken($token, $email)
    {
        DB::table('password_resets')->insert([
            'email' => $email,
            'token' => $token,
            'created_at' => Carbon::now()
        ]);
    }
}
