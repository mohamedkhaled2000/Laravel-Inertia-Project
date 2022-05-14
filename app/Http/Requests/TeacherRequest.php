<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TeacherRequest extends FormRequest
{
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            "email" => "required|email|unique:teachers,email,".$this->id,
            "name" => "required",
            "speicalize_id" => "required",
            "address" => "required",
            "gender" => "required",
        ];
    }

    public function messages()
    {
        return [
            "email.required" => "هذا الحقل مطلوب",
            "email.unique" => "هذا الايميل موجود بالفعل",
            "name.required" => "هذا الحقل مطلوب",
            "speicalize_id.required" => "هذا الحقل مطلوب",
            "address.required" => "هذا الحقل مطلوب",
            "gender.required" => "هذا الحقل مطلوب",
        ];
    }
}
