<?php

namespace App\Http\Middleware;

use App\Models\GeneratedLinkToken;
use App\Services\Logging\AccessLogServiceInterface;
use Closure;
use Illuminate\Http\Request;

class UsedLinks
{
    protected AccessLogServiceInterface $access_log_service;

    public function __construct(AccessLogServiceInterface $access_log_service)
    {
        $this->access_log_service = $access_log_service;
    }

    public function handle(Request $request, Closure $next)
    {
        $token = $request->route('token');
        $generated_token = GeneratedLinkToken::where('token', $token)->first();

        /** @var GeneratedLinkToken $generated_token */
        if (!$generated_token || $generated_token->used) {
            $this->access_log_service->logAccessAttempt($request, 'used or invalid');
            return response()->json([
                'message' => 'This link has already been used'
            ],403);
        }

        return $next($request);
    }
}
