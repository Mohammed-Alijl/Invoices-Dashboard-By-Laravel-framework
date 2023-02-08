<?php

namespace App\Http\Requests\InvoiceReports;

use App\Models\Invoice;
use Illuminate\Foundation\Http\FormRequest;

class SearchRequest extends FormRequest
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

    public function run()
    {
        try {

            if ($this->radio == 1) {
                if ($this->status > 3)
                    $invoices = Invoice::all();
                else
                    $invoices = Invoice::where('value_status', $this->status)->get();
                if (!empty($this->start_at))
                    $invoices = $invoices->where('invoice_Date', '>=', $this->start_at);
                if (!empty($this->end_at))
                    $invoices = $invoices->where('due_date', '<=', $this->end_at);
            } else
                $invoices = Invoice::where('invoice_number', $this->invoice_number)->get();

            $start_at = $this->start_at;
            $end_at = $this->end_at;
            $status = $this->status;

            return view('Front-end.reports.invoices', compact('invoices', 'start_at', 'end_at', 'status'));

        } catch (\Exception $ex) {
            return redirect()->back()->withErrors(['failed' => $ex->getMessage()]);
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
            'radio' => 'required|in:1,2',
            'status' => 'required_if:radio,1|in:1,2,3,4',
            'start_at' => 'nullable|date_format:Y-m-d|before:end_at',
            'end_at' => 'nullable|date_format:Y-m-d',
            'invoice_number' => 'required_if:radio,2'
        ];
    }
    public function messages()
    {
        return [
            'radio.required'=>'الرجاء اختيار طريقة البحث',
            'radio.in'=>'الرجاء اختيار طريقة البحث',
            'status.required_if'=>'الرجاء تحديد نوع الفواتير',
            'status.in'=>'الرجاء تحديد نوع الفواتير',
            'start_at.date_format'=>'الرجاء الالتزام بتنسيق التاريخ اليوم-الشهر-السنة',
            'start_at.before'=>'لا يمكن ان يكون تاريخ النهاية قبل تاريخ البداية',
            'end_at.date_format'=>'الرجاء الالتزام بتنسيق التاريخ اليوم-الشهر-السنة',
            'invoice_number.required_if'=>'الرجاء ادخال رقم الفاتورة',
        ];
    }
}
