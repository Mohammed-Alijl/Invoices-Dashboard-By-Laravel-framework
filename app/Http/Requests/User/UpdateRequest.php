<?php

namespace App\Http\Requests\User;

use App\Models\User;
use App\Traits\AttachmentTrait;
use Exception;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class UpdateRequest extends FormRequest
{
    public function __construct($id)
    {
        $this->id = $id;
    }
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
            $user = User::find($id);
            if(!$user)
                return redirect()->back()->withErrors('failed','هذا المستخدم غير موجود');
            if($this->filled('name'))
                $user->name = $this->name;
            if($this->filled('email'))
                $user->email = $this->email;
            if($this->filled('password'))
                $user->password = Hash::make($this->name);
            if($this->filled('roles_name'))
                $user->roles_name = $this->roles_name;
            if($this->filled('status'))
                $user->status = $this->status;
            if ($files = $this->file('pic')) {
                if($user->image != 'default.jpg')
                $this->delete_attachment('assets/img/users/' . $user->image);
                $imageName = $this->save_attachment($files, "assets/img/users");
                $user->image = $imageName;
            }
            if($user->save()){
                DB::table('model_has_roles')->where('model_id',$id)->delete();
                $user->assignRole($this->roles_name);
                Session::put('success', 'تم تعديل بيانات المستخدم بنجاح');
                return redirect()->route('users.index');
            }
            else
                return redirect()->withErrors('failed','حدث خطأ ما الرجاء المحاولة مرة اخرى');
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
            'name' => 'max:255|unique:users,name,' . $this->id,
            'email' => 'email|unique:users,email,' . $this->id,
            'password' => 'same:confirm-password',
            'roles_name' => 'array|exists:roles,name',
            'pic'=>'mimes:jpeg,jpg,png,svg|max:5000'
        ];
    }
    public function messages()
    {
        return [
            'name.unique'=>'اسم المستخدم مستخدم بالفعل, الرجاء الاختيار اسم مستخدم أخر',
            'name.max'=>'اسم المستخدم أطول من اللازم',
            'email.email'=>'الرجاء ادخال بريد الكتروني صحيح',
            'email.unique'=>'هذا البريد الالكتروني مستخدم بالفعل',
            'password.same'=>'كلمة السر وتأكيدها غير متطابقان الرجاء المحاولة مرة اخرى',
            'roles_name.array'=>'حدث خطأ ما الرجاء المحاولة مرة اخرى',
            'roles_name.exists'=>'حدث خطأ ما الرجاء المحاولة مرة أخرى',
            'pic.mimes'=>'يجب اختيار صورة منا امتداد: jpeg, jpg, png, svg',
            'pic.max'=>'حجم الصورة كبير حدا الرجاء اختيار صورة شخصية بحجم أقل',
        ];
    }
}
