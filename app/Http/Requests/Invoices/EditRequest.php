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
               return redirect()->back()->withErrors('invoices_failed_msg','الفاتورة المطلوب تعديلها غير موجودة');
           $sections = Section::all();
           return view('Front-end.invoices.edit_invoices',compact('sections','invoice'));
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
