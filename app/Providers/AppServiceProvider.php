<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Notifications\Messages\MailMessage;
use DB;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        DB::statement("SET time_zone = '+07:00'");
        // ResetPassword::toMailUsing(function (User $user, string $token) {
        //     $url = url(route('reset.password.get', [
        //         'token' => $token,
        //         'email' => $user->getEmailForPasswordReset(),
        //     ], false));

        //     return (new MailMessage)
        //         ->subject(config('app.name') . ': ' . __('Reset Password Request'))
        //         ->greeting(__('Hello!'))
        //         ->line(__('You are receiving this email because we received a password reset request for your account.'))
        //         ->action(__('Reset Password'), $url)
        //         ->line(__('This password reset link will expire in :count minutes.', ['count' => config('auth.passwords.' . config('auth.defaults.passwords') . '.expire')]))
        //         ->line(__('If you did not request a password reset, no further action is required.'))
        //         ->salutation(__('Regards,') . "\n" . config('app.name') . " Team");
        // });
    }
}
