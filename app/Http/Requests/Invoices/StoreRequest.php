<?php

namespace App\Http\Requests\Invoices;

use App\Events\NewNotification;
use App\Models\Attachment;
use App\Models\Invoice;
use App\Models\Invoice_payment;
use App\Models\User;
use App\Notifications\InvoiceCreated;
use App\Notifications\NewInvoice;
use App\Traits\AttachmentTrait;
use Exception;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Session;

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
            //this code to calculate the value of total & value_vat variables because of security reasons
            $Amount_Commission2 = $this->amount_commission - $this->discount;
            $value_vat = $Amount_Commission2 * floatval($this->rate_vat) / 100;
            $total = number_format(floatval($value_vat + $Amount_Commission2),2,'.','');
            $invoice = new Invoice();
            $invoice->invoice_number = intval($this->invoice_number) ;
            $invoice->invoice_date = $this->invoice_date;
            $invoice->due_date = $this->due_date;
            $invoice->section_id = intval($this->section_id) ;
            $invoice->product_id = intval($this->product_id);
            $invoice->discount = intval($this->discount);
            $invoice->rate_vat = $this->rate_vat;
            $invoice->value_vat = $value_vat;
            $invoice->amount_collection = intval($this->amount_collection);
            $invoice->amount_commission = intval($this->amount_commission);
            $invoice->total = intval($total);
            $invoice->value_status = 1;
            $invoice->note = $this->note;
            $invoice->user_id = Auth::id();
            $invoice->remaining_amount = intval($total);
            if(!$invoice->save())
                return redirect()->route('invoices.index')->withErrors('invoices_failed_msg','حدث خطا ما اثناء الاضافة الرجاء المحاولة مرة اخرى');
            else
                Session::put('invoices_success_msg','تم اضافة الفاتورة بنجاح');
            if ($files = $this->file('pic')) {
                    $attachmentName = $this->save_attachment($files, "assets/img/invoices/$invoice->invoice_number");
                    $attachment = new Attachment();
                    $attachment->invoice_id = $invoice->id;
                    $attachment->file_name = $attachmentName;
                    $attachment->save();
            }
            $payment = new Invoice_payment();
            $payment->invoice_id = $invoice->id;
            $payment->user_id = Auth::id();
            $payment->collection_amount = 0;
            $payment->total = intval($total);
            $payment->remaining_amount = intval($total);
            $payment->save();
//            Auth::user()->notify(new NewInvoice($invoice));
            Notification::send(User::where('id','!=',Auth::id())->get(),new InvoiceCreated($invoice->id));
            event(new \App\Events\NewNotification(
                $invoice->id,
                'تم اضافة فاتورة جديدة بواسطة: ' . Auth::user()->name,
            ));
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
            'invoice_number'=>'required|unique:invoices,invoice_number|min:1|max:999999|numeric',
            'invoice_date'=>'required|date|date_format:Y-m-d',
            'due_date'=>'required|date|date_format:Y-m-d|after_or_equal:invoice_date',
            'section_id'=>'required|exists:sections,id|numeric|min:1',
            'product_id'=>'required|exists:products,id|numeric|min:1',
            'discount' => 'required|numeric|lte:amount_commission|min:0',
            'amount_commission' => 'required|numeric|lte:amount_collection|min:1',
            'amount_collection'=>'required|numeric|max:999999|min:1',
            'note' => 'nullable|string|max:255',
            'rate_vat'=>'required|in:5%,10%',
            'pic'=>'mimes:pdf,jpeg,jpg,png|max:5000'
        ];
    }

    public function messages()
    {
        return [
          'invoice_number.required'=>'الرجاء ادخال رقم الفاتورة',
          'invoice_number.unique'=>'رقم الفاتورة هذا مستخدم بالفعل الرجاء اختيار رقم اخر',
          'invoice_number.min'=>'رقم الفاتورة يجب ان يكون رقم موجب',
          'invoice_number.max'=>'رقم الفاتورة اكبر من المسموح به',
          'invoice_number.numeric'=>'يجب ان يكون رقم الفاتورة أرقام فقط',

          'invoice_date.required'=>'الرجاء ادخال تاريخ الفاتورة',
          'invoice_date.date'=>'الرجاء ادخال تاريخ صحيح',
          'invoice_date.date_format'=>'يجب ان يكون تنسيق التاريخ Y-m-d',

          'due_date.required'=>'الرجاء ادخال تاريخ الاستحقاق',
          'due_date.date'=>'الرجاء ادخال تاريخ صحيح',
          'due_date.date_format'=>'يجب ان يكون تنسيق التاريخ Y-m-d',
          'due_date.after_or_equal'=>'يجب ان يكون تاريخ الاستحقاق اكبر من تاريخ الفاتورة او مساوي له',

          'section_id.required'=>'الرجاء اختيار قسم من الاختيارات',
          'section_id.exists'=>'الرجاء اختيار قسم من الاختيارات',
          'section_id.numeric'=>'الرجاء اختيار قسم من الاختيارات',
          'section_id.min'=>'الرجاء اختيار قسم من الاختيارات',

          'product_id.required'=>'الرجاء اختيار منتج من الاختيارات',
          'product_id.exists'=>'الرجاء اختيار منتج من الاختيارات',
          'product_id.numeric'=>'الرجاء اختيار منتج من الاختيارات',
          'product_id.min'=>'الرجاء اختيار منتج من الاختيارات',

          'discount.required'=>'الرجاء ادخال الخصم وفي حال عدم وجود خصم ادخال صفر',
          'discount.numeric'=>'الرجاء ادخال ارقام فقط',
          'discount.lte'=>' يجب ان يكون مبلغ الخصم اقل من مبلغ العمولة',
          'discount.min'=>'لا يمكن ان يكون مبلغ العمولة بسالب',

          'amount_commission.required'=>'الرجاء ادخال مبلغ العمولة',
          'amount_commission.numeric'=>'يجب ان يكون مبلغ العمولة ارقام فقط',
          'amount_commission.lte'=>'يجب ان يكون مبلغ العمولة اقل من مبلغ التحصيل',
          'amount_commission.min'=>'مبلغ العمولة اقل من المسموح به',

          'amount_collection.required'=>'مبلغ التحصيل مطلوب',
          'amount_collection.numeric'=>'مبلغ التحصيل يجب ان يكون ارقام فقط',
          'amount_collection.max'=>'مبلغ التحصيل اكبر من المسموح به',
          'amount_collection.min'=>'مبلغ التحصيل اقل من المسموح به',

          'note.string'=>'يجب ان تكون الملاحظات عبارة عن نصوص',
          'note.max'=>'الملاحظات اكبر من اللازم',

          'rate_vat.required'=>'يجب ان تكون نسبة ضريبة القيمة المضافة 5% او 10%',
          'rate_vat.in'=>'يجب ان تكون نسبة ضريبة القيمة المضافة 5% او 10%',

          'pic.mimes'=>'يجب ان تكون صيغة المرفق pdf, jpeg ,.jpg , png',
          'pic.max'=>'حجم المرفق كبير للغاية',
        ];
    }
}
