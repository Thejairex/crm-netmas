<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::all();
        return view('services.index', compact('services'));
    }

    public function create()
    {
        return view('services.create');
    }

    public function store(Request $request)
    {
        // Handle service creation logic here
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'price' => 'required|numeric|min:0',
            'discount' => 'nullable|numeric|min:0|max:100',
        ]);

        $service = Service::create($request->all());


        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);
            $service->image = $imageName;
            $service->save();
        }
        return redirect()->route('services.index')->with('success', 'Service created successfully.');

    }

    public function edit($id)
    {
        return view('services.edit', ['service' => Service::findOrFail($id)]);
    }

    public function update(Request $request, $id)
    {
        // Handle service update logic here
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'price' => 'required|numeric|min:0',
            'discount' => 'nullable|numeric|min:0|max:100',
        ]);

        $service = Service::findOrFail($id);
        $service->update($request->all());

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);
            $service->image = $imageName;
            $service->save();
        }

        return redirect()->route('services.index');
    }

    public function destroy($id)
    {
        Service::findOrFail($id)->delete();
        return redirect()->route('services.index')->with('success', 'Service deleted successfully.');
    }

    public function show($id)
    {
        return view('services.show', ['service' => Service::findOrFail($id)]);
    }


}
