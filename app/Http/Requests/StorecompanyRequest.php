<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCompanyRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // Change this to implement user authorization logic if needed
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255|unique:companies,name',
            'email' => 'required|email|max:255|unique:companise,email',
            'phone' => 'nullable|string|max:20',
            'address' => 'required|string',
            'logo' => 'nullable|image|mimes:png,jpg,jpeg|max:2048',
            'website' => 'nullable|url|max:255',
            'company_type' => 'nullable|in:private,public,non-profit',
            'gst_number' => 'nullable|max:15|regex:/^[0-9]{2}[A-Z]{5}[0-9]{4}[A-Z]{1}[1-9A-Z]{1}Z[0-9A-Z]{1}',
            'industry_type' => 'nullable|string|max:50',
            'registration_number' => 'nullable|string|max:50',
            'founded_date' => 'nullable|date',
            'number_of_employees' => 'nullable|integer|min:0',
            'status' => 'nullable|boolean',

            'admin_full_name' => 'required|string|max:255',
            'admin_email' => 'required|email|max:255|unique:users,email',
            'admin_phone' => 'required|string|max:20|unique:users,phone',
            'admin_user_name' => 'required|string|max:50|unique:users,user_name',
            'admin_password' => 'required|string|min:8|confirmed',
            'admin_password_confirmation' => 'required|string|min:8',
            'admin_employee_id' => 'required|string|max:50'
        ];
    }

    public function messages():array
    {
        return [
            'name.required' => 'The company is required.',
            'name.unique' => 'This company name is already registered.',

            'email.required' => 'The company email address is required.',
            'email.email' => 'The email address must be valid.',
            'email.unique' => 'This email address is already registered.',

            'address.required' => 'The company address is required.',

            'logo.image' => 'The logo must be an image file.',
            'logo.mimes' => 'The logo must be a file of type: jpg, jpeg, png.',
            'logo.max' => 'The logo may not be larger than 2MB.',

            'website.url' => 'The company website must be a valid URL.',

            'company_type.in' => 'The company type must be one of: private, public, or non-profit.',

            'gst_number.max' => 'The GST number may not exceed 15 characters.',
            'gst_number.regex' => 'The GST number format is invalid.',

            'founded_date.date' => 'The founded date must be a valid date.',

            'number_of_employees.integer' => 'The number of employees must be an integer.',
            'number_of_employees.min' => 'The number of employees must be at least 0.',

            'status.boolean' => 'The company status must be true (active) or false (inactive).',

            'admin_full_name.required' => 'Super admin full name is required.',

            'admin_email.required' => 'Super admin email address is required.',
            'admin_email.email' => 'Super admin email address must be valid.',
            'admin_email.unique' => 'This email address is already registered.',

            'admin_phone.required' => 'Super admin phone number is required.',
            'admin_phone.unique' => 'This phone number is already registered.',

            'admin_user_name.required' => 'Super admin username is required.',
            'admin_user_name.unique' => 'This username is already taken.',

            'admin_password.required' => 'Super admin password is required.',
            'admin_password.min' => 'The password must be at least 8 characters long.',
            'admin_password.confirmed' => 'The password confirmation does not match.',

            'admin_employee_id.required' => 'Super admin employee ID is required.'
        ];
    }
}
