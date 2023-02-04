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
            ->subject('تم اضافة فاتورة جديدة')
            ->greeting('مرحبا ' . $notifiable->name . ',')
            ->line('لقد قمت باضافة فاتورة جديدة بنجاح')
            ->line('رقم الفاتورة: #' . $this->invoice->invoice_number)
            ->line('اجمالي الفاتورة: ' . $this->invoice->total)
            ->action('عرض الفاتورة',url('/invoices/'.$this->invoice->id))
            ->line('شكرا لاستخدامك نظام محمد العجل')
            ->salutation('أطيب التحيات,');
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
