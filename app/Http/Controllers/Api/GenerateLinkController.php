<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Jobs\SendGeneratedLinkMailJob;
use App\Models\GeneratedLinkToken;
use App\Services\Logging\AccessLogServiceInterface;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;

class GenerateLinkController extends Controller
{
    protected AccessLogServiceInterface $access_log_service;

    public function __construct(AccessLogServiceInterface $access_log_service)
    {
        $this->access_log_service = $access_log_service;
    }

    public function generateLink()
    {
        $token = Str::random(20);

        GeneratedLinkToken::create([
            GeneratedLinkToken::TOKEN => $token,
            GeneratedLinkToken::EXPIRES_AT=> now()->addMinutes(10),
            GeneratedLinkToken::USED => false,
        ]);

        $signed_url = URL::signedRoute('secure.content', ['token' => $token]);

        // I have added this configuration in config/mail.php. By default, it is set to true to allow sending URLs via email.
        // You can use any mail driver, but for testing purposes, I am using Mailtrap.
        if (config('mail.can_send_email')) {
            SendGeneratedLinkMailJob::dispatch($signed_url, 'example@mail.com');
        }

        return response()->json([
            'message' => 'link generated successfully',
            'url' => $signed_url,
        ]);
    }

    public function validateSignedLink(Request $request)
    {
        if (!$request->hasValidSignature()) {
            $this->access_log_service->logAccessAttempt($request, 'tampered');
            return response()->json([
                'message' => 'tampered or invalid link'], 403);
        }

        $generated_token = GeneratedLinkToken::where(GeneratedLinkToken::TOKEN, $request['token'])->first();

        if (!$generated_token) {
            $this->access_log_service->logAccessAttempt($request, 'invalid');
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        /** @var GeneratedLinkToken $generated_token */
        if (Carbon::parse($generated_token->expires_at)->timestamp <= now()->timestamp) {
            $this->access_log_service->logAccessAttempt($request, 'expired');
            return response()->json([
                'message' => 'This link has expired'
            ], 403);
        }

        $generated_token->update(['used' => true]);

        return response()->json([
            'message' => 'Access Granted',
            'data' => 'Some secure content',
        ]);
    }
}
