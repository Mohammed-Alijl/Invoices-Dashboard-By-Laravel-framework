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
                Session::put('invoices_details.success.msg',__('success_messages.attachment.add'));
                return redirect()->back();
            }
            else
                return redirect()->back()->withErrors('attachment.failed',__('failed_messages.attachment.add'));
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
            'invoice_id'=>'required|integer|exists:invoices,id',
            'invoice_number'=>'required|numeric|exists:invoices,invoice_number',
            'file_name'=>'required|mimes:pdf,jpeg,jpg,png|max:5000'
        ];
    }

    public function messages()
    {
        return [
            'invoice_id.required'=>__('failed_messages.attachment.invoice_id.required'),
            'invoice_id.integer'=>__('failed_messages.attachment.invoice_id.integer'),
            'invoice_id.exists'=>__('failed_messages.attachment.invoice_id.exists'),
            'invoice_number.required'=>__('failed_messages.attachment.invoice_number.required'),
            'invoice_number.numeric'=>__('failed_messages.attachment.invoice_number.numeric'),
            'invoice_number.exists'=>__('failed_messages.attachment.invoice_number.exists'),
            'pic.mimes'=>__('failed_messages.attachment.pic.mimes'),
            'pic.max'=>__('failed_messages.attachment.pic.max'),
        ];
    }
}
