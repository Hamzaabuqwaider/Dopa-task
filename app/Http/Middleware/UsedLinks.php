<?php

namespace App\Http\Middleware;

use App\Models\GeneratedLinkToken;
use App\Traits\LogsAccessAttempts;
use Closure;
use Illuminate\Http\Request;

class UsedLinks
{
    use LogsAccessAttempts;
    /**
     * Handle an incoming request.
     *
     * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response) $next
     */
    public function handle(Request $request, Closure $next)
    {
        $token = $request->route('token');
        $generated_token = GeneratedLinkToken::where('token', $token)->first();

        /** @var GeneratedLinkToken $generated_token */
        if (!$generated_token || $generated_token->used) {
            $this->logAccessAttempt($request, 'used or invalid');
            return response()->json([
                'message' => 'This link has already been used'
            ],403);
        }

        return $next($request);
    }
}
