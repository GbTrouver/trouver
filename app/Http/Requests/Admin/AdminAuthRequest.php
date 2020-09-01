<?php

namespace App\Http\Requests\Admin;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;
use \Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Exceptions\HttpResponseException;

class AdminAuthRequest extends FormRequest
{
    public function __construct()
    {
        $this->route_name = Route::currentRouteName();
    }

    public function prepareForValidation()
    {
        switch ($this->route_name) {
            case 'admin.login_post':
                $this->merge([
                    'email' => Str::lower($this->email)
                ]);
                break;
            case 'admin.forgot_password_request':
                return [
                    'email' => Str::lower($this->email)
                ];
                break;
        }
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
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
            case 'admin.login_post':
                return [
                    'email' => 'required|email',
                    'password' => 'required|min:8',
                ];
                break;
            case 'admin.forgot_password_request':
                return [
                    'otp_email' => 'required|email',
                ];
                break;
        }
    }

    public function messages()
    {
        switch ($this->route_name) {
            case 'admin.login_post':
                return [
                    'email.required' => trans('errors.email_required'),
                    'email.email' => trans('errors.email_format'),
                    'password.required' => trans('errors.password_required'),
                    // 'passwrod.min' => trans('errors.password_min'),
                ];
                break;
            case 'admin.forgot_password_request':
                return [
                    'otp_email.required' => trans('errors.email_required'),
                    'otp_email.email' => trans('errors.email_format'),
                ];
                break;
        }
    }
}
