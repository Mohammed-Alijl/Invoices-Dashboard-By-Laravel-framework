<?php

namespace App\Http\Requests\Product;

use App\Models\Product;
use Exception;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Session;

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
           $product = new Product();
           $product->name = $this->name;
           $product->description = $this->description;
           $product->section_id = $this->section_id;
           if($product->save()){
               Session::put('products_success_msg','تم اضافة المنتج بنجاح');
               return redirect()->back();
           }
           else
               return redirect()->back()->withErrors(['products_failed_msg','حدث خطا ما اثناء الاضافة الرجاء المحاولة مرة اخرى']);
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
            'name'=>'required|max:30|unique:products,name',
            'description'=>'required|min:10|max:255',
            'section_id'=>'exists:sections,id'
        ];
    }

    public function messages()
    {
        return [
          'name.required'=>'اسم المنتج مطلوب',
          'name.max'=>'يجب ان يكون اسم المنتج اقل من 30 حرفا',
          'name.unique'=>'هذا المنتج موجود بالفعل',
          'description.required'=>'الوصف مطلوب',
          'description.min'=>'يجب ان يكون وصف المنتج 10 حروف على الاقل',
          'description.max'=>'وصف المنتج اكبر من اللازم',
          'section_id'=>'هذا القسم غير موجود',
        ];
    }
}
