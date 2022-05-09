<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ParentRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'email' => 'required|email',
            'father_name' => "required|string",
            'father_nation_id' => "required|min:10|max:10",
            'father_passport_id' => "required|min:10|max:10",
            'father_phone' => "required|numeric",
            'father_job' => "required",
            'father_address' => "required",
            'nationality_father_id' => "required",
            'boold_type_father_id' => "required",
            'religion_father_id' => "required",

            'mother_name' => "required|string",
            'mother_nation_id' => "required|min:10|max:10",
            'mother_passport_id' => "required|min:10|max:10",
            'mother_phone' => "required|numeric",
            'mother_job' => "required",
            'mother_address' => "required",
            'nationality_mother_id' => "required",
            'boold_type_mother_id' => "required",
            'religion_mother_id' => "required",
            "pass_photo" => "required|image|mimes:png,jpg,webp",
            "nation_photo" => "required|image|mimes:png,jpg,webp",
        ];
    }

    public function messages()
    {
        return [
            'email.required' => 'هذا الحقل مطلوب',
            'father_name.required' => 'هذا الحقل مطلوب',
            'father_nation_id.required' => 'هذا الحقل مطلوب',
            'father_passport_id.required' => 'هذا الحقل مطلوب',
            'father_phone.required' => 'هذا الحقل مطلوب',
            'father_job.required' => 'هذا الحقل مطلوب',
            'father_address.required' => 'هذا الحقل مطلوب',
            'nationality_father_id.required' => 'هذا الحقل مطلوب',
            'boold_type_father_id.required' => 'هذا الحقل مطلوب',
            'religion_father_id.required' => 'هذا الحقل مطلوب',

            'mother_name.required' => 'هذا الحقل مطلوب',
            'mother_nation_id.required' => 'هذا الحقل مطلوب',
            'mother_passport_id.required' => 'هذا الحقل مطلوب',
            'mother_phone.required' => 'هذا الحقل مطلوب',
            'mother_job.required' => 'هذا الحقل مطلوب',
            'mother_address.required' => 'هذا الحقل مطلوب',
            'nationality_mother_id.required' => 'هذا الحقل مطلوب',
            'boold_type_mother_id.required' => 'هذا الحقل مطلوب',
            'religion_mother_id.required' => 'هذا الحقل مطلوب',

            "pass_photo.required" => "الصوة مطلوبة",
            "nation_photo.required" => "الصوة مطلوبة",
        ];
    }
}
