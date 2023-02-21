<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\User;
use App\Traits\AttachmentTrait;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;

class ProfileController extends Controller
{
    use AttachmentTrait;
    /**
     * Display the user's profile form.
     */
    public function edit(): View
    {
        return view('Front-end.editprofile');
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request,$id)
    {
        try {
            //check if the auth user how try to change data or not
            if($id != Auth::id())
                return abort(403);

            $user = User::find($id);

            if($request->filled('email'))
                $user->email = $request->email;

            if($request->filled('name'))
                $user->name = $request->name;

            if ($files = $request->file('pic')) {
                if($user->image != 'default.jpg')
                    $this->delete_attachment('assets/img/users/' . $user->image);
                $imageName = $this->save_attachment($files, "assets/img/users");
                $user->image = $imageName;
            }

            if($user->save()){
                Session::put('success',__('success_messages.profile.edit'));
                return redirect()->back();
            }

            return \redirect()->back()->withErrors(__('failed_messages.failed'));
        }catch (\Exception $exception){
            return redirect()->back()->withErrors($exception->getMessage());
        }
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current-password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
