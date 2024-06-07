<?php

namespace App\Application\Http\Controllers\Auth;

use App\Application\Http\Controllers\Controller;
use App\Domain\Services\NotificationService;
use App\Domain\Services\UserService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;


class PasswordResetLinkController extends Controller
{

    public function __construct(protected UserService $userService, protected NotificationService $notificationService)
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

        $status = [];
        $user = $this->userService->getUserByEmail($request->email);
        if ($user) {
            $this->notificationService->sendResetPasswordNotification($user->email);
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
