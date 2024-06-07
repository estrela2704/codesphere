<?php

namespace App\Application\Http\Controllers\Auth;

use App\Application\Http\Controllers\Controller;
use App\Domain\Services\UserService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class EmailVerificationPromptController extends Controller
{
    public function __construct(protected UserService $userService)
    {
    }
    /**
     * Display the email verification prompt.
     */
    public function __invoke(Request $request): RedirectResponse|View
    {
        return $this->userService->hasVerifiedEmail($request->user()->email)
            ? redirect()->intended(route('dashboard', absolute: false))
            : view('auth.verify-email');
    }
}
