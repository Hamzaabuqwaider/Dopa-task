<?php

namespace App\Services\Logging;

use Illuminate\Http\Request;

interface AccessLogServiceInterface
{
    public function logAccessAttempt(Request $request, string $status);
}
