<?php

namespace App\Infra\Providers;

use App\Domain\Repositories\IPasswordResetTokenRepository;
use App\Domain\Repositories\IUserRepository;
use App\Domain\Services\NotificationService;
use App\Domain\Services\PasswordResetService;
use App\Infra\Repositories\PasswordResetTokenRepositoryEloquent;
use App\Infra\Repositories\UserRepositoryEloquent;
use Illuminate\Support\ServiceProvider;
use App\Domain\Services\UserService;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {

        $this->app->singleton(UserService::class);

        $this->app->singleton(PasswordResetService::class, function ($app) {
            return new PasswordResetService(
                $app->make(UserService::class),
                $app->make(IPasswordResetTokenRepository::class)
            );
        });

        $this->app->singleton(NotificationService::class, function ($app) {
            return new NotificationService(
                $app->make(PasswordResetService::class),
                $app->make(UserService::class)
            );
        });

        $this->app->bind(IUserRepository::class, UserRepositoryEloquent::class);
        $this->app->bind(IPasswordResetTokenRepository::class, PasswordResetTokenRepositoryEloquent::class);

    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
