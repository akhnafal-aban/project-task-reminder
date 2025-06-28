<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use App\Enums\UserRole;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

final class RoleMiddleware
{
    public function handle(Request $request, Closure $next, string $role): Response
    {
        $user = $request->user();
        if (!$user || !$user->role instanceof UserRole) {
            abort(403, 'Unauthorized.');
        }

        if ($role === UserRole::ADMIN->value && !$user->isAdmin()) {
            abort(403, 'Admin only.');
        }
        if ($role === UserRole::MEMBER->value && !$user->isMember()) {
            abort(403, 'Member only.');
        }

        return $next($request);
    }
} 