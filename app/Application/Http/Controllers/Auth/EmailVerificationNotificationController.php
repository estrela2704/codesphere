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
        $user = $this->userService->getUserByEmail($request->user()->email);

        if ($this->userService->hasVerifiedEmail($user)) {
            return redirect()->intended(route('dashboard', absolute: false));
        }

        $this->notificationService->sendVerifyEmailNotification($user);
        return back()->with('status', 'verification-link-sent');
    }
}
