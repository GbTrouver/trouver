<?php

namespace App\Http\Requests\API\Users;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;
use \Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Exceptions\HttpResponseException;

class UserRequest extends FormRequest
{
    public function __construct()
    {
        $this->route_name = Route::currentRouteName();
    }
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // switch ($this->route_name) {
        //     case 'users.register':
        //         return false;
        //         break;
        //     case 'users.login':
        //         return false;
        //         break;
        //     case 'users.update_user_details':
        //         return true;
        //         break;
        // }
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        switch ($this->route_name) {
            case 'users.register':
                return [
                    'first_name' => 'required|string',
                    'last_name' => 'required|string',
                    'email' => 'required|email|unique:users',
                    'password' => 'nullable',
                    'confirm_password' => 'required_with:password|same:password',
                    'image' => 'nullable|string',
                    'mobile_no' => 'required|digits:10|unique:users',
                    'gender' => 'required|digits:1',
                    'address' => 'nullable|string',
                    'city' => 'nullable|string',
                    'state' => 'nullable|string',
                    'country' => 'nullable|string',
                    'postal_code' => 'nullable|digits:6',
                ];
                break;
            case 'users.login':
                return [
                    'email' => 'required|email',
                    'password' => 'required',
                ];
                break;
            case 'users.update_user_details':
                return [
                    'first_name' => 'nullable|string',
                    'last_name' => 'nullable|string',
                    'gender' => 'nullable|digits:1',
                    'image' => 'nullable|string',
                    'address' => 'nullable|string',
                    'city' => 'nullable|string',
                    'state' => 'nullable|string',
                    'country' => 'nullable|string',
                    'postal_code' => 'nullable|digits:6',
                ];
                break;
            case 'users.change_password':
                return [
                    'password' => 'required',
                    'new_password' => 'required',
                    'new_confirm_password' => 'required_with:new_password|same:new_password',
                ];
                break;
            case 'users.forgot_password_request':
                return [
                    'email' => 'required|email',
                ];
                break;
            case 'users.forgot_password':
                return [
                    'email' => 'required|email',
                    // 'password' => 'required|min:8|regex:/^.*(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\X]).*$/',
                    'otp' => 'required|digits:6',
                    'password' => 'required',
                    'confirm_password' => 'required_with:password|same:password'
                ];
                break;
            case 'users.login_request':
                return [
                    'email' => 'required|email'
                ];
                break;
            case 'users.login_with_otp':
                return [
                    'email' => 'required|email',
                    'otp' => 'required|digits:6',
                ];
                break;
        }
    }

    public function messages()
    {
        switch ($this->route_name) {
            case 'users.register':
                return [
                    'first_name.required' => trans('errors.first_name_required'),
                    'last_name.required' => trans('errors.last_name_required'),
                    'email.required' => trans('errors.email_required'),
                    'email.email' => trans('errors.email_format'),
                    'email.unique' => trans('errors.email_unique'),
                    'confirm_password.required_with' => trans('errors.confirm_password_required'),
                    'confirm_password.same' => trans('errors.confirm_password_same'),
                    'mobile_no.required' => trans('errors.mobile_no_required'),
                    'mobile_no.digits' => trans('errors.mobile_no_format'),
                    'mobile_no.unique' => trans('errors.mobile_no_unique'),
                    'gender.required' => trans('errors.gender_required'),
                    'gender.digits' => trans('errors.gender_format'),
                    'postal_code.digits' => trans('errors.postal_code_format'),
                    // 'image_name.image' => trans('errors.image_format'),
                ];
                break;
            case 'users.login':
                return [
                    'email.required' => trans('errors.email_required'),
                    'email.email' => trans('errors.email_format'),
                    'password.required' => trans('errors.password_required'),
                ];
                break;
            case 'users.update_user_details':
                return [
                    'gender.digits' => trans('errors.gender_format'),
                    'postal_code.digits' => trans('errors.postal_code_format'),
                    // 'image_name.image' => trans('errors.image_format'),
                ];
                break;
            case 'users.change_password':
                return [
                    'password.required' => trans('errors.password_required'),
                    'new_password.required' => trans('errors.new_password_required'),
                    'new_confirm_password.required_with' => trans('errors.new_confirm_password_required_with'),
                    'new_confirm_password.same' => trans('errors.new_confirm_password_same'),
                ];
                break;
            case 'users.forgot_password_request':
                return [
                    'email.required' => trans('errors.email_required'),
                    'email.email' => trans('errors.email_format'),
                ];
                break;
            case 'users.forgot_password':
                return [
                    'email.required' => trans('errors.email_required'),
                    'email.email' => trans('errors.email_format'),
                    'opt.required' => trans('errors.otp_required'),
                    'otp.digits' => trans('errors.otp_digits'),
                    'password.required' => trans('errors.password_required'),
                    'confirm_password.required_with' => trans('errors.confirm_password_required'),
                    'confirm_password.same' => trans('errors.confirm_password_same'),
                ];
                break;
            case 'users.login_request':
                return [
                    'email.required' => trans('errors.email_required'),
                    'email.email' => trans('errors.email_format'),
                ];
                break;
            case 'users.login_with_otp':
                return [
                    'email.required' => trans('errors.email_required'),
                    'email.email' => trans('errors.email_format'),
                    'opt.required' => trans('errors.otp_required'),
                    'otp.digits' => trans('errors.otp_digits'),
                ];
                break;
        }
    }

    public function failedValidation(Validator $validator)
    {
        $errors = (new ValidationException($validator))->errors();

        throw new HttpResponseException(
            errorResponse('Validation Errors', $errors, JsonResponse::HTTP_UNPROCESSABLE_ENTITY)
        );
    }

    //  This function is to send error messages to not authorized requests
    protected function failedAuthorization()
    {
        $errors = 'You are not authorized for this action';
        throw new HttpResponseException(
            errorResponse('Authorization Error', $errors, 403)
        );
    }
}
