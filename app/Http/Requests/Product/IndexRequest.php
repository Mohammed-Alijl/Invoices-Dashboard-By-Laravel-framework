<?php

namespace App\Http\Requests\Product;

use App\Models\Product;
use App\Models\Section;
use Illuminate\Foundation\Http\FormRequest;

class IndexRequest extends FormRequest
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
        $products = Product::get();
        $sections = Section::get();
        return view('Front-end.products',compact('products','sections'));
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
