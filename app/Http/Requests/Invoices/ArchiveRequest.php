<?php

namespace App\Http\Requests\Invoices;

use App\Events\NewNotification;
use App\Models\Invoice;
use App\Models\User;
use App\Notifications\InvoiceArchiveNotification;
use Exception;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Session;

class ArchiveRequest extends FormRequest
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
            $invoice = Invoice::find($this->id);
            if(!$invoice)
                return redirect()->back()->withErrors(__('failed_messages.invoice.archive.notFound'));
            if($invoice->delete()){
                Session::put('invoices_success_msg',__('success_messages.invoice.archive'));
                Notification::send(User::where('id','!=',Auth::id())->get(),new InvoiceArchiveNotification($this->id));
                event(new NewNotification(
                    $this->id,
                    __('success_messages.invoice.archive.notification') . auth()->user()->name,
                ));
                return redirect()->back();
            }else
                return redirect()->back()->withErrors(__('failed_messages.invoices.archive'));
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
