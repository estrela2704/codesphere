<?php

namespace App\Application\Http\Controllers\Auth;

use App\Application\Http\Controllers\Controller;
use App\Domain\Services\UserService;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\RedirectResponse;

class VerifyEmailController extends Controller
{
    public function __construct(protected UserService $userService)
    {
    }
    /**
     * Mark the authenticated user's email address as verified.
     */
    public function __invoke(EmailVerificationRequest $request): RedirectResponse
    {
        if ($this->userService->hasVerifiedEmail($request->user()->email)) {
            return redirect()->intended(route('dashboard', absolute: false) . '?verified=1');
        }

        $this->userService->markHasVerified($request->user()->email);

        return redirect()->intended(route('dashboard', absolute: false) . '?verified=1');
    }
}
