<?php

namespace App\Http\Controllers\API\Users;

Use DB;
use Image;
use File;
use App\User;
use App\UserOtp;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Mail\API\Users\UsersOtpMail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\API\Users\UserRequest;

class UserAuthController extends Controller
{
    public function register(UserRequest $request)
    {
        $valid = $request->validated();
        $input = $request->all();
        $input['password'] = Hash::make($input['password']);
        $input['role_id'] = 1;
        try {
            $user = User::create($input);
            $data['token'] = $user->createToken('TrouverApp')->accessToken;
            $data['name'] = $user->name;
            return successResponse($data, 'Your Registration has been done successfully.');
        } catch (Illuminate\Database\QueryException $e) {
            return errorResponse('Please, try again. Something went wrong.');
        }
    }

    public function login(UserRequest $request)
    {
        $valid = $request->validated();
        if (Auth::attempt([
                'email' => $request->email,
                'password' => $request->password
            ])) {
            $user = Auth::user();
            $data['first_name'] = $user->first_name;
            $data['last_name'] = $user->last_name;
            $data['token'] = $user->createToken('TrouverApp')->accessToken;

            return successResponse($data, 'You are logged in successfully.');
        } else {
            return errorResponse('Please, check your credentials.');
        }
    }

    public function userDetails(Request $request)
    {
        $user = Auth::user();
        $message = 'Your profile details are here.';
        return successResponse($user, $message);
    }

    public function updateUserDetails(UserRequest $request)
    {
        $valid = $request->validated();
        $userId = Auth::id();
        try {
            $user = User::findOrFail($userId);
            $user->fill($valid);
            $user->save();
            $data = $user;
            return successResponse($data, 'Your Profile has been updated successfully.');
        } catch (Illuminate\Database\QueryException $e) {
            return errorResponse('Something went wrong, Please, try again.', $e->getMessage());
        }
    }

    public function changePassword(UserRequest $request)
    {
        $valid = $request->validated();
        $new_password = Hash::make($valid['new_password']);
        try {
            $user = User::findOrFail(Auth::user()->id);
            $user->fill(['password' => $new_password]);
            $user->save();
            $data['success'] = true;
            $logout = $this->logout();
            return successResponse($data, 'Your Password has been changed successfully. Please, Login again.');
        } catch (Illuminate\Database\QueryException $e) {
            return errorResponse('Something went wrong, Please, try again.', $e->getMessage());
        }
        // return successResponse($valid, 'Validation run successfully.');
    }

    // public function logout(UserRequest $request)
    public function logout()
    {
        $user = Auth::user();
        $user->token()->revoke();
        $data['success'] = true;
        return successResponse($data, 'You are logged out successfully.');
    }

    public function forgotPassword(UserRequest $request)
    {
        // dd($request->only('email', 'password', 'confirm-password'));
        $valid = $request->validated();

        $user = User::where('email', $valid['email'])->first();
        $otp_data = $user->getOtp;
        return successResponse($otp_data, 'Otp is present');
        // $diff_in_seconds =


        if (!empty($email)) {
            try {
                $user = User::where('id', $email->id)->update(
                        ['password' => bcrypt($request->password),'token' => NULL
                    ]);
                return redirect()->route('admin.login')->with('success', 'Your password has been changed succesfully.');
            } catch (\Illuminate\Database\QueryException $e) {
                return redirect()->back()->with('error', 'Your password cannot be changed');
            }
        } else {
            return redirect()->back()->withInput()->with('error', 'Requested data not found, please try again.');
        }
    }

    public function forgotPasswordRequest(UserRequest $request)
    {
        $valid = $request->validated();
        $email = $request->only('email');
        $user = User::where('email', $email)->first('id');

        if(!empty($user))
        {
            try {
                $otp = rand(100001, 999999);
                // Mail::to($email)->send(new UsersOtpMail($email['email'], $token));
                $subject = 'Forgot Password OTP mail.';
                $data['type'] = 'Forgot Password OTP';
                $data['otp'] = $otp;
                Mail::to($email)->send(new UsersOtpMail($subject, $data));

                $create = [
                    'user_id' => $user->id,
                    'otp' => $otp,
                    'type' => config('constants.forgot_password_otp'),
                    'status' => config('constants.active_otp')
                ];
                UserOtp::create($create);

                return successResponse($valid, 'OTP Sent on Registered Email.');
            } catch (\Exception $e) {
                return errorResponse('Somethign went wrong. Please, try again', $e->getMessage());
            }
        }
        else
        {
            return errorResponse("Entered email doesn't exist. Please, enter a valid email");
        }
    }
}
