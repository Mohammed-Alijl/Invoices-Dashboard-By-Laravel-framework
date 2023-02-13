<?php

namespace App\Http\Requests\Notification;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class RealTimeRequest extends FormRequest
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

    public function run($id){
        try {
            $notification_id = Auth::user()->notifications()->where('data->invoice_id', $id)->pluck('id')->first();
            return redirect()->route('notification.display',$notification_id);
        }catch (\Exception $ex){
            return redirect()->back()->withErrors(['failed',$ex->getMessage()]);
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
