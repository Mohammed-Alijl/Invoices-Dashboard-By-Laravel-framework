<?php

namespace App\Http\Requests\Attachment;

use App\Models\Attachment;
use App\Traits\AttachmentTrait;
use Exception;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class StoreRequest extends FormRequest
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
            $attachment = new Attachment();
            $file = $this->file('file_name');
            $attachmentName = $this->save_attachment($file, "assets/img/invoices/$this->invoice_number");
            $attachment->invoice_id = $this->invoice_id;
            $attachment->file_name = $attachmentName;
            if($attachment->save()){
                Session::put('invoices_details.success.msg','تم اضافة المرفق بنجاح');
                return redirect()->back();
            }
            else
                return redirect()->back()->withErrors('attachment.failed','فشل اضافة المرفق الرجاء المحاولة مرة اخرى');
        }catch (Exception $ex){
            return redirect()->back()->withErrors('attachment.failed',$ex->getMessage());
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
            'invoice_id'=>'required|integer|exists:invoices,id',
            'invoice_number'=>'required|numeric|exists:invoices,invoice_number',
            'file_name'=>'required|mimes:pdf,jpeg,jpg,png|max:5000'
        ];
    }

    public function messages()
    {
        return [
            'invoice_id.required'=>'معرف الفاتورة مطلوب',
            'invoice_id.integer'=>'يجب ان يكون رقم الفاتورة رقما صحيحا',
            'invoice_id.exists'=>'الفاتورة المراد اضافة مرفق لها غير صحيحة',
            'invoice_number.required'=>'الرجاء ادخال رقم الفاتورة',
            'invoice_number.numeric'=>'يجب ان يكون رقم الفاتورة أرقام فقط',
            'invoice_number.exists'=>'يجب أن يكون رقم الفاتورة صحيحا',
            'pic.mimes'=>'يجب ان تكون صيغة المرفق pdf, jpeg ,.jpg , png',
            'pic.max'=>'حجم المرفق كبير للغاية',
        ];
    }
}
