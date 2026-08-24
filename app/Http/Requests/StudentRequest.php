<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StudentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'roll_no' => 'required',
            'name' => 'required',
            'major_id' => 'required',
            'gender' => 'required',
            'nrc' => 'required',
            'date_of_birth' => 'required',
            'phone_no' => 'required',
            'address' => 'required',
            'profile' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
            'email' => 'required',
            'password' => 'required|min:8',
        ];
    }
}
