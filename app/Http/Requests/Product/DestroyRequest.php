<?php

namespace App\Http\Requests\Product;

use App\Models\Product;
use Exception;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Session;

class DestroyRequest extends FormRequest
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
                return redirect()->back()->withErrors('هذا المنتج غير موجود');
            if($product->delete()){
                Session::put('products_success_msg','تم حذف المنتج بنجاح');
                return redirect()->back();
            }
        }catch (Exception $ex){
            return redirect()->back()->withErrors(['products_failed_msg'=> $ex->getMessage()]);
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
            //
        ];
    }
}
