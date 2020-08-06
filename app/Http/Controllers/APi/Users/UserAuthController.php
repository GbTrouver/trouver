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

    public function loginRequest(UserRequest $request)
    {
        // return response()->json($request);
        $valid = $request->validated();
        $email = $request->only('email');
        $user = User::where('email', $email)->first('id');

        if(!empty($user))
        {
            try {
                $otp = rand(100001, 999999);
                // Mail::to($email)->send(new UsersOtpMail($email['email'], $token));
                $subject = trans('labels.otp_mail_subject', ['subject' => 'Login']);
                $data['type'] = trans('labels.otp_mail_type', ['type' => 'Login']);
                $data['otp'] = $otp;
                Mail::to($email)->send(new UsersOtpMail($subject, $data));

                $create = [
                    'user_id' => $user->id,
                    'otp' => $otp,
                    'type' => config('constants.login_otp'),
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

    public function loginWithOtp(UserRequest $request)
    {
        $valid = $request->validated();

        $user = User::where('email', $valid['email'])->first();
        $otp_data = $user->getOtp
                            ->where('type', config('constants.login_otp'))
                            ->where('status', config('constants.active_otp'))
                            ->last();

        if (!empty($otp_data)) {
            $data['created_at'] = Carbon::parse($otp_data->created_at);
            $data['current'] = Carbon::now();
            $diff_in_seconds = $data['created_at']->diffInSeconds($data['current']);

            if ($otp_data->otp == $valid['otp']) {
                if ($diff_in_seconds < config('constants.otp_expires_in')) {
                    if (!empty($user)) {
                        try {
                            if (Auth::loginUsingId($user->id)) {
                                $user = Auth::user();
                                $data['first_name'] = $user->first_name;
                                $data['last_name'] = $user->last_name;
                                $data['token'] = $user->createToken('TrouverApp')->accessToken;

                                return successResponse($data, 'You are logged in successfully.');
                            } else {
                                return errorResponse('Please, check your credentials.');
                            }
                        } catch (\Illuminate\Database\QueryException $e) {
                            return errorResponse('Something went wrong. Please, try again.', $e->getMessage());
                        }
                    } else {
                        return redirect()->back()->withInput()->with('error', 'Requested User not found, please try again.');
                    }
                } else {
                    return errorResponse('Your OTP has been expired.');
                }
            } else {
                return errorResponse('Please, enter an correct OTP.');
            }

            return successResponse($res , 'OTP is present');
        } else {
            return errorResponse('OTP is not present. Please, generate Otp first');
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
        // dd($request->request);
        $valid = $request->validated();
        // dd($valid);
        // return successResponse($valid, 'success');
        $userId = Auth::id();
        if (!empty($valid['image_name'])) {
            $raw_image = base64_decode($valid['image_name']);
            dd($raw_image);
        }
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
        $valid = $request->validated();
        $new_password = Hash::make($valid['password']);
        // return successResponse($new_password, 'Yeah');

        $user = User::where('email', $valid['email'])->first();
        $otp_data = $user->getOtp
                            ->where('type', config('constants.forgot_password_otp'))
                            ->where('status', config('constants.active_otp'))
                            ->last();
        if (!empty($otp_data)) {
            $data['created_at'] = Carbon::parse($otp_data->created_at);
            $data['current'] = Carbon::now();
            $diff_in_seconds = $data['created_at']->diffInSeconds($data['current']);

            if ($otp_data->otp == $valid['otp']) {
                if ($diff_in_seconds < config('constants.otp_expires_in')) {
                    if (!empty($user)) {
                        // dd($user, $otp_data);
                        try {
                            // $user = User::where('id', $email->id)->update(
                            //         ['password' => bcrypt($request->password),'token' => NULL
                            //     ]);
                            $user->fill([
                                'password' => Hash::make($valid['password'])
                            ]);
                            $otp_data->fill([
                                'stauts' => config('constants.inactive_otp')
                            ]);
                            $user->save();
                            $otp_data->save();
                            $response['status'] = true;
                            return successResponse($response, 'Your password has been changed succesfully.');
                        } catch (\Illuminate\Database\QueryException $e) {
                            return errorResponse('Something went wrong. Please, try again.', $e->getMessage());
                        }
                    } else {
                        return redirect()->back()->withInput()->with('error', 'Requested data not found, please try again.');
                    }
                } else {
                    return errorResponse('Your OTP has been expired.');
                }
            } else {
                return errorResponse('Please, enter an correct OTP.');
            }

            return successResponse($res , 'Otp is present');
        } else {
            return errorResponse('OTP is not present. Please, generate Otp first');
        }
    }

    public function forgotPasswordRequest(UserRequest $request)
    {
        // return response()->json($request);
        $valid = $request->validated();
        $email = $request->only('email');
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
