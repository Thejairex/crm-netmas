<?php

namespace App\Http\Controllers;

use App\Models\EducationalResource;
use Illuminate\Http\Request;

class EducationalResourceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $resources = EducationalResource::all();
        return view('educational-resources.index', compact('resources'));
    }

    public function create()
    {
        return view('educational-resources.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
            'type' => 'required|string',
            'file' => 'nullable|file|mimes:pdf,doc,docx,ppt,pptx,jpg,jpeg,png,gif,svg|max:2048',
            'video_url' => 'nullable|string',
        ]);

        if ($request->hasFile('file')) {
            $fileName = $request->file('file')->storeAS(
                'educational-resources',
                time() . '_' . $request->file('file')->getClientOriginalName(),
                options: 'public'
            );
        } else if ($request->filled('video_url')) {
            // Verificar si la URL es válida
            if (strpos($request->video_url, 'youtube.com') === false) {
                return redirect()->back()->with('error', 'Invalid YouTube URL');
            }
        } else {
            return redirect()->back()->with('error', 'At least one must be filled in (file or video url)');
        }

        EducationalResource::create([
            'title' => $request->title,
            'description' => $request->description,
            'type' => $request->type,
            'file_path' => $fileName ?? null,
            'video_url' => $request->video_url
        ]);

        return redirect()->route('educational-resources.index')->with('success', 'Educational resource created successfully.');
    }
    /**
     * Display the specified resource.
     */
    public function show(EducationalResource $educationalResource)
    {
        return view('educational-resources.show', compact('educationalResource'));
    }

    public function edit(EducationalResource $educationalResource)
    {
        return view('educational-resources.edit', compact('educationalResource'));
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, EducationalResource $educationalResource)
    {

        $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
            'type' => 'required|string',
            'file' => 'nullable|file|mimes:pdf,doc,docx,ppt,pptx,jpg,jpeg,png,gif,svg',
            'video_url' => 'nullable|string',
        ]);

        if ($request->hasFile('file')) {
            // $file = $request->file('resource_url');
            // $fileName = time() . '.' . $file->getClientOriginalExtension();
            // $file->move(public_path('educational-resources'), $fileName);
            $fileName = $request->file('file')->storeAS(
                'educational-resources',
                time() . '_' . $request->file('file')->getClientOriginalName(),
                options: 'public'
            );
        } elseif (strpos($request->video_url, 'youtube.com') === false) {
            return redirect()->back()->with('error', 'Invalid YouTube URL');
        } else {
            return redirect()->back()->with('error', 'At least one must be filled in (file or video url)');
        }



        $educationalResource->update([
            'title' => $request->title,
            'description' => $request->description,
            'type' => $request->type,
            'file_path' => $fileName,
            'video_url' => $request->video_url
        ]);

        return redirect()->route('educational-resources.index')->with('success', 'Educational resource updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(EducationalResource $educationalResource)
    {
        $educationalResource->delete();
        return redirect()->route('educational-resources.index')->with('success', 'Educational resource deleted successfully.');
    }

    public function download(EducationalResource $educationalResource)
    {
        return response()->download(public_path($educationalResource->file_path));
    }
}
