<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ResetPasswordNotification extends Notification
{
    use Queueable;

    /**
     * The password reset token.
     *
     * @var string
     */
    public $token;

    /**
     * Create a new notification instance.
     */
    public function __construct($token)
    {
        $this->token = $token;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via($notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail($notifiable): MailMessage
    {
        $url = route('password.reset', [
            'token' => $this->token,
            'email' => $notifiable->getEmailForPasswordReset(),
        ]);

        return (new MailMessage)
            ->subject('Atur Ulang Kata Sandi Aksaraloka')
            ->greeting('Halo, ' . $notifiable->username . '!')
            ->line('Kami menerima permintaan untuk mengatur ulang kata sandi akun Aksaraloka Anda.')
            ->action('Atur Ulang Kata Sandi', $url)
            ->line('Tautan pengaturan ulang kata sandi ini akan kedaluwarsa dalam 60 menit.')
            ->line('Jika Anda tidak meminta pengaturan ulang kata sandi, abaikan saja email ini.')
            ->salutation('Salam hangat,' . "\n" . 'Tim Aksaraloka');
    }
}

