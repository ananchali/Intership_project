<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureAdmin
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        if (!$user || !$user->isAdmin()) {
            abort(403, 'Access denied.');
        }

        // Business owners whose business is not yet approved cannot use the admin panel.
        if ($user->isBusinessOwner()) {
            $business = $user->business;
            if (!$business || !$business->isApproved()) {
                return redirect()->route('home')
                    ->with('error', 'Your business account is awaiting approval by the platform admin. Please check back later.');
            }
        }

        return $next($request);
    }
}
