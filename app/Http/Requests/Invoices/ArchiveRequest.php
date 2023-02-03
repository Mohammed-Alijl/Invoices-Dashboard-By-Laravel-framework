<?php

namespace App\Http\Requests\Invoices;

use App\Models\Invoice;
use Exception;
use Illuminate\Foundation\Http\FormRequest;
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
                return redirect()->back()->withErrors('invoices_failed_msg','الفاتورة المراد حذفها غير موجودة');
            if($invoice->delete()){
                Session::put('invoices_success_msg','تم حذف الفاتورة بنجاح');
                return redirect()->back();
            }else
                return redirect()->back()->withErrors('invoices_failed_msg','حدث خطا اثناء محاولة حذف الفاتورة');
        }catch (Exception $ex){
            return redirect()->back()->withErrors('invoices_failed_msg',$ex->getMessage());
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
