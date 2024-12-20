<?php

namespace App\Http\Controllers;

use App\Models\ImeiValidation;
use App\Services\ImeiValidationService;
use Illuminate\Http\Request;

class ImeiValidationController extends Controller
{
    protected $imeiValidationService;
    public function __construct(
        ImeiValidationService $imeiValidationService
    ) {
        $this->imeiValidationService = $imeiValidationService;
    }

    public function index()
    {
        $validations = ImeiValidation::all();
        return view('validation.index', compact('validations'));
    }

    public function create()
    {
        return view('validation.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'imei' => 'required|numeric|digits:15', // Asegura que sea un IMEI válido
        ]);
        $isValid = $this->imeiValidationService->checkImeiCompatibility($request->imei);

        ImeiValidation::create([
            'user_id' => auth()->user()->id,
            'imei' => $request->imei,
            'is_valid' => $isValid
        ]);
        return redirect()->route('validation.create')->with('success', 'IMEI validado correctamente.');
    }
}
