<?php

namespace App\Application\Http\Controllers\Auth;

use App\Events\UserRegistred;
use App\Application\Http\Controllers\Controller;
use App\Application\Http\Requests\RegisterUserRequest;
use App\Domain\Services\UserService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

use Illuminate\View\View;

class RegisteredUserController extends Controller
{

    public function __construct(protected UserService $userService)
    {
    }
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(RegisterUserRequest $request): RedirectResponse
    {
        $user = $this->userService->create($request->validated());
        event(new UserRegistred($user->email));
        Auth::login($user);
        return redirect(route('dashboard', absolute: false));
    }
}
