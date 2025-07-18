<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Broadcasting\PrivateChannel;

class ComplaintStatusChanged extends Notification implements ShouldBroadcast
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(
        protected $complaint,
        protected $oldStatus,
        protected $newStatus
    )
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database' , 'broadcast'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->line('The introduction to the notification.')
            ->action('Notification Action', url('/'))
            ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'complaint_id' => $this->complaint->id,
            'tittle' => $this->complaint->title,
            'old_status' => $this->oldStatus,
            'new_status' => $this->newStatus,
            'message' => "Status Aduan '{$this->complaint->title}' berubah dari
             '{$this->oldStatus}' menjadi '{$this->newStatus}' "
        ];
    }

              public function broadcastOn()
                {
                    return new PrivateChannel('notifications.' . $this->complaint->resident->user->id);
                }

                public function broadcastWith()
                {
                    return [
                        'message' => "Status Aduan '{$this->complaint->title}' berubah dari '{$this->oldStatus}' menjadi '{$this->newStatus}'",
                        'created_at' => now()->diffForHumans()
                    ];
                }


}
