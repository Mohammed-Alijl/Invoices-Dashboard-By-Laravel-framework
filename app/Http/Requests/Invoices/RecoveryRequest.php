<?php

namespace App\Http\Requests\Invoices;

use App\Models\Invoice;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Session;

class RecoveryRequest extends FormRequest
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
        $invoice = Invoice::withTrashed()->find($id);
        if(!$invoice)
            abort(404);
        if($invoice->restore()){
            Session::put('invoices_success_msg',__('success_messages.invoices.recovery'));
            return redirect()->back();
        }else
            return redirect()->back()->withErrors(__('failed_messages.failed'));
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
