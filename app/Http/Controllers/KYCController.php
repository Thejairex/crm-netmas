<?php

namespace App\Http\Controllers;

use App\Models\LinkedAccount;
use App\Models\LinkedAccounts;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class KYCController extends Controller
{
    public function index(): View
    {
        return view('kyc');
    }

    public function store(Request $request): JsonResponse
    {
        $request->validate([
            'linked_user_id' => 'required|exists:users,id',
        ]);
        $user = Auth::user(); // Get the authenticated user

        // Check if the user has reached the maximum number of linked accounts
        if ($user->linkedAccount()->count() >= 5) {
            return response()->json(['error' => 'You have reached the maximum number of linked accounts.'], 400);
        };

        LinkedAccounts::create([
            'user_id' => $user->id,
            'linked_account_id' => $request->linked_user_id,
            'status' => 'pending',
        ]);

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

    public function show(): JsonResponse
    {
        $user = Auth::user(); // Get the authenticated user

        return response()->json([
            'linkedAccounts' => $user->linkedAccounts()->get(),
            'user' => $user,
            'status' => $user->status,
        ]);
    }
}
