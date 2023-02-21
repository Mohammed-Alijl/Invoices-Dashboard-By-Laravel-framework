<?php

namespace App\Http\Requests\Attachment;

use App\Models\Attachment;
use App\Traits\AttachmentTrait;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Session;

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

    public function run($id){
        $attachment = Attachment::find($id);
        if(!$attachment)
            abort(404);
        if($attachment->delete()){
            Session::put('invoices_details.success.msg',__('success_messages.attachment.delete'));
            $this->delete_attachment("assets/img/invoices/" . $attachment->invoice->invoice_number .  '/' . $attachment->file_name);
            return redirect()->back();
        }else
            return redirect()->back()->withErrors('invoices_details.failed.msg',__('success_messages.attachment.delete'));
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
