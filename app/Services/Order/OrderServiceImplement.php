<?php

namespace App\Services\Order;

use App\Models\Order;
use App\Services\Product\ProductServiceInterface;

class OrderServiceImplement implements OrderServiceInterface
{
    protected $productService;

    public function __construct(ProductServiceInterface $productService)
    {
        $this->productService = $productService;
    }

    public function getData()
    {
        $orders = Order::with('product', 'payment')->latest()->paginate(5);

        return $orders;
    }

    public function createData($payload)
    {
        $order = Order::create($payload);

        return $order;
    }

    public function process(Order $order)
    {
            if($order->status == 'failed')
            {
                return;
            }

            if($order->total_paid > $order->total)
            {
                $order->total_return = $order->total_paid - $order->total;
                $order->status = 'paid';
            }

            if($order->total_paid < $order->total)
            {
                $order->status = 'failed';
    
            }
            $this->reduceStock($order);
    
            $order->saveOrFail();
    }

    public function reduceStock(Order $order)
    {
       $product = $order->product;
       
       $this->productService->reduceStock($product, $order->qty);
    }

    public function showData(int $id)
    {
        return Order::find($id);
    }

    public function updateData()
    {

    }
    
    public function deleteData()
    {

    }
}