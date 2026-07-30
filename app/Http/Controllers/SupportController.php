<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SupportController extends Controller
{
    public function index()
    {
        return view('support');
    }

    public function submit(Request $request)
    {
        $request->validate([
            'subject' => 'required|string',
            'message' => 'required|string|min:10',
        ]);

        // In a real app, you would send an email or save to DB here.
        // For now, we'll just redirect back with success.
        
        return redirect()->route('support')->with('success', 'Thank you! Your message has been sent. Our support team will get back to you shortly.');
    }
}
