<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewInvoice extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(private $invoice)
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
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
            ->subject(__('success_messages.invoice.add.message.subject'))
            ->greeting(__('success_messages.invoice.add.message.greeting') . $notifiable->name . ',')
            ->line(__('success_messages.invoice.add.message.line'))
            ->line(__('success_messages.invoice.add.message.line.invoice_number') . $this->invoice->invoice_number)
            ->line(__('success_messages.invoice.add.message.line.collection_amount') . $this->invoice->total)
            ->action(__('success_messages.invoice.add.message.line.display'),url('/invoices/'.$this->invoice->id))
            ->line(__('success_messages.invoice.add.message.line.thinks'))
            ->salutation(__('success_messages.invoice.add.message.line.salutation'));
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
