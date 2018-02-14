<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class ScoreUpdated extends Notification
{
    use Queueable;

    public $pontuacao;
    
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct( $pontuacao )
    {
        $this->pontuacao = $pontuacao;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database', 'broadcast'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'processo' => $this->pontuacao->processo->nome,
            'pontos' => $this->pontuacao->pontos,
            'data' => $this->pontuacao->created_at
        ];
    }
    
    public function toBroadcast($notifiable) {
        return new \Illuminate\Notifications\Messages\BroadcastMessage([
            'processo' => $this->pontuacao->processo->nome,
            'pontos' => $this->pontuacao->pontos,
            'data' => $this->pontuacao->created_at
        ]);
    }
}
