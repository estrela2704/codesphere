<?php

namespace App\Application\Http\Controllers\Auth;

use App\Application\Http\Controllers\Controller;
use App\Domain\Services\NotificationService;
use App\Domain\Services\UserService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class EmailVerificationNotificationController extends Controller
{

    public function __construct(protected UserService $userService, protected NotificationService $notificationService)
    {
    }
    /**
     * Send a new email verification notification.
     */
    public function store(Request $request): RedirectResponse
    {
        if ($this->userService->hasVerifiedEmail($request->user()->email)) {
            return redirect()->intended(route('dashboard', absolute: false));
        }

        $this->notificationService->sendVerifyEmailNotification($request->user()->email);
        return back()->with('status', 'verification-link-sent');
    }
}
