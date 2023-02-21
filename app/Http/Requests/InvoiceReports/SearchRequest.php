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
            'radio.required'=>__('failed_messages.reports.radio.required'),
            'radio.in'=>__('failed_messages.reports.radio.in'),
            'status.required_if'=>__('failed_messages.reports.status.required_if'),
            'status.in'=>__('failed_messages.reports.status.in'),
            'start_at.date_format'=>__('failed_messages.reports.start_at.date_format'),
            'start_at.before'=>__('failed_messages.reports.start_at.before'),
            'end_at.date_format'=>__('failed_messages.reports.end_at.date_format'),
            'invoice_number.required_if'=>__('failed_messages.reports.invoice_number.required_if'),
        ];
    }
}
