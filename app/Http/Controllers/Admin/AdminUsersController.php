<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Hash;

class AdminUsersController extends Controller
{
    /**
    * Create a new controller instance.
    *
    * @return void
    */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function getUsers()
    {
        $users = User::all();

        return view('admin.admin_users', compact('users'));
    }

    public function addUser(Request $request)
    {
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $request->password;
        $game->save();

        return redirect()->back();
    }

    public function updateUser(Request $request)
    {
        $userId = $request->updateUserId;

        $user = User::find($userId);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();

        return redirect()->back();
    }

    public function updatePasswordUser(Request $request)
    {
        $userId = $request->updateUserPasswordId;

        $newPassword = Hash::make($request->newpassword);

        $user = User::find($userId);
        $user->password = $newPassword;
        $user->save();

        return redirect()->back();
    }

    public function deleteUser(Request $request)
    {
        $userId = $request->deleteUserId;

        $user = User::where('id', $userId);
        $user->delete();

        return redirect()->back();
    }
}
