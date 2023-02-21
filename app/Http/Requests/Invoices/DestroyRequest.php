<?php

namespace App\Http\Requests\Invoices;

use App\Events\NewNotification;
use App\Models\Invoice;
use App\Models\User;
use App\Notifications\InvoiceArchiveNotification;
use App\Notifications\InvoiceDestroyNotification;
use App\Traits\AttachmentTrait;
use Exception;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class DestroyRequest extends FormRequest
{
    use AttachmentTrait;
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
            $invoice = Invoice::onlyTrashed()->find($this->id);
            if(!$invoice)
                return redirect()->back()->withErrors(__('failed_messages.invoices.destroy.notFound'));
            $this->deleteDirectory('assets/img/invoices/' . $invoice->invoice_number);
            if($invoice->forceDelete()){
                Session::put('invoices_success_msg',__('success_messages.invoices.destroy'));
                Notification::send(User::where('id','!=',Auth::id())->get(),new InvoiceDestroyNotification($this->id));
                event(new NewNotification(
                    $this->id,
                    __('success_messages.invoices.destroy.notification') . auth()->user()->name ,
                ));
                return redirect()->back();
            }else
                return redirect()->back()->withErrors(__('failed_messages.invoices.destroy'));
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
