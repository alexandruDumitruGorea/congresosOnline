<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use Illuminate\Auth\Notifications\VerifyEmail;

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
        // Este va a ser quien envie correo cuando te registres
        VerifyEmail::toMailUsing(function ($notifiable, $url) {
            if ($notifiable->id_privilege == 2) {
                $mail = new \App\Mail\OrganizatorEmail($notifiable);
            } else if ($notifiable->id_privilege == 3) {
                $mail = new \App\Mail\SpeakerEmail($notifiable);
            } else {
                $mail = new \App\Mail\VerifyEmail($notifiable, $url);
            }
            return $mail;
        });

        \Illuminate\Auth\Notifications\ResetPassword::toMailUsing(function ($notifiable, $token) {
            $mail = new \App\Mail\EmailReset($notifiable, url(route('password.reset', $token)));
            return $mail;
        });
    }
}
