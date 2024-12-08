<?php

namespace App\Http\Controllers;

use App\Models\KYC;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
    public function store(Request $request): JsonResponse
    {

        $request->validate([
            'document_type' => 'required|string',
            'document_number' => 'required|string',
            'document_image' => 'required|file|mimes:jpg,jpeg,png|max:2048',
            'selfie_image' => 'nullable|file|mimes:jpg,jpeg,png|max:2048',
        ]);
        $fileUrlSelfie = null;


        if ($request->hasFile('document_image')) {
            $pathDocument = $request->file('document_image')->storeAs('public/kyc', time() . '_' . $request->file('document_image')->getClientOriginalName());
        }


        if ($request->hasFile('selfie_image')) {
            $fileUrlSelfie = $request->file('selfie_image')->storeAs('public/kyc', time() . '_' . $request->file('selfie_image')->getClientOriginalName());
        }

        KYC::create([
            'user_id' => Auth::user()->id,
            'document_type' => $request->document_type,
            'document_number' => $request->document_number,
            'document_image' => $pathDocument,
            'selfie_image' => $fileUrlSelfie,
        ]);

        return response()->json(['success' => 'KYC entry created successfully.']);
    }

    public function update(Request $request, $id): JsonResponse
    {
        $request->validate([
            'status' => 'required|string',
        ]);

        $kyc = KYC::findOrFail($id);
        $kyc->status = $request->status;
        $kyc->save();

        return response()->json(['success' => 'KYC entry updated successfully.']);
    }

    public function destroy($id): JsonResponse
    {
        KYC::findOrFail($id)->delete();
        return response()->json(['success' => 'KYC entry deleted successfully.']);
    }
}
