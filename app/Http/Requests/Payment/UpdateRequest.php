<?php

namespace App\Http\Requests\Payment;

use App\Models\Invoice;
use App\Models\Invoice_payment;
use Exception;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
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
    public function run($id){
        try {
            $invoice = Invoice::find($id);
            if(!$invoice)
                return redirect()->back()->withErrors('invoices_failed_msg',__('failed_messages.payments.change.notFound'));
            if($invoice->remaining_amount < $this->collection_amount)
                return redirect()->back()->withErrors(__('failed_messages.payments.collection.less.rest'));
            $remaining_amount = $invoice->remaining_amount - $this->collection_amount;
            $payment = new Invoice_payment();
            $payment->invoice_id = $id;
            $payment->user_id = Auth::id();
            $payment->collection_amount = $this->collection_amount;
            $payment->note = $this->note;
            $payment->total = $invoice->remaining_amount;
            $payment->remaining_amount = $remaining_amount;
            if($remaining_amount > 0){
                $payment->payment_status = 2;
                $invoice->value_status = 2;
            }
            else{
                $payment->payment_status = 3;
                $invoice->value_status = 3;
            }
            $payment->save();
            $invoice->remaining_amount = $remaining_amount;
            $invoice->save();
            Session::put('invoices_success_msg',__('success_messages.payments.change'));
            return redirect()->route('invoices.index');

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
            'collection_amount'=>'required|numeric|min:1',
            'note'=>'nullable|string|max:255'
        ];
    }

    public function messages()
    {
        return [
          'collection_amount.required'=>__('failed_messages.payments.collection_amount.required'),
          'collection_amount.numeric'=>__('failed_messages.payments.collection_amount.numeric'),
          'collection_amount.min'=>__('failed_messages.payments.collection_amount.min'),
          'note.max'=>__('failed_messages.payments.note.max'),
        ];
    }
}
