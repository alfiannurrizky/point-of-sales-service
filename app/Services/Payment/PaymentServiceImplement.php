<?php

namespace App\Services\Payment;
use App\Models\Payment;

class PaymentServiceImplement implements PaymentServiceInterface
{
    public function getData()
    {
        $payment = Payment::latest()->get();

        return $payment;
    }

    public function createData($payload)
    {
        $payment = new Payment;

        $payment->name = $payload['name'];
        $payment->type = $payload['type'];

        $payment->saveOrFail();

        return $payment;
    }

    public function showData(int $id)
    {
        $payment = Payment::whereId($id)->first();

        return $payment;
    }

    public function updateData(Payment $payment, $payload)
    {
        $payment->name = $payload['name'] ?? $payload->name;
        $payment->type = $payload['type'] ?? $payload->type;

        $payment->saveOrFail();

        return $payment;
    }

    public function deleteData(int $id)
    {
        $payment = Payment::find($id);

        $payment->delete();

        return $payment;
    }
}