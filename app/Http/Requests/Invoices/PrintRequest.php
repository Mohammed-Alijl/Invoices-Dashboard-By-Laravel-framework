<?php

namespace App\Http\Requests\Invoices;

use App\Models\Invoice;
use Exception;
use Illuminate\Foundation\Http\FormRequest;

class PrintRequest extends FormRequest
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

    public function run($id){
        try {
            $invoice = Invoice::find($id);
            if(!$invoice)
                return redirect()->back()->withErrors([__('failed_messages.invoices.print.notFound')]);
            return view('Front-end.invoices.print_invoices',compact('invoice'));
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
            //
        ];
    }
}
