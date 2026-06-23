<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserIsAdmin
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        if (!$user || $user->email !== config('auth.admin_email')) {
            abort(403, 'Unauthorized. Admin access required.');
        }

        return $next($request);
    }
}
