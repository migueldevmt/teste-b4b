<?php

namespace App\Notifications;

use App\DataTransferObject\WeatherDTO;
use App\Events\ActionExecuted;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewWeatherInfo extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(protected WeatherDTO $weatherDTO)
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via(User $notifiable)
    {
        $actionName = get_class($this);

        ActionExecuted::dispatch("$notifiable->name notified with $actionName");

        return ['mail'];
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
            ->subject('Novas informações sobre o tempo')
            ->line("Hoje a temperatura está {$this->weatherDTO->temperature}º com máxima de {$this->weatherDTO->temperatureMax}º");
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
            //
        ];
    }
}