<?php

namespace App\Http\Requests\Admin\Salons;

use Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;
use \Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Exceptions\HttpResponseException;

class SalonsRequest extends FormRequest
{
    public function __construct()
    {
        $this->route_name = Route::currentRouteName();
        $this->user_role_id = Auth::user()->role_id;
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        switch ($this->route_name) {
            case 'admin.salons.index':
                 return $this->user_role_id == config('constants.admin_role') ? true : false;
                break;
            case 'admin.salons.create':
                 return $this->user_role_id == config('constants.admin_role') ? true : false;
                break;
            case 'admin.salons.store':
                 return $this->user_role_id == config('constants.admin_role') ? true : false;
                break;
            case 'admin.salons.edit':
                 return $this->user_role_id == config('constants.admin_role') ? true : false;
                break;
            case 'admin.salons.update':
                 return $this->user_role_id == config('constants.admin_role') ? true : false;
                break;
            case 'admin.salons.update_owner_details':
                return $this->user_role_id == config('constants.admin_role') ? true : false;
                break;
        }
    }

    protected function prepareForValidation()
    {
        if ($this->route_name == 'admin.salons.store' || $this->route_name == 'admin.salons.update') {
            $this->merge([
                'email' => Str::lower($this->email)
            ]);
        }
        if ($this->route_name == 'admin.salons.update_owner_details') {
            $this->merge([
                'owner_email' => Str::lower($this->owner_email)
            ]);
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
            case 'admin.salons.store':
                return [
                    'name' => 'required|string',
                    'email' => 'required|email',
                    'address' => 'required|string',
                    'city' => 'required|string',
                    'state' => 'required|string',
                    'country' => 'required|string',
                    'postal_code' => 'required|digits:6',
                    'lat' => 'required|regex:/^[-]?\d{1,3}+(\.\d{3,7})?$/|max:10',
                    'lng' => 'required|regex:/^[-]?\d{1,3}+(\.\d{3,7})?$/|max:10',
                    'open_at' => 'required|date_format:H:i',
                    // 'close_at' => 'required|date_format:H:i|after:opens_at',
                    'close_at' => 'required|date_format:H:i',
                    'lunch_from' => 'required|date_format:H:i',
                    'lunch_to' => 'required|date_format:H:i'
                ];
                break;
            case 'admin.salons.update':
                return [
                    'name' => 'required|string',
                    'email' => 'required|email',
                    'address' => 'required|string',
                    'city' => 'required|string',
                    'state' => 'required|string',
                    'country' => 'required|string',
                    'postal_code' => 'required|digits:6',
                    'lat' => 'required|regex:/^[-]?\d{1,3}+(\.\d{3,7})?$/|max:10',
                    'lng' => 'required|regex:/^[-]?\d{1,3}+(\.\d{3,7})?$/|max:10',
                    'open_at' => 'required|date_format:H:i',
                    // 'close_at' => 'required|date_format:H:i|after:opens_at',
                    'close_at' => 'required|date_format:H:i',
                    'lunch_from' => 'required|date_format:H:i',
                    'lunch_to' => 'required|date_format:H:i'
                ];
                break;
            case 'admin.salons.update_owner_details':
                return [
                    'first_name' => 'required|string',
                    'last_name' => 'required|string',
                    'owner_email' => 'required|email',
                    // 'owner_imgae' => 'required|mimes:jpeg.jpg,png',
                    'mobile' => 'required|digits:10',
                    'alt_mobile' => 'required|digits:10'
                ];
                break;
        }
    }

