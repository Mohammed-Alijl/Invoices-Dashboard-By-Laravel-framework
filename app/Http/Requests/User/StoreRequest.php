<?php

namespace App\Http\Requests\User;

use App\Models\User;
use App\Traits\AttachmentTrait;
use Exception;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

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
            $user = new User();
            $user->name = $this->name;
            $user->email = $this->email;
            $user->password = Hash::make($this->password);
            $user->roles_name = $this->roles_name;

            if ($files = $this->file('pic')) {
                $imageName = $this->save_attachment($files, "assets/img/users");
            }else
                $imageName = 'default.jpg';
            $user->image = $imageName;
            $user->status = $this->status;
            $user->save();

            $user->assignRole($this->roles_name);

            return redirect()->route('users.index')
                ->with('success','تم اضافة المستخدم بنجاح');
        }catch (Exception $ex){
            return redirect()->back()->withErrors('failed',$ex->getMessage());
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
            'name' => 'required|unique:users,name|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|same:confirm-password',
            'roles_name' => 'array|required|exists:roles,name',
            'pic'=>'mimes:jpeg,jpg,png,svg|max:5000'
        ];
    }

    public function messages()
    {
        return [
            'name.required'=>'الرجاء ادخال اسم المستخدم',
            'name.unique'=>'اسم المستخدم مستخدم بالفعل, الرجاء الاختيار اسم مستخدم أخر',
            'name.max'=>'اسم المستخدم أطول من اللازم',
            'email.required'=>'الرجاء ادخال البريد الالكتروني',
            'email.email'=>'الرجاء ادخال بريد الكتروني صحيح',
            'email.unique'=>'هذا البريد الالكتروني مستخدم بالفعل',
            'password.required'=>'الرجاء ادخال كلمة السر',
            'password.same'=>'كلمة السر وتأكيدها غير متطابقان الرجاء المحاولة مرة اخرى',
            'roles_name.array'=>'حدث خطأ ما الرجاء المحاولة مرة اخرى',
            'roles_name.required'=>'حدث خطأ ما الرجاء المحاولة مرة اخرى',
            'roles_name.exists'=>'حدث خطأ ما الرجاء المحاولة مرة أخرى',
            'pic.mimes'=>'يجب اختيار صورة منا امتداد: jpeg, jpg, png, svg',
            'pic.max'=>'حجم الصورة كبير حدا الرجاء اختيار صورة شخصية بحجم أقل',
        ];
    }
}
