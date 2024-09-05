<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class MockNetid
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($uwnetid = config('auth.mock_netid')) {
            $user = User::where('uwnetid', $uwnetid)->first();

            if (!$user) {
                abort(403, 'Your UWNetID could not be authenticated.');
            }

            Auth::login($user);
        }

        return $next($request);
    }
}
