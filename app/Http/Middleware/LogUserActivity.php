<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\ActivityLog;
use Illuminate\Support\Facades\Auth;

class LogUserActivity
{
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);

        if (Auth::check()) {
            ActivityLog::create([
                'user_id'      => Auth::id(),
                'action'       => $request->method().' '.$request->path(),
                'subject_type' => null,
                'subject_id'   => null,
                'ip_address'   => $request->ip(),
            ]);
        }

        return $response;
    }
}
