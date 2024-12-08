<?php

// app/Http/Services/OrderService.php
namespace App\Services;

use App\Repositories\OrderRepository;
use App\Jobs\SendOrderNotification;


class OrderService
{
    protected $orderRepository;

    public function __construct(OrderRepository $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    public function getAllOrders()
    {
        return $this->orderRepository->all();
    }

    public function getOrderById($id)
    {
        return $this->orderRepository->find($id);
    }

    public function createOrder(array $data)
    {
        $order = $this->orderRepository->create($data);
        $this->sendEmailNotification($order, 'Seu pedido foi criado e está em preparação.');
        return $order;
    }

    public function updateOrder($id, array $data)
    {
        $order = $this->orderRepository->update($id, $data);
        if ($order && $data['status'] == 'preparacao') {
            $this->sendEmailNotification($order, 'Seu pedido está em preparação.');
        } elseif ($order && $data['status'] == 'entrega') {
            $this->sendEmailNotification($order, 'Seu pedido saiu para entrega!');
        }
        return $order;
    }

    public function deleteOrder($id)
    {
        return $this->orderRepository->delete($id);
    }

    protected function sendEmailNotification($order, $message)
    {
        $email = $order->user->email;
        SendOrderNotification::dispatch($email, $order->id, $message);

    }
}
