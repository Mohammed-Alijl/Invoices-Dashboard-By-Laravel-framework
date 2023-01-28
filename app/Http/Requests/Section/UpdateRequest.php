<?php

namespace App\Http\Requests\section;

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
                return redirect()->back()->withErrors(['failed_msg'=>'هذا القسم غير موجود']);
            if ($this->filled('name'))
                $section->name = $this->name;
            if ($this->filled('description'))
                $section->description = $this->description;
            if($section->save()){
                Session::put('success_msg','تم اضافة التعديلات على القسم بنجاح');
                return redirect()->back();
            }
            else
                return redirect()->back()->withErrors(['failed_msg'=> 'حدث خطأ ما الرجاء المحاولة مرة اخرى']);
        }catch (Exception $ex){
            return redirect()->back()->withErrors(['failed_msg'=>$ex->getMessage()]);
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
            'name.required'=>'اسم القسم مطلوب',
            'name.unique'=>'هذا القسم موجود بالفعل',
            'name.min'=>'اسم القسم قصير للغاية',
            'name.max'=>'يجب ان يكون اسم القسم اقل من 30 حرف',
            'description.required'=>'حقل الوصف مطلوب',
            'description.max'=>'الوصف اطول من اللازم'
        ];
    }
}
