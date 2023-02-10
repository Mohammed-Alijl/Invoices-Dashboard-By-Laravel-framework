<?php

namespace App\Http\Requests\Notification;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DisplayRequest extends FormRequest
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

    public function run($id)
    {
        $notification = DB::table('notifications')->find($id);
        if (!$notification)
            return redirect()->back();
        $notifiable = Auth::user();
        $notification = $notifiable->notifications()->find($id);
        $notification->markAsRead();
        switch ($notification->data['page']):
            case 'invoice_store' :
                $invoice_id = $notification->data['invoice_id'];
                return redirect(route('invoices.show', $invoice_id));
            case 'invoice_archive':
                return redirect(route('invoices.deleted'));
            default:
                return redirect()->back();
        endswitch;
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
