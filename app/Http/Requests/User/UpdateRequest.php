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
                return redirect()->back()->withErrors(__('failed_messages.user.notFound'));
            if($this->filled('name'))
                $user->name = $this->name;
            if($this->filled('email'))
                $user->email = $this->email;
            if($this->filled('password'))
                $user->password = Hash::make($this->password);
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
                Session::put('success', __('success_messages.user.edit'));
                return redirect()->route('users.index');
            }
            else
                return redirect()->withErrors(__('failed_messages.failed'));
        }catch (Exception $ex){
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
            'name.unique'=>__('failed_messages.user.name.unique'),
            'name.max'=>__('failed_messages.user.name.max'),
            'email.email'=>__('failed_messages.user.email.email'),
            'email.unique'=>__('failed_messages.user.email.unique'),
            'password.same'=>__('failed_messages.user.password.same'),
            'roles_name.array'=>__('failed_messages.user.roles_name.array'),
            'roles_name.exists'=>__('failed_messages.user.roles_name.exists'),
            'pic.mimes'=>__('failed_messages.user.pic.mimes'),
            'pic.max'=>__('failed_messages.user.pic.max'),
        ];
    }
}
