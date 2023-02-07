<?php

namespace App\Http\Requests\User;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Spatie\Permission\Models\Role;

class ShowRequest extends FormRequest
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
            $user = User::find($id);
            $roles = Role::pluck('name','name')->all();
            $userRole = $user->roles->pluck('name','name')->all();
            if(!$user)
                return redirect()->back()->withErrors('failed','عذرا هذا المستخدم غير موجود');
            return view('Front-end.users.show',compact('user','roles','userRole'));
        }catch (\Exception $ex){
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
            //
        ];
    }
}
