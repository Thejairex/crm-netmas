<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\WelcomeUser;
use App\Models\User;
use App\Notifications\UserNotification;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;
use Illuminate\Support\Facades\Validator;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create($ref): View
    {
        // dd($ref);
        return view('auth.register', ['ref' => $ref]);
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
     {
         $validator = Validator::make($request->all(), [
             'username' => 'required|string|max:255|unique:users',
             'email' => 'required|string|email|max:255|unique:users',
             'password' => 'required|string|min:8|confirmed',
             'referralUser' => 'required|string|exists:users,username',
         ]);

         if ($validator->fails()) {
             return redirect()->back()->withErrors($validator)->withInput();
         }
         $referredUser = User::where('username', $request->referralUser)->first();

         if (!$referredUser) {
             return redirect()->back()->withErrors(['referralUser' => 'Invalid referral user.'])->withInput();
         }

         $user = User::create([
             'username' => $request->username,
             'email' => $request->email,
             'password' => $request->password,
             'parent_id' => $referredUser->id
         ]);

         event(new Registered($user));

         Auth::login($user);

         Mail::to($user->email)->send(new WelcomeUser($user)); // Send welcome email
         return redirect()->route("dashboard");
     }
}
