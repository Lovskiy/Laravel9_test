<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;

class ApiClient
{
    public function handle(Request $request, Closure $next)
    {
        $user = User::where('role_id', '=', 2)->first();
        if (!$user) {
            return response()->json(
                [
                    'data' => [
                        'code' => 403,
                        'errors' => 'Forbidden for you'
                    ]
                ], 403
            );
        }
        return $next($request);
    }
}
