<?php

namespace App\Http\Requests\Section;

use App\Models\Section;
use Exception;
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

    public function run(){
        try {
            $section = new Section();
            $section->name = $this->section_name;
            $section->description = $this->description;
            if ($section->save()){
                session()->put('success_msg',__('success_messages.section.add'));
                return redirect()->back();
            }
            else
                return redirect()->back()->withErrors(__('failed_messages.failed'));
        }catch (Exception $ex){
            return redirect()->back()->withErrors($ex->getMessage());
        }
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
            'section_name.required'=>__('failed_messages.section.section_name.required'),
            'section_name.unique'=>__('failed_messages.section.section_name.unique'),
            'section_name.min'=>__('failed_messages.section.section_name.min'),
            'section_name.max'=>__('failed_messages.section.section_name.max'),
            'description.required'=>__('failed_messages.section.description.required'),
            'description.max'=>__('failed_messages.section.description.max')
        ];
    }
}
