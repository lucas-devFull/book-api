<?php

/// app/Http/Repositories/OrderRepository.php
namespace App\Repositories;

use App\Models\Order;
use Illuminate\Database\Eloquent\Collection;

class OrderRepository
{
    public function all(): Collection
    {
        return Order::with('books')->get();
    }

    public function find($id): ?Order
    {
        return Order::with('books')->find($id);
    }

    public function create(array $data): Order
    {
        return Order::create($data);
    }

    public function update($id, array $data): ?Order
    {
        $order = $this->find($id);
        if ($order) {
            $order->update($data);
            return $order;
        }
        return null;
    }

    public function delete($id): bool
    {
        $order = $this->find($id);
        if ($order) {
            return $order->delete();
        }
        return false;
    }
}
