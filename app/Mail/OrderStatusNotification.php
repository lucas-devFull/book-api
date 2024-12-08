<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderStatusNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $orderId;
    public $status;

    public function __construct($orderId, $status)
    {
        var_dump('aqui');

        $this->orderId = $orderId;
        $this->status = $status;
    }

    public function build()
    {
        var_dump('aqui');
        return $this->subject("Atualização do Pedido #{$this->orderId}")
                    ->view('emails.order_status_notification')
                    ->with([
                        'orderId' => $this->orderId,
                        'status' => $this->status,
                    ]);
    }
}
