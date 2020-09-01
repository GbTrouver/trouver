<?php

namespace App\Http\Controllers\Admin;

use DB;
use Session;
use App\User;
use App\UserOtp;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Mail\API\Users\UsersOtpMail;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\Admin\AdminAuthRequest;

class AuthController extends Controller
{
    public function loginPost(AdminAuthRequest $request)
    {
        $valid = $request->validated();
        if (Auth::attempt([
                'email' => $valid['email'],
                'password' => $valid['password']
            ])) {
            $user = Auth::user();
            return redirect()->route('admin.dashboard')->with('success', $user->first_name.' '.$user->last_name.' Logged in successfully.');
        } else {
            return redirect()->back()->with('error', 'Please, check your credentials.');
        }
    }

    public function forgotPasswordRequest(AdminAuthRequest $request)
    {
        $valid = $request->validated();
        $email = $request->only('otp_email');
        $user = User::where('email', $email)->first('id');

        if(!empty($user))
        {
            try {
                $otp = rand(100001, 999999);
                // Mail::to($email)->send(new UsersOtpMail($email['email'], $token));
                $subject = trans('labels.otp_mail_subject', ['subject' => 'Forgot Password']);
                $data['type'] = trans('labels.otp_mail_type', ['type' => 'Forgot Password']);
                $data['otp'] = $otp;
                Mail::to($email)->send(new UsersOtpMail($subject, $data));

                $create = [
                    'user_id' => $user->id,
                    'otp' => $otp,
                    'type' => config('constants.forgot_password_otp'),
                    'status' => config('constants.active_otp')
                ];
                UserOtp::create($create);

                // return successResponse($valid, 'OTP Sent on Registered Email.');
                return redirect()->back()->with('success', 'OTP Sent on Registered Email.');
            } catch (\Exception $e) {
                // return errorResponse('Somethign went wrong. Please, try again', $e->getMessage());
                dd($e);
                return redirect()->back()->with('error', 'Something went wrong. Please, try again.');
            }
        }
        else
        {
            return redirect()->back()->with('error', 'User not Found. Please, try again.');
        }
    }

    public function showForgotPassword(Request $request, $otp)
    {
        dd($request->request, $otp, 'in show Forgot Password function.');
    }

    public function logout()
    {
        Session::flush();
        Auth::logout();
        return redirect()->route('admin.login')->with('success', "You've logged out successfully.");
    }
}
