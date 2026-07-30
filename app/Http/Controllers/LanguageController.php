<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LanguageController extends Controller
{
    public function switch(Request $request)
    {
        $locale = $request->input('locale');
        
        // Validate locale
        $supportedLocales = ['en', 'am', 'om', 'so'];
        if (!in_array($locale, $supportedLocales)) {
            $locale = 'en';
        }
        
        $request->session()->put('locale', $locale);
        
        if ($request->wantsJson()) {
            return response()->json(['success' => true]);
        }
        
        return redirect()->back();
    }
}
