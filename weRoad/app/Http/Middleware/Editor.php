<?php

namespace App\Http\Middleware;

use App\Enums\UserRole;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Editor
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth()->user()) {
            if (Auth()->user()->role instanceof UserRole && Auth()->user()->role == UserRole::EDITOR) {
                return $next($request);
            } else if (is_int(Auth()->user()->role && Auth()->user()->role == UserRole::EDITOR->value)) {
                return $next($request);
            }
        }

        abort(403);
    }
}
