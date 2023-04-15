<?php

namespace App\Services\Payment;
use App\Models\Payment;

interface PaymentServiceInterface
{
    public function getData();

    public function createData($payload);

    public function showData(int $id);

    public function updateData(Payment $payment, $payload);

    public function deleteData(int $id);
}