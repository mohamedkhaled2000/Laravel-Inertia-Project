<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TeacherRequest extends FormRequest
{
    public $rules;
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
        $email_rule = 'required|email|unique:teachers,email';
        $teacher_id = request('teacher.id');
        if (!is_null($teacher_id)) {
            $email_rule .= ",{$teacher_id}";
        }
        $rules = [
            "email" => $email_rule,
            "name" => "required",
            "speicalize_id" => "required",
            "address" => "required",
            "gender" => "required",
        ];
        
        return $rules;
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
