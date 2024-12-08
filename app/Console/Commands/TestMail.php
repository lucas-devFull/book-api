<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Mail\OrderStatusNotification;
use Illuminate\Support\Facades\Mail;

class TestMail extends Command
{
    protected $signature = 'mail:test {email}';
    protected $description = 'Testa o envio de e-mails';

    public function handle()
    {
        $email = $this->argument('email');

        try {
            Mail::to($email)->send(new OrderStatusNotification(1, 'Teste'));
            $this->info("E-mail enviado para {$email}");
        } catch (\Exception $e) {
            $this->error("Erro ao enviar e-mail: " . $e->getMessage());
        }
    }
}
