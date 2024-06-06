<?php

namespace App\Http\Controllers\Auth;

use App\Notifications\ResetPasswordNotification;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\View\View;
use App\Models\User;

class PasswordResetLinkController extends Controller
{
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

        $status = [];
        $user = User::where('email', $request->email)->first();
        if ($user) {
            $user->notify(new ResetPasswordNotification());
            $status = ["feedback" => 'sent', "msg" => 'Enviamos o link para redefinir sua senha por e-mail.'];
        } else {
            $status = ["feedback" => 'error', "msg" => 'Não conseguimos encontrar um usuário com esse endereço de e-mail.'];
        }

        return $status["feedback"] == "sent"
            ? back()->with('status', __($status['msg']))
            : back()->withInput($request->only('email'))
                ->withErrors(['email' => __($status['msg'])]);

    }
}
