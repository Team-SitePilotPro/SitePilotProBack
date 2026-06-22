<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    // Verify that the authenticated user's token has one of the required role abilities.
    public function handle(Request $request, Closure $next, string ...$roles): Response
    {
        foreach ($roles as $role) {
            if ($request->user()?->tokenCan($role)) {
                return $next($request);
            }
        }

        return response()->json(
            ['message' => 'Forbidden. Insufficient role.'],
            Response::HTTP_FORBIDDEN
        );
    }
}
