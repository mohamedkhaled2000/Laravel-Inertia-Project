<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StudentRequest extends FormRequest
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
            "name" => "required",
            "email" => "required|email|unique:students,email,".$this->id,
            "password" => "required",
            "gender" => "required",
            "nationality_id" => "required",
            "type_blood_id" => "required",
            "date_brith" => "required",
            "grade_id" => "required",
            "class_room_id" => "required",
            "section_id" => "required",
            "parent_id" => "required",
            "academic_year" => "required",
        ];
    }

    public function messages()
    {
        return [
            "name.required" => "هذا الحقل مطلوب",
            "email.required" => "هذا الحقل مطلوب",
            "email.unique" => "هذا الايميل موجود بالفعل",
            "email.email" => "هذا الحقل يجب ان يكون ايميل",
            "password.required" => "هذا الحقل مطلوب",
            "gender.required" => "هذا الحقل مطلوب",
            "nationality_id.required" => "هذا الحقل مطلوب",
            "type_blood_id.required" => "هذا الحقل مطلوب",
            "date_brith.required" => "هذا الحقل مطلوب",
            "grade_id.required" => "هذا الحقل مطلوب",
            "class_room_id.required" => "هذا الحقل مطلوب",
            "section_id.required" => "هذا الحقل مطلوب",
            "parent_id.required" => "هذا الحقل مطلوب",
            "academic_year.required" => "هذا الحقل مطلوب",
        ];
    }
}
