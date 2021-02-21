<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\ProfileRequest;

class ProfileController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function edit(Request $request) {
        return view('profile.edit')->with([
            'user' => $request->user(),
        ]);
    }

    public function update(ProfileRequest $request) {
        $user = $request->user();
        $user->fill($request->validated());
        if($user->isDirty('email')) {
            $user->email_verified_at = null;
            $user->sendEmailVerificationNotification();
        }
        if($request->hasFile('image')) {
            if($user->image != null) {
                Storage::disk('images')->delete($user->image->path);
                $user->image->delete();
            }
            $user->image()->create([
                'path' => $request->image->store('users', 'images'),
            ]);
        }
        $user->save();
        return redirect()->route('profile.edit')->withSuccess('Profile has been updated!');
    }
}
