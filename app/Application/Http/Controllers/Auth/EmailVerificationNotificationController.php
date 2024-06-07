<?php

namespace App\Application\Http\Controllers\Auth;

use App\Application\Notifications\VerifyEmailNotification;
use App\Application\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class EmailVerificationNotificationController extends Controller
{
    /**
     * Send a new email verification notification.
     */
    public function store(Request $request): RedirectResponse
    {

        if ($request->user()->hasVerifiedEmail()) {
            return redirect()->intended(route('dashboard', absolute: false));
        }

        $request->user()->notify(new VerifyEmailNotification($request->user()->name));
        ;

        return back()->with('status', 'verification-link-sent');
    }
}
