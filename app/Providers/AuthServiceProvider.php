<?php

namespace App\Providers;

use App\Models\User;
use Filament\Http\Responses\Auth\Contracts\LogoutResponse as LogoutResponseContract;
use Filament\Http\Responses\Auth\LogoutResponse;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Auth;
use UWCoE\Login\Concerns\ProvidesLoginHandlers;

class AuthServiceProvider extends ServiceProvider
{
    use ProvidesLoginHandlers;

    /**
     * The default redirect path after login.
     */
    public const LOGIN_REDIRECT = 'admin';

    /**
     * The default redirect path after logout.
     */
    public const LOGOUT_REDIRECT = '/';

    /**
     * Perform the logout response for filament. Perhaps we could use this
     * method for the whole login system instead of predefined methods.
     */
    public function register(): void
    {
        $this->app->bind(LogoutResponseContract::class, LogoutResponse::class);
    }

    /**
     * Manage an incoming login request. The $params
     * array will include netid login details.
     */
    public function handleLogin(array $params): mixed
    {
        $uwnetid = $params['uwnetid'];

        if ($user = User::where('uwnetid', $uwnetid)->first()) {
            Auth::login($user);
            return redirect(self::LOGIN_REDIRECT);
        }

        abort(403, 'Your UWNetID could not be authenticated.');
    }

    /**
     * Manage an incoming logout request.
     */
    public function handleLogout(): mixed
    {
        Auth::logout();
        return redirect(self::LOGOUT_REDIRECT);
    }
}
