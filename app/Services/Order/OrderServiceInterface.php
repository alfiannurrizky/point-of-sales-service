<?php

namespace App\Services\Order;
use App\Models\Order;
use App\Models\Product;

interface OrderServiceInterface
{
    public function getData();

    public function createData($payload);

    public function process(Order $order);
    
    public function reduceStock(Order $order);

    public function showData(int $id);

    public function updateData();

    public function deleteData();
}