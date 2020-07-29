<?php

namespace App\Http\Requests\API\Users;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Http\FormRequest;

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
        // dd($this->route_name);
        switch ($this->route_name) {
            case 'users.register':
                return false;
                break;
            case 'users.login':
                return false;
                break;
            case 'users.user_details':
                return true;
                break;
            case 'users.update_user_details':
                return true;
                break;
        }
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
                return false;
                break;
            case 'users.login':
                return false;
                break;
            case 'users.user_details':
                return true;
                break;
            case 'users.update_user_details':
                return [
                    'name' => 'nullable|string',
                    'gender' => 'nullable|digits:1',
                    'address' => 'nullable|string',
                    'city' => 'nullable|string',
                    'state' => 'nullable|string',
                    'country' => 'nullable|string',
                    'postal_code' => 'nullable|digits:6'
                ];
                break;
        }
    }

    public function messages()
    {
        switch ($this->route_name) {
            case 'users.register':
                return false;
                break;
            case 'users.login':
                return false;
                break;
            case 'users.user_details':
                return true;
                break;
            case 'users.update_user_details':
                return [
                    'gender.digits' => trans('errors.gender_format'),
                    'postal_code.digits' => trans('errors.postal_code_format'),
                ];
                break;
        }
    }
}
