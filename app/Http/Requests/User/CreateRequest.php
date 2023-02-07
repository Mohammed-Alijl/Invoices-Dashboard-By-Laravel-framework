<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Spatie\Permission\Models\Role;

class CreateRequest extends FormRequest
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

    public function run(){
        $roles = Role::all();
        return view('Front-end.users.create',compact('roles'));
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
