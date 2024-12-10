<?php

namespace App\Http\Controllers;

use App\Models\KYC;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use App\Models\User;

class KYCController extends Controller
{

    /**
     * Display all KYC entries for the admins.
     */
    public function index(): View
    {
        $kycs = KYC::all();
        return view('kyc.index', compact('kycs'));
    }

    /**
     * Display the form for creating a new KYC entry.
     */
    public function create(): View
    {
        return view('kyc.create');
    }

    /**
     * Store a new KYC entry.
     */
    public function store(Request $request): JsonResponse
    {
        $user = Auth::user();

        if ($user->kyc_status === 'verified' or $user->kyc_status === 'pending') {
            return response()->json(['error' => 'You have already submitted a KYC entry.'], 400);
        }
        

        $request->validate([
            'document_type' => 'required|string',
            'document_number' => 'required|string',
            'document_image' => 'required|file|mimes:jpg,jpeg,png|max:2048',
            'selfie_image' => 'nullable|file|mimes:jpg,jpeg,png|max:2048',
        ]);

        // check if document number already exists
        if (KYC::where('document_number', $request->document_number)->exists()) {
            return response()->json(['error' => 'Document number already exists.'], 400);
        }

        $fileUrlSelfie = null;

        // Store the document image using the time and original name.
        $pathDocument = $request->file('document_image')->storeAs(
            'kyc',
            time() . '_' . $request->file('document_image')->getClientOriginalName(),
            'public'
        );


        // If a selfie image is uploaded
        if ($request->hasFile('selfie_image')) {
            // Store the selfie image using the same method
            $fileUrlSelfie = $request->file('selfie_image')->storeAs(
                'kyc',
                time() . '_' . $request->file('selfie_image')->getClientOriginalName(),
                'public'
            );
        }

        KYC::create([
            'user_id' => Auth::user()->id,
            'document_type' => $request->document_type,
            'document_number' => $request->document_number,
            'document_image' => $pathDocument,
            'selfie_image' => $fileUrlSelfie,
        ]);

        $user->kyc_status = 'pending';
        $user->save();

        return response()->json(['success' => 'KYC entry created successfully.']);
    }

    public function update(Request $request, $id): JsonResponse
    {
        $request->validate([
            'status' => 'required|string',
            'comment' => 'nullable|string',
        ]);

        // Retrieve the KYC entry
        $kyc = KYC::findOrFail($id);
        $status = $request->status;

        if ($status === 'approved') {
            // Update the user status based on the KYC status
            $user = $kyc->user;
            $user->kyc_status = 'verified';
            $user->save();

            $kyc->verified_at = now();
            $kyc->verified_by = Auth::user()->id;
        } elseif ($status === 'rejected') {
            $user = $kyc->user;
            $user->kyc_status = 'rejected';
            $user->save();

            if ($request->has('comment')) {
                $kyc->rejection_reason = $request->comment;
            }
        }

        // Update the KYC status
        $kyc->status = $status;

        $kyc->save();

        return response()->json(['success' => 'KYC entry updated successfully.']);
    }

    /**
     * 
     * Shows the KYC entry details and the user associated with it
     * Only the admin can see this
     * 
     */
    public function show($id): View
    {
        $kyc = KYC::findOrFail($id);
        $user = $kyc->user;
        return view('kyc.show', [
            'kycData' => $kyc,
            'user' => $user
        ]);
    }

    /**
     * 
     * Deletes the KYC entry
     * 
     */
    public function destroy($id): JsonResponse
    {
        $kyc = KYC::findOrFail($id);
        $user = $kyc->user;
        $user->status = 'rejected';
        $user->save();
        $kyc->delete();
        return response()->json(['success' => 'KYC entry deleted successfully.']);
    }
}
