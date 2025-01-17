<?php

namespace App\Http\Controllers;

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

    public function store(Request $request): JsonResponse
    {
        $request->validate([
            'linked_user_email' => 'required|email|exists:users,email',
        ]);

        $user = Auth::user(); // Get the authenticated user

        try {
            $linkedUser = User::where('email', $request->linked_user_email)->first(); // Get the linked user
        } catch (\Exception $e) {
            return response()->json(['error' => 'Linked user not found.'], 404);
        }

        // Verification of the linked user
        if (!$linkedUser) {
            return response()->json(['error' => 'Linked user not found.'], 404);
        }
        
        if ($user->linkedAccounts()->where('linked_account_id', $linkedUser->id)->exists()) {
            return response()->json(['error' => 'You have already linked this user.'], 400);
        }
        
        if ($user->id === $linkedUser->id) {
            return response()->json(['error' => 'You cannot link yourself.'], 400);
        }
        
        if ($user->linkedAccounts()->count() >= 5) {
            return response()->json(['error' => 'You have reached the maximum number of linked accounts.'], 400);
        }
        // dd($linkedUser);


        // Create the relationship between the users
        LinkedAccount::create([
            'user_id' => $user->id,
            'linked_account_id' => $linkedUser->id,
            // 'status' => 'pending',
        ]);

        // Create the relationship between the users
        if (!$linkedUser->linkedAccounts()->where('linked_account_id', $user->id)->exists()) {
            LinkedAccount::create([
                'user_id' => $linkedUser->id,
                'linked_account_id' => $user->id,
            ]);
        }

        return response()->json(['success' => 'Account linked successfully.']);
    }
    public function update($linked_account_id): JsonResponse
    {
        $admin = Auth::user(); // Get the authenticated user

        // check if the user is an admin
        if (!$admin->isAdmin()) {
            return response()->json(['error' => 'You are not authorized to perform this action.'], 403);
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
