<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Mail\OrderStatusNotification;
use Illuminate\Support\Facades\Mail;

class SendOrderNotification implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $email;
    protected $orderId;
    protected $status;

    public function __construct($email, $orderId, $status)
    {
        $this->email = $email;
        $this->orderId = $orderId;
        $this->status = $status;
    }

    public function handle()
    {
        try {
            \Log::info("Iniciando envio de e-mail para {$this->email} com status {$this->status} para pedido #{$this->orderId}");

            Mail::to($this->email)->send(new OrderStatusNotification($this->orderId, $this->status));

            \Log::info("E-mail enviado com sucesso para {$this->email}");
        } catch (\Exception $e) {
            \Log::error("Falha ao enviar e-mail: " . $e->getMessage(), [
                'email' => $this->email,
                'orderId' => $this->orderId,
                'status' => $this->status,
            ]);

            throw $e; // Repassa a exceção para marcar o job como falho
        }
    }
}
