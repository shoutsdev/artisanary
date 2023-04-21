<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PermissionMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->check())
        {
            $role = auth()->user()->role;
            $permissions = collect($role->permissions);

            if (".create" == substr($request->route()->getName(), -7)) {
                if ($permissions->contains(str_replace(".create", ".store", $request->route()->getName()))) {
                    return $next($request);
                } else {
                    abort(403);
                }
            }

            if (".update" == substr($request->route()->getName(), -7)) {
                if ($permissions->contains(str_replace(".update", ".edit", $request->route()->getName()))) {
                    return $next($request);
                } else {
                    abort(403);
                }
            } else {

                if ($permissions->contains($request->route()->getName())) {
                    return $next($request);
                } else {
                    abort(403);
                }
            }
        }
        abort(403);
    }
}
