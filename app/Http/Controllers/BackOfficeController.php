<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class BackOfficeController extends Controller
{
    public function index()
    {
        return view('backoffice.index');
    }

    public function users()
    {
        return view('backoffice.users', [
            'users' => User::all()
        ]);
    }


    public function userUpdate(Request $request, $id)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'lastname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,'.$id],
            'role' => ['required', 'string', 'in:admin,user']
        ]);

        $user = User::findOrFail($id);

        $user->name = $request->name;
        $user->lastname = $request->lastname;
        $user->email = $request->email;
        $user->role = $request->role;

        $user->save();

        return redirect()->route('backoffice.users')->with('success', 'User updated successfully.');
    }

    public function userEdit($id)
    {
        return view('backoffice.users.edit', [
            'user' => User::find($id)
        ]);
    }

    public function userDestroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('backoffice.users')->with('success', 'User deleted successfully.');
    }

}
