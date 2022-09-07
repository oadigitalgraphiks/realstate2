<?php

namespace App\Http\Controllers\Api\V2;

use App\Notifications\AppEmailVerificationNotification;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\PasswordReset;
use App\Notifications\PasswordResetRequest;
use Illuminate\Support\Str;
use App\Http\Controllers\OTPVerificationController;
use Validator;
use Hash;

class PasswordResetController extends Controller
{
    public function forgetRequest(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'send_code_by' => 'required',
            'email_or_phone' => 'required',
         ]);

         if($validator->fails()){
            return response()->json([
             'message' => 'Failed',
             'errors' => $validator->messages(),
            ],401);
         } 

        if ($request->send_code_by == 'email') {
            $user = User::where('email', $request->email_or_phone)->first();
        } else {
            $user = User::where('phone', $request->email_or_phone)->first();
        }

        if (!$user) {
            return response()->json([
                'result' => false,
                'message' => translate('User is not found')], 404);
        }

        if ($user) {
            $user->verification_code = rand(100000, 999999);
            $user->save();
            if ($request->send_code_by == 'phone') {
                $otpController = new OTPVerificationController();
                $otpController->send_code($user);
            } else {
                $user->notify(new AppEmailVerificationNotification());
            }
        }

        return response()->json([
            'result' => true,
            'message' => translate('A code is sent')
        ], 200);
    }


    public function confirmReset(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'verification_code' => 'required',
            'password' => 'required|min:6|required_with:password_confirmation|same:password_confirmation',
            'password_confirmation' => 'required|min:6',
         ]);

         if($validator->fails()){
            return response()->json([
             'message' => 'Failed',
             'errors' => $validator->messages(),
            ],401);
         } 

         //Validation
        $user = User::where('verification_code', $request->verification_code)->first();
        if ($user != null) {

            $user->verification_code = null;
            $user->password = Hash::make($request->password);
            $user->save();
            return response()->json([
                'result' => true,
                'message' => translate('Your password is reset. Please login'),
            ], 200);

        } else {
            return response()->json([
                'result' => false,
                'message' => translate('No user is found'),
            ], 200);
        }
    }


    public function resendCode(Request $request)
    {

        $validator = Validator::make($request->all(),[
            'verify_by' => 'required',
            'email_or_phone' => 'required',
         ]);

         if($validator->fails()){
            return response()->json([
             'message' => 'Failed',
             'errors' => $validator->messages(),
            ],401);
         }

        //  Validation
        if ($request->verify_by == 'email') {
            $user = User::where('email', $request->email_or_phone)->first();
        } else {
            $user = User::where('phone', $request->email_or_phone)->first();
        }

        if (!$user) {
            return response()->json([
                'result' => false,
                'message' => translate('User is not found')], 404);
        }

        $user->verification_code = rand(100000, 999999);
        $user->save();

        if ($request->verify_by == 'email') {
            $user->notify(new AppEmailVerificationNotification());
        } else {
            $otpController = new OTPVerificationController();
            $otpController->send_code($user);
        }



        return response()->json([
            'result' => true,
            'message' => translate('A code is sent again'),
        ], 200);
    }
}
