<?php

namespace App\Http\Controllers\API\Users;

use App\User;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
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
            $data['name'] = $user->name;
            $data['token'] = $user->createToken('TrouverApp')->accessToken;

            return successResponse($data, 'You are logged in successfully.');
        } else {
            return errorResponse('Please, check your credentials.');
        }
    }

    public function userDetails(UserRequest $request)
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
}
