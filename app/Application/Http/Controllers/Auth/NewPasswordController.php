<?php

namespace App\Application\Http\Controllers\Auth;

use App\Application\Http\Controllers\Controller;
use App\Domain\Services\PasswordResetService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class NewPasswordController extends Controller
{

    public function __construct(protected PasswordResetService $passwordResetService)
    {

    }
    /**
     * 
     * Display the password reset view.
     */
    public function create(Request $request): View
    {
        return view('auth.reset-password', ['request' => $request]);
    }

    /**
     * Handle an incoming new password request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'token' => ['required'],
            'email' => ['required', 'email'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $status = $this->passwordResetService->validateResetToken($request->only('email', 'password', 'token'));

        return $status['feedback'] == 'success'
            ? redirect()->route('login')->with('status', __($status['msg']))
            : back()->withInput($request->only('email'))
                ->withErrors(['email' => __($status['msg'])]);
    }
}
