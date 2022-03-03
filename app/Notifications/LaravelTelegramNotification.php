<?php
/* 
namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class LaravelTelegramNotification extends Notification
{
    use Queueable;


    public function __construct()
    {
        //
    }


    public function via($notifiable)
    {
        return ['mail'];
    }


    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
    }


    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
} */



namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use TelegramNotifications\Messages\TelegramCollection;
use TelegramNotifications\Messages\TelegramMessage;
use TelegramNotifications\TelegramChannel;


class LaravelTelegramNotification extends Notification
{
    use Queueable;

    protected $data;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(array $arr)
    {
        $this->data = $arr;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return [TelegramChannel::class];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */


    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }

    public function toTelegram() {
        return (new TelegramCollection())
            
            ->message(['text' => $this->data['text']]);
            //->location(['latitude' => $this->data['latitude'], 'longitude' => $this->data['longitude']])
            //->photo(['photo' => $this->data['photo'], 'caption' => $this->data['photo_caption']]);
    }
}

