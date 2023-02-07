<?php

namespace App\Http\Requests\User;

use App\Models\User;
use App\Traits\AttachmentTrait;
use Illuminate\Foundation\Http\FormRequest;

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

    public function run()
    {
        try {
            $user = User::find($this->id);
            if (!$user)
                return redirect()->back()->withErrors('failed', 'المستخدم الذي تحاول حذفه غير موجود');
            if ($user->image != 'default.jpg')
                $this->delete_attachment('assets/img/users/' . $user->image);
            if ($user->delete()) {
                return redirect()->back()->withErrors(['failed' => 'تم حذف المستخدم بنجاح']);
            }
            else
                return redirect()->back()->withErrors(['failed' => 'حدث خطأ ما الرجاء المحاولة مرة أخرى']);
        } catch (\Exception $ex) {
            return redirect()->back()->withErrors('failed', $ex->getMessage());
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
