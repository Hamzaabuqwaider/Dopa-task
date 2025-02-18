<?php

namespace App\Services\Logging;

use App\Models\AccessLog;
use Illuminate\Http\Request;

class AccessLogService implements AccessLogServiceInterface
{
    public function logAccessAttempt(Request $request, string $status): void
    {
        AccessLog::create([
            'token' => $request->route('token'),
            'ip_address' => $request->ip(),
            'status' => $status,
        ]);
    }
}
