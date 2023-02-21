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
               Session::put('products_success_msg',__('success_messages.product.add'));
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
            'name'=>'required|max:30|unique:products,name',
            'description'=>'required|min:10|max:255',
            'section_id'=>'exists:sections,id'
        ];
    }

    public function messages()
    {
        return [
          'name.required'=>__('failed_messages.product.name.required'),
          'name.max'=>__('failed_messages.product.name.max'),
          'name.unique'=>__('failed_messages.product.name.unique'),
          'description.required'=>__('failed_messages.product.description.required'),
          'description.min'=>__('failed_messages.product.description.min'),
          'description.max'=>__('failed_messages.product.description.max'),
          'section_id.exists'=>__('failed_messages.product.section_id.exists'),
        ];
    }
}
