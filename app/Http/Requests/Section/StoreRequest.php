<?php

namespace App\Http\Requests\Section;

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
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'section_name'=>'required|unique:sections,name|min:3|max:30',
            'description'=>'required|max:255'
        ];
    }
    public function messages()
    {
        return[
            'section_name.required'=>'اسم القسم مطلوب',
            'section_name.unique'=>'هذا القسم موجود بالفعل',
            'section_name.min'=>'اسم القسم قصير للغاية',
            'section_name.max'=>'يجب ان يكون اسم القسم اقل من 30 حرف',
            'description.required'=>'حقل الوصف مطلوب',
            'description.max'=>'الوصف اطول من اللازم'
        ];
    }
}
