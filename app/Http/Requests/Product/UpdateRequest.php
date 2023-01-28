<?php

namespace App\Http\Requests\Product;

use App\Models\Product;
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
            $product = Product::find($this->id);
            if(!$product)
                return redirect()->back()->withErrors(['product_failed_msg'=>'هذا المنتج غير موجود']);
            if ($this->filled('section_name')){
                $section_id = Section::where('name',$this->section_name)->first()->id;
                $product->section_id = $section_id;
            }
            if ($this->filled('name'))
                $product->name = $this->name;
            if ($this->filled('description'))
                $product->description = $this->description;
            if($product->save()){
                Session::put('products_success_msg','تم اضافة التعديلات بنجاح');
                return redirect()->back();
            }

        }catch (Exception $ex){
            return redirect()->back()->withErrors(['products_failed_msg'=>$ex->getMessage()]);
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
            'section_name'=>'exists:sections,name',
            'name'=>'min:1|max:30|unique:products,name,' . $this->id,
            'description'=>'min:1|max:255'
        ];
    }
    public function messages()
    {
        return [
          'section_name.exists'=>'هذا القسم غير موجود',
          'name.max'=>'يجب ان يكون الاسم اقل من 30 حرفا',
          'name.unique'=>'هذا المنتج موجود بالفعل',
          'description.max'=>'الوصف كبير جدا',
            ];
    }
}
