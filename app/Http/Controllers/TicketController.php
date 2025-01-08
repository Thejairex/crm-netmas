<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class TicketController extends Controller
{
    public function index()
    {
        $response = Http::get('https://app.ticketmaster.com/discovery/v2/events.json', [
            'apikey' => config('services.ticketmaster.access_token'),
            'countryCode' => 'MX',
        ]);
        $events = $response->json();
        // dd($events);
        return view('events.index', compact('events'));
    }


}
