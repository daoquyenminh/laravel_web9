<?php

namespace App\Http\Requests\Course;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
//        return false; phải sửa đoạn này

    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name'=>[
                'bail',
                'required',
                'string',
                'unique:App\Models\Course,name'
            ],
        ];
    }
    public function messages():array
    {
        return [
            'required'=>':attribute bắt buộc phải điền',
            'unique'=>':attribute đax được dùng',
        ];
    }
    public function attributes()
    {
        return [
            'name'=>'Name',
        ];
    }
}
