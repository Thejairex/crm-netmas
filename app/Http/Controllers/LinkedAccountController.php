<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\LinkedAccount;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class LinkedAccountController extends Controller
{
    public function index(): View
    {
        return view('kyc.accounts');
    }

    public function store(Request $request): RedirectResponse
    {

        $user = Auth::user(); // Get the authenticated user
        if (!Hash::check($request->password, $user->password)) {
            return redirect()->route('profile.edit')->with('error', 'Incorrect password.');
        }
        $request->validate([
            'linked_user_email' => 'required|email|exists:users,email',
            'password' => 'required|string',
        ]);


        try {
            $linkedUser = User::where('email', $request->linked_user_email)->first(); // Get the linked user
        } catch (\Exception $e) {
            return response()->json(['error' => 'Linked user not found.'], 404);
        }
        if ($user->linkedAccounts()->where('linked_account_id', $linkedUser->id)->exists()) {
            return response()->json(['error' => 'You have already linked this user.'], 400);
        }
        if ($user->id === $linkedUser->id) {
            return redirect()->route('profile.edit')->with('error', 'You cannot link with yourself.');
        }


        if ($user->linkedAccounts()->count() >= 5) {
            return redirect()->route('profile.edit')->with('error', 'You have reached the maximum number of linked accounts.');
        }


        // Create the relationship between the users
        LinkedAccount::create([
            'user_id' => $user->id,
            'linked_account_id' => $linkedUser->id,
        ]);

        // Create the relationship between the users
        if (!$linkedUser->linkedAccounts()->where('linked_account_id', $user->id)->exists()) {
            LinkedAccount::create([
                'user_id' => $linkedUser->id,
                'linked_account_id' => $user->id,
            ]);
        }

        // Copy the user data to the linked user except for the username, password and email
        $linkedUser->update($user->only(
            'name',
            'lastname',
            'phone',
            'gender',
            'kyc_status',
            'document_type',
            'document_number',
            'birth_date'
        ));
        $user->save();
        return redirect()->route('profile.edit')->with('success', 'User linked successfully.');
    }
    public function update($linked_account_id): RedirectResponse
    {
        $admin = Auth::user(); // Get the authenticated user

        // check if the user is an admin
        if (!$admin->isAdmin()) {
            return redirect()->back()->with('error', 'You are not authorized to perform this action.');

        }

        $linkedAccount = LinkedAccount::find($linked_account_id);

        if (!$linkedAccount) {
            return response()->json(['error' => 'Linked account not found.'], 404);
        }

        $linkedAccount->status = 'approved';
        $linkedAccount->save();

        return response()->json(['success' => 'Account approved successfully.']);
    }

    /**
     * Display all user linked in the user account.
     */

    // public function show():
    // {
    //    //
    // }
}
