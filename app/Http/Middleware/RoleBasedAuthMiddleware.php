<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleBasedAuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string $role): Response
    {
        /** @var \App\Models\Account $user * */
        $user = auth()->user();
        $roles = explode('|', $role);

        if (! in_array($user->role(), $roles)) {
            abort(403);
        }

        return $next($request);
    }
}
