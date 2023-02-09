<?php

namespace App\Http\Requests\CustomerReport;

use App\Models\Invoice;
use App\Models\Section;
use Illuminate\Foundation\Http\FormRequest;

class SearchRequest extends FormRequest
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
            $invoices = Invoice::where('section_id',$this->section_id)
                ->where('product_id',$this->product_id)
                ->get();
            if (!empty($this->start_at))
                $invoices = $invoices->where('invoice_Date', '>=', $this->start_at);
            if (!empty($this->end_at))
                $invoices = $invoices->where('due_date', '<=', $this->end_at);
            $sections = Section::all();
            $start_at = $this->start_at;
            $end_at = $this->end_at;
            return view('Front-end.reports.customer',compact('invoices','sections','start_at','end_at'));
        }catch (\Exception $ex){
            return redirect()->back()->withErrors(['failed',$ex->getMessage()]);
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
            'section_id'=>'required|exists:sections,id|numeric|min:1',
            'product_id'=>'required|exists:products,id|numeric|min:1',
            'start_at' => 'nullable|date_format:Y-m-d|before:end_at',
            'end_at' => 'nullable|date_format:Y-m-d',
        ];
    }
    public function messages()
    {
        return [
            'section_id.required'=>'الرجاء اختيار قسم من الاختيارات',
            'section_id.exists'=>'الرجاء اختيار قسم من الاختيارات',
            'section_id.numeric'=>'الرجاء اختيار قسم من الاختيارات',
            'section_id.min'=>'الرجاء اختيار قسم من الاختيارات',

            'product_id.required'=>'الرجاء اختيار منتج من الاختيارات',
            'product_id.exists'=>'الرجاء اختيار منتج من الاختيارات',
            'product_id.numeric'=>'الرجاء اختيار منتج من الاختيارات',
            'product_id.min'=>'الرجاء اختيار منتج من الاختيارات',

            'start_at.date_format'=>'الرجاء الالتزام بتنسيق التاريخ اليوم-الشهر-السنة',
            'start_at.before'=>'لا يمكن ان يكون تاريخ النهاية قبل تاريخ البداية',

            'end_at.date_format'=>'الرجاء الالتزام بتنسيق التاريخ اليوم-الشهر-السنة',
        ];
    }
}
