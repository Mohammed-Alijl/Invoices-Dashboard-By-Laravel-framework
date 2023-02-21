<?php

namespace App\Http\Requests\Invoices;

use App\Models\Attachment;
use App\Models\Invoice;
use App\Models\Section;
use App\Traits\AttachmentTrait;
use Exception;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class EditRequest extends FormRequest
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
        try {
           $invoice = Invoice::find($id);
           if(!$invoice)
               return redirect()->back()->withErrors(__('failed_messages.invoices.edit.notFound'));
           $sections = Section::all();
           return view('Front-end.invoices.edit_invoices',compact('sections','invoice'));
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
