<?php

namespace App\Http\Controllers;

use App\Models\SupportTicket;
use Illuminate\Http\Request;

class SupportTicketController extends Controller
{
    /**
     * list all support tickets for the admin panel
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        $tickets = SupportTicket::all();
        return view('support.index', compact('tickets'));
    }

    public function create()
    {

        return view('support.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'subject' => 'required|string',
            'description' => 'required|string',
            'category' => 'required|string',
        ]);

        SupportTicket::create([
            'user_id' => auth()->user()->id,
            'subject' => $request->subject,
            'description' => $request->description,
            'category' => $request->category,
            'status' => 'pending',
        ]);

        return redirect()->route('support.create')->with('success', 'Support ticket created successfully.');
    }

    public function show($id)
    {
        $ticket = SupportTicket::findOrFail($id);

        return view('support.show', compact('ticket'));
    }

    public function update(Request $request, $id){
        $ticket = SupportTicket::findOrFail($id);

        $validatedData = $request->validate([
            'status' => 'nullable|string',
        ]);
        if ($validatedData['status'] == 'closed') {
            $ticket->status = 'closed';
            $ticket->save();
            return redirect()->route('support.index')->with('success', 'Support ticket closed successfully.');
        }

        $ticket->assigned_to = auth()->user()->id;
        $ticket->status = 'assigned';
        $ticket->save();

        return redirect()->route('support.index')->with('success', 'Support ticket updated successfully.');
    }

    public function assign($id){
        $ticket = SupportTicket::findOrFail($id);


        return redirect()->route('support.index')->with('success', 'Support ticket assigned successfully.');
    }

    public function destroy($id){
        $ticket = SupportTicket::findOrFail($id);
        $ticket->delete();

        return redirect()->route('support.index')->with('success', 'Support ticket deleted successfully.');
    }
}
