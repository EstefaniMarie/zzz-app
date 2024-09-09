<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ResetPasswordNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected $token;

    public function __construct($token)
    {
        $this->token = $token;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Restablecer Contraseña')
            ->greeting('Hola, ')
            ->line('Se ha solicitado restablecer la contraseña de tu cuenta.')
            ->action('Restablecer Contraseña', url('/reset-password/' . $this->token))
            ->line('Si no solicitaste restablecer la contraseña, ignora este mensaje.')
            ->salutation('Atentamente, ' . config('app.name'));
    }
}
