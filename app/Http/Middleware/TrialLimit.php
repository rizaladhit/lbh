<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TrialLimit
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();
        $limit = intval(config('trial.limit'));

        if (! $user || $limit <= 0) {
            return $next($request);
        }

        if ($request->method() === 'POST') {
            if ($user->trial_count >= $limit) {
                if ($request->wantsJson()) {
                    return response()->json(['message' => 'Trial limit reached'], 403);
                }

                return redirect()->route('trial.limit')->with('error', 'Batas trial sudah tercapai.');
            }
        }

        $response = $next($request);

        if ($request->method() === 'POST' && $response->getStatusCode() < 400) {
            try {
                $user->increment('trial_count');
            } catch (\Exception $e) {
                // don't break the request if increment fails
            }
        }

        return $response;
    }
}
