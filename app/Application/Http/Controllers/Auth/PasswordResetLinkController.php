<?php

namespace App\Application\Http\Controllers\Auth;

use App\Application\Notifications\ResetPasswordNotification;
use App\Application\Http\Controllers\Controller;
use App\Infra\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Carbon\Carbon;


class PasswordResetLinkController extends Controller
{
    private static function generateResetToken(User $user)
    {

        $user = DB::table('users')->where('email', $user->email)->first();

        if (!$user) {
            return response()->json(['message' => 'Email not found.'], 404);
        }

        // Cria um token
        $token = Str::random(60);

        // Remove tokens antigos
        DB::table('password_reset_tokens')->where('email', $user->email)->delete();

        // Insere o novo token na tabela `password_resets`
        DB::table('password_reset_tokens')->insert([
            'email' => $user->email,
            'token' => bcrypt($token),
            'created_at' => Carbon::now()
        ]);

        return $token;
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
        $user = User::where('email', $request->email)->first();
        if ($user) {
            $token = self::generateResetToken($user);
            $user->notify(new ResetPasswordNotification($token));
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