    public function messages()
    {
        switch ($this->route_name) {
            case 'admin.salons.store':
                return [
                    'name.required' => trans('errors.name_required'),
                    'email.required' => trans('errors.email_required'),
                    'email.email' => trans('errors.email_format'),
                    'address.required' => trans('errors.address_required'),
                    'city.required' => trans('errors.city_required'),
                    'state.required' => trans('errors.city_required'),
                    'country.required' => trans('errors.country_required'),
                    'postal_code.required' => trans('errors.postal_code_required'),
                    'postal_code.digits' => trans('errors.postal_code_digits'),
                    'lat.required' => trans('errors.lat_required'),
                    'lat.regex' => trans('errors.lat_format'),
                    'lat.max' => trans('errors.lat_format'),
                    'lng.required' => trans('errors.lng_required'),
                    'lng.regex' => trans('errors.lng_format'),
                    'lng.max' => trans('errors.lng_format'),
                    'open_at.required' => trans('errors.salon_opens_at_required'),
                    'open_at.date_format' => trans('errors.salon_opens_at_format'),
                    'close_at.required' => trans('errors.salon_close_at_required'),
                    'close_at.date_format' => trans('errors.salon_close_at_format'),
                    'close_at.after' => trans('errors.salon_close_at_after_time'),
                    'lunch_from.required' => trans('errors.salon_lunch_from_required'),
                    'lunch_from.date_format' => trans('errors.salon_lunch_from_format'),
                    'lunch_to.required' => trans('errors.salon_lunch_to_required'),
                    'lunch_to.date_format' => trans('errors.salon_lunch_to_format'),
                    'lunch_to.after' => trans('errors.salon_lunch_to_after_time')
                ];
                break;
            case 'admin.salons.update':
                return [
                    'name.required' => trans('errors.name_required'),
                    'email.required' => trans('errors.email_required'),
                    'email.email' => trans('errors.email_format'),
                    'address.required' => trans('errors.address_required'),
                    'city.required' => trans('errors.city_required'),
                    'state.required' => trans('errors.city_required'),
                    'country.required' => trans('errors.country_required'),
                    'postal_code.required' => trans('errors.postal_code_required'),
                    'postal_code.digits' => trans('errors.postal_code_digits'),
                    'lat.required' => trans('errors.lat_required'),
                    'lat.regex' => trans('errors.lat_format'),
                    'lat.max' => trans('errors.lat_format'),
                    'lng.required' => trans('errors.lng_required'),
                    'lng.regex' => trans('errors.lng_format'),
                    'lng.max' => trans('errors.lng_format'),
                    'open_at.required' => trans('errors.salon_opens_at_required'),
                    'open_at.date_format' => trans('errors.salon_opens_at_format'),
                    'close_at.required' => trans('errors.salon_close_at_required'),
                    'close_at.date_format' => trans('errors.salon_close_at_format'),
                    'close_at.after' => trans('errors.salon_close_at_after_time'),
                    'lunch_from.required' => trans('errors.salon_lunch_from_required'),
                    'lunch_from.date_format' => trans('errors.salon_lunch_from_format'),
                    'lunch_to.required' => trans('errors.salon_lunch_to_required'),
                    'lunch_to.date_format' => trans('errors.salon_lunch_to_format'),
                    'lunch_to.after' => trans('errors.salon_lunch_to_after_time')
                ];
                break;
            case 'admin.salons.update_owner_details':
                return [
                    'first_name.require' => trans('errors.first_name_required'),
                    'last_name.required' => trans('errors.last_name_required'),
                    'owner_email.required' => trans('errors.email_required'),
                    'owner_email.email' => trans('errors.email_format'),
                    // 'owner_image.required' => trans('errors.image_required'),
                    // 'owner_image.mimes' => trans('errors.image_format'),
                    'mobile.required' => trans('errors.mobile_no_required'),
                    'mobile.digits' => trans('errors.mobile_no_format'),
                    'alt_mobile.required' => trans('errors.mobile_no_required'),
                    'alt_mobile.digits' => trans('errors.mobile_no_format'),
                ];
                break;
        }
    }

    //  This function is to send error messages to not authorized requests
    protected function failedAuthorization()
    {
        $errors = 'You are not authorized for this action';
        dd($errors);
    }
}
