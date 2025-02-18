<?php
namespace App\Traits;

use App\Models\AccessLog;
use Illuminate\Http\Request;

trait LogsAccessAttempts
{
    public function logAccessAttempt(Request $request, string $status)
    {
        AccessLog::create([
            'token' => $request->route('token'),
            'ip_address' => $request->ip(),
            'status' => $status,
        ]);
    }
}
