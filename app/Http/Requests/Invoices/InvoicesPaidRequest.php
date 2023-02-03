<?php

namespace App\Http\Requests\Invoices;

use App\Models\Invoice;
use Illuminate\Foundation\Http\FormRequest;

class InvoicesPaidRequest extends FormRequest
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
        $invoices = Invoice::where('value_status','3')->get();
        return view('Front-end.invoices.paid_invoices',compact('invoices'));
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
