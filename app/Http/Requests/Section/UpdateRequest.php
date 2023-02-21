<?php

namespace App\Http\Requests\Section;

use App\Models\Section;
use Exception;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Session;

class UpdateRequest extends FormRequest
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
            $section = Section::find($this->id);
            if(!$section)
                return redirect()->back()->withErrors(__('failed_messages.section.notFound'));
            if ($this->filled('name'))
                $section->name = $this->name;
            if ($this->filled('description'))
                $section->description = $this->description;
            if($section->save()){
                Session::put('success_msg',__('success_messages.section.edit'));
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
            'name'=>'min:3|max:30|unique:sections,name,' . $this->id,
            'description'=>'max:255'
        ];
    }
    public function messages()
    {
        return[
            'name.required'=>__('failed_messages.section.name.required'),
            'name.unique'=>__('failed_messages.section.name.unique'),
            'name.min'=>__('failed_messages.section.name.min'),
            'name.max'=>__('failed_messages.section.name.max'),
            'description.required'=>__('failed_messages.section.description.required'),
            'description.max'=>__('failed_messages.section.description.max')
        ];
    }
}
