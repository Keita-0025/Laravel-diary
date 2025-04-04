<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\URL;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;


class CustomVerifyEmail extends Notification
{
    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        // Log::info('Notifiable Data:', $notifiable->toArray()); //ログ確認用

        $verificationUrl = $this->verificationUrl($notifiable);

        return (new MailMessage)
            ->subject('メールアドレスの確認')
            ->greeting('こんにちは、' . ($notifiable->name ?? 'ゲスト') . 'さん')
            ->line('以下のボタンをクリックして、メールアドレスの確認を完了してください。')
            ->action('メールアドレスを確認', $verificationUrl)
            ->line('このメールに心当たりがない場合は、このメッセージを無視してください。');
    }

    protected function verificationUrl($notifiable)
    {
        return URL::temporarySignedRoute(
            'verification.verify',
            Carbon::now()->addMinutes(60),
            [
                'id' => $notifiable->getKey(),
                'hash' => sha1($notifiable->getEmailForVerification()),
            ]
        );
    }
}
