<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUsersRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $user = auth()->user();

        return $user && in_array($user->role, ['super_admin', 'admin']);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'phone' => 'required|string|max:20|unique:users,phone',
            'user_name' => 'required|string|max:50|unique:users,user_name',
            'password' => 'required|string|min:8|confirmed', // Must match password_confirmation
            'password_confirmation' => 'required|string|min:8',
            'employee_id' => 'required|string|max:50',
            'role' => 'required|in:super_admin,admin,gatekeeper',
            'created_by' => 'required|string|max:255',
            'company_id' => 'required|exists:companies,id',
            'parent_id' => 'nullable|exists:users,id',
        ];
    }

    /**
     * Custom error messages for validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'full_name.required' => 'The full name is required.',
            'full_name.string' => 'The full name must be a valid string.',
            'full_name.max' => 'The full name may not exceed 255 characters.',

            'email.required' => 'The email address is required.',
            'email.email' => 'The email address must be valid.',
            'email.max' => 'The email address may not exceed 255 characters.',
            'email.unique' => 'This email address is already registered.',

            'phone.required' => 'The phone number is required.',
            'phone.string' => 'The phone number must be a valid string.',
            'phone.max' => 'The phone number may not exceed 20 characters.',
            'phone.unique' => 'This phone number is already registered.',

            'user_name.required' => 'The username is required.',
            'user_name.string' => 'The username must be a valid string.',
            'user_name.max' => 'The username may not exceed 50 characters.',
            'user_name.unique' => 'This username is already taken.',

            'password.required' => 'The password is required.',
            'password.string' => 'The password must be a valid string.',
            'password.min' => 'The password must be at least 8 characters long.',
            'password.confirmed' => 'The password confirmation does not match.',

            'employee_id.required' => 'The employee ID is required.',
            'employee_id.string' => 'The employee ID must be a valid string.',
            'employee_id.max' => 'The employee ID may not exceed 50 characters.',

            'role.required' => 'The role is required.',
            'role.in' => 'The role must be one of: super_admin, admin, or gatekeeper.',

            'created_by.required' => 'The creator information is required.',
            'created_by.string' => 'The creator information must be a valid string.',
            'created_by.max' => 'The creator information may not exceed 255 characters.',

            'company_id.required' => 'The company ID is required.',
            'company_id.exists' => 'The selected company does not exist.',

            'parent_id.exists' => 'The selected parent user does not exist.',
        ];
    }
}
