<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Illuminate\Support\Facades\Validator;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
     {
         $validator = Validator::make($request->all(), [
             'name' => 'required|string|max:255',
             'lastname' => 'required|string|max:255',
             'email' => 'required|string|email|max:255|unique:users',
             'password' => 'required|string|min:8|confirmed',
             'role' => 'required|string|in:customer,supplier,admin',
         ]);
 
         if ($validator->fails()) {
             return redirect()->back()->withErrors($validator)->withInput();
         }
 
         $user = User::create([
             'name' => $request->name,
             'lastname' => $request->lastname,
             'email' => $request->email,
             'password' => $request->password,
             'role' => $request->role,
         ]);
 
         event(new Registered($user));
 
         Auth::login($user);
 
         return redirect()->route("dashboard");
     }
}
