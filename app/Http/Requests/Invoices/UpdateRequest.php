<?php

namespace App\Http\Requests\Invoices;

use App\Models\Attachment;
use App\Models\Invoice;
use App\Traits\AttachmentTrait;
use Exception;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class UpdateRequest extends FormRequest
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
            //this code to calculate the value of total & value_vat variables because of security reasons
            $Amount_Commission2 = $this->amount_commission - $this->discount;
            $value_vat = $Amount_Commission2 * floatval($this->rate_vat) / 100;
            $total = number_format(floatval($value_vat + $Amount_Commission2),2);


            $invoice = Invoice::find($id);
            if($this->filled('invoice_date'))
                $invoice->invoice_date = $this->invoice_date;
            if($this->filled('due_date'))
                $invoice->due_date = $this->due_date;
            if($this->filled('section_id'))
                $invoice->section_id = intval($this->section_id) ;
            if($this->filled('product_id'))
                $invoice->product_id = intval($this->product_id);
            if($this->filled('discount'))
                $invoice->discount = intval($this->discount);
            if($this->filled('rate_vat'))
                $invoice->rate_vat = $this->rate_vat;
            if($this->filled('value_vat'))
                $invoice->value_vat = $value_vat;
            if($this->filled('amount_collection'))
                $invoice->amount_collection = intval($this->amount_collection);
            if($this->filled('amount_commission'))
                $invoice->amount_commission = intval($this->amount_commission);
            if($this->filled('total'))
                $invoice->total = intval($total);
            if($this->filled('note'))
                $invoice->note = $this->note;
            if(!$invoice->save())
                return redirect()->back()->withErrors('invoices_failed_msg','حدث خطا ما اثناء اضاقة التعديلات الرجاء المحاولة مرة اخرى');
            else
                Session::put('invoices_success_msg','تم اضافة الفاتورة بنجاح');
            if ($files = $this->file('pic')) {
                    $attachmentName = $this->save_attachment($files, "assets/img/invoices/$invoice->invoice_number");
                    $attachment = new Attachment();
                    $attachment->invoice_id = $invoice->id;
                    $attachment->file_name = $attachmentName;
                    $attachment->save();
            }
                return redirect()->route('invoices.index');
        }catch (Exception $ex){
            return redirect()->route('invoices.index')->withErrors('invoices_failed_msg',$ex->getMessage());
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
            'invoice_date'=>'date|date_format:Y-m-d',
            'due_date'=>'date|date_format:Y-m-d|after_or_equal:invoice_date',
            'section_id'=>'exists:sections,id|numeric|min:1',
            'product_id'=>'exists:products,id|numeric|min:1',
            'discount' => 'numeric|lte:amount_commission|min:0',
            'amount_commission' => 'numeric|lte:amount_collection|min:1',
            'amount_collection'=>'numeric|max:99999999|min:1',
            'note' => 'nullable|string|max:255',
            'rate_vat'=>'in:5%,10%',
            'pic'=>'mimes:pdf,jpeg,jpg,png|max:5000'
        ];
    }

    public function messages()
    {
        return [
          'invoice_date.date'=>'الرجاء ادخال تاريخ صحيح',
          'invoice_date.date_format'=>'يجب ان يكون تنسيق التاريخ Y-m-d',

          'due_date.date'=>'الرجاء ادخال تاريخ صحيح',
          'due_date.date_format'=>'يجب ان يكون تنسيق التاريخ Y-m-d',
          'due_date.after_or_equal'=>'يجب ان يكون تاريخ الاستحقاق اكبر من تاريخ الفاتورة او مساوي له',

          'section_id.exists'=>'الرجاء اختيار قسم من الاختيارات',
          'section_id.numeric'=>'الرجاء اختيار قسم من الاختيارات',
          'section_id.min'=>'الرجاء اختيار قسم من الاختيارات',

          'product_id.exists'=>'الرجاء اختيار منتج من الاختيارات',
          'product_id.numeric'=>'الرجاء اختيار منتج من الاختيارات',
          'product_id.min'=>'الرجاء اختيار منتج من الاختيارات',

          'discount.numeric'=>'الرجاء ادخال ارقام فقط',
          'discount.lte'=>' يجب ان يكون مبلغ الخصم اقل من مبلغ العمولة',
          'discount.min'=>'لا يمكن ان يكون مبلغ العمولة بسالب',

          'amount_commission.numeric'=>'يجب ان يكون مبلغ العمولة ارقام فقط',
          'amount_commission.lte'=>'يجب ان يكون مبلغ العمولة اقل من مبلغ التحصيل',
          'amount_commission.min'=>'مبلغ العمولة اقل من المسموح به',

          'amount_collection.numeric'=>'مبلغ التحصيل يجب ان يكون ارقام فقط',
          'amount_collection.max'=>'مبلغ التحصيل اكبر من المسموح به',
          'amount_collection.min'=>'مبلغ التحصيل اقل من المسموح به',

          'note.string'=>'يجب ان تكون الملاحظات عبارة عن نصوص',
          'note.max'=>'الملاحظات اكبر من اللازم',

          'rate_vat.in'=>'يجب ان تكون نسبة ضريبة القيمة المضافة 5% او 10%',

          'pic.mimes'=>'يجب ان تكون صيغة المرفق pdf, jpeg ,.jpg , png',
          'pic.max'=>'حجم المرفق كبير للغاية',
        ];
    }
}
