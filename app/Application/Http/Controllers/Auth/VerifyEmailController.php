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
        $user = $this->userService->getUserByEmail($request->user()->email);
        if ($this->userService->hasVerifiedEmail($user)) {
            return redirect()->intended(route('dashboard', absolute: false) . '?verified=1');
        }

        $this->userService->markHasVerified($user);

        return redirect()->intended(route('dashboard', absolute: false) . '?verified=1');
    }
}
