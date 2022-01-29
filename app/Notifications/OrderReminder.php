<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class OrderReminder extends Notification implements ShouldQueue
{
    use Queueable;

    public $name;
    public function __construct($name)
    {
        $this->name = $name;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        $name = $this->name;
        return (new MailMessage)->view('notifications.order_reminder', compact('name'));
    }

    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
