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
                'message' => 'Validation Error(s)',
                'data' => $validator->errors(),
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

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            $response = [
                'status' => false,
                'message' => 'Validation Error(s)',
                'data' => $validator->errors(),
            ];
            // $response = json_encode($response);
            return response()->json($response);
        }

        if (Auth::attempt([
                'email' => $request->email,
                'password' => $request->password
            ])) {
            $user = Auth::user();
            $data['name'] = $user->name;
            $data['token'] = $user->createToken('TrouverApp')->accessToken;

            // $response = [
            //     'status' => true,
            //     'message' => 'You are logged in successfully.',
            //     'data' => $data
            // ];
            // return response()->json($response);
            return successResponse($data, 'You are logged in successfully.');
        } else {
            $response = [
                'status' => false,
                'message' => 'Please, check your credentials.'
            ];
            return response()->json($response);
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
        // $valid = $request->validated();
        // $input = $request->all();
        $validator = $request->validated();
        dd($validator);
        // if ($validator->fails()) {
        //     $data = $valid->messages();
        //     return errorResponse('Validation Error.' ,$data);
        // } else {
        //     dd($validator);
        // }
    }
}
