<?php

namespace App\Application\Http\Controllers\Auth;

use App\Application\Http\Controllers\Controller;
use App\Domain\Services\NotificationService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;


class PasswordResetLinkController extends Controller
{

    public function __construct(protected NotificationService $notificationService)
    {
    }
    /**
     * Display the password reset link request view.
     */
    public function create(): View
    {
        return view('auth.forgot-password');
    }

    /**
     * Handle an incoming password reset link request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => ['required', 'email'],
        ]);

        $status = $this->notificationService->sendResetPasswordNotification($request->email);

        return $status["feedback"] == "sent"
            ? back()->with('status', __($status['msg']))
            : back()->withInput($request->only('email'))
                ->withErrors(['email' => __($status['msg'])]);

    }
}
