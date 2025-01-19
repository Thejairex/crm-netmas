<?php

namespace App\Http\Controllers;

use App\Mail\kycVerificationMail;
use App\Models\KYC;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;

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
    public function store(Request $request): RedirectResponse
    {
        $user = Auth::user();

        if ($user->kyc_status === 'verified' or $user->kyc_status === 'pending') {
            return response()->json(['error' => 'You have already submitted a KYC entry.'], 400);
        }

        $request->validate([
            'name' => 'required|string',
            'lastname' => 'required|string',
            'gender' => 'required|string',
            'phone' => 'required|string',
            'document_type' => 'required|string',
            'document_number' => 'required|string',
            'document_image' => 'required|file|mimes:jpg,jpeg,png|max:2048',
            'birth_date' => 'required|date_format:Y-m-d',
        ]);
            // dd($request);

        // check if document number already exists
        if (KYC::where('document_number', $request->document_number)->exists()) {
            return response()->json(['error' => 'Document number already exists.'], 400);
        }

        // Store the document image using the time and original name.
        $pathDocument = $request->file('document_image')->storeAs(
            'kyc',
            time() . '_' . $request->file('document_image')->getClientOriginalName(),
            'public'
        );


        KYC::create([
            'user_id' => Auth::user()->id,
            'name' => $request->name,
            'lastname' => $request->lastname,
            'gender' => $request->gender,
            'phone' => $request->phone,
            'document_type' => $request->document_type,
            'document_number' => $request->document_number,
            'document_image' => $pathDocument,
            'birth_date' =>  $request->birth_date,
        ]);

        $user->kyc_status = 'pending';
        $user->save();
        Mail::to($user->email)->send(new kycVerificationMail($user));
        return redirect()->route('profile.edit')->with('success', 'KYC entry sent successfully.');
    }

    public function update(Request $request, $id): RedirectResponse
    {
        $request->validate([
            'status' => 'required|string',
            'rejection_reason' => 'nullable|string',
        ]);

        // Retrieve the KYC entry
        $kyc = KYC::findOrFail($id);
        $status = $request->status;

        if ($status === 'approved') {
            // Update the user status based on the KYC status
            $user = $kyc->user;
            $user->name = $kyc->name;
            $user->lastname = $kyc->lastname;
            $user->gender = $kyc->gender;
            $user->phone = $kyc->phone;
            $user->document_type = $kyc->document_type;
            $user->document_number = $kyc->document_number;
            $user->birth_date = $kyc->birth_date;
            $user->kyc_status = 'verified';
            $user->save();

            $kyc->verified_at = now();
            $kyc->verified_by = Auth::user()->id;
            Mail::to($user->email)->send(new kycVerificationMail($user));

        } elseif ($status === 'rejected') {
            $user = $kyc->user;
            $user->kyc_status = 'rejected';
            $user->save();
            Mail::to($user->email)->send(new kycVerificationMail($user));

            if ($request->has('rejection_reason')) {
                $kyc->rejection_reason = $request->rejection_reason;
            }
        }

        // Update the KYC status
        $kyc->status = $status;

        $kyc->save();

        return redirect()->route('kyc.index')->with('success', 'KYC entry updated successfully.');
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
