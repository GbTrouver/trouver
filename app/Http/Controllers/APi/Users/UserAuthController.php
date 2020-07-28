<?php

namespace App\Http\Controllers\APi\Users;

use App\User;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class UserAuthController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'email' => 'required|email',
            'password' => 'nullable',
            'confirm_password' => 'nullable|same:password',
            'mobile_no' => 'required|digits:10',
            'gender' => 'required|digits:1',
            'address' => 'nullable|string',
            'city' => 'nullable|string',
            'state' => 'nullable|string',
            'country' => 'nullable|string',
            'postal_code' => 'nullable|digits:6'
        ]);

        if ($validator->fails()) {
            $response = [
                'status' => false,
                'data' => $validator->errors(),
                'message' => 'Validation Error(s)',
            ];
            $response = json_encode($response);
            return $response;
        }

        $input = $request->all();
        $input['password'] = Hash::make($input['password']);
        $input['role_id'] = 1;
        try {
            $user = User::create($input);
            $response = json_encode([
                'status' => true,
                'message' => 'Your Registration has been done successfully.'
            ]);
            return $response;
        } catch (Illuminate\Database\QueryException $e) {
            $response = json_encode([
                'status' => false,
                'message' => 'Please, try again. Something went wrong.',
            ]);
            return $response;
        }
    }
}
