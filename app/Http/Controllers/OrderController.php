<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderRequest;
use App\Http\Resources\OrderResource;
use Illuminate\Support\Facades\DB;
use App\Models\Order;
use App\Services\Order\OrderServiceInterface;
use App\Services\Payment\PaymentServiceInterface;
use App\Services\Product\ProductServiceInterface;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    protected $orderService;

    public function __construct(OrderServiceInterface $orderService)
    {
        $this->orderService = $orderService;
    }

    public function index()
    {
        $orders = $this->orderService->getData();

        return new OrderResource(true, 'List Data Orders', $orders);
    }

    public function store(OrderRequest $request, ProductServiceInterface $productService, PaymentServiceInterface $payment)
    {
        $user = auth()->user();
        $product = $productService->showData($request->input('product_id'));
        $payment = $payment->showData($request->input('payment_id'));

        $order = $this->orderService->createData([
            'user_id' => $user->id,
            'product_id' => $product->id,
            'payment_id' => $payment->id,
            'status' => 'unpaid',
            'price' => $product->price,
            'qty' => $request->input('qty'),
            'total' => ($product->price * $request->input('qty')),
            'total_paid' => $request->input('total_paid'),
            'total_return' => 0
        ]);
    
        $this->orderService->process($order);

        return new OrderResource(true, 'Success', $order);
    }

    public function show($id)
    {
        $order = $this->orderService->showData($id);

        if($order)
        {
            return new OrderResource(true, 'Detail Data Order', $order);
        }

        return new OrderResource(false, 'Data Order Not Found', null);
    }
}
