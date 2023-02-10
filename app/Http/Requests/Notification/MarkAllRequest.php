<?php

namespace App\Http\Requests\Notification;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class MarkAllRequest extends FormRequest
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
            if (Auth::user()->unreadNotifications->markAsRead())
                Auth::user()->unreadNotifications->markAsRead();
            return redirect()->back();
        } catch (\Exception $ex) {
            return redirect()->back()->withErrors(['failed', $ex->getMessage()]);
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
