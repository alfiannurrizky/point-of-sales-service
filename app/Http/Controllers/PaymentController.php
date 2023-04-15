<?php

namespace App\Http\Controllers;

use App\Http\Requests\PaymentRequest;
use App\Http\Resources\PaymentResource;
use App\Models\Payment;
use App\Services\Payment\PaymentServiceInterface;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    protected $paymentService;

    public function __construct(PaymentServiceInterface $paymentService)
    {
        $this->paymentService = $paymentService;
    }
    public function index()
    {
        $payments = $this->paymentService->getData();

        return new PaymentResource(true, 'List Data Payment', $payments);
    }

    public function store(PaymentRequest $request)
    {
        $payment = $this->paymentService->createData($request->all());

        if($payment)
        {
            return new PaymentResource(true, 'Successfully Add Payment', $payment);
        }

        return new PaymentResource(false, 'Failed To Add Payment', null);
    }

    public function show($id)
    {
        $payment =$this->paymentService->showData($id);

        if($payment)
        {
            return new PaymentResource(true, 'Detail Data Payment', $payment);
        }

        return new PaymentResource(false, 'Data Payment Not Found', null);
    }

    public function update(PaymentRequest $request, Payment $payment)
    {
        $payment = $this->paymentService->updateData($payment,$request->all());

        if($payment)
        {
            return new PaymentResource(true, 'Successfully Updated Payment', $payment);
        }

        return new PaymentResource(false, 'Failed Update Payment', null);
    }

    public function destroy($id)
    {
        $payment = $this->paymentService->deleteData($id);

        if($payment)
        {
            return new PaymentResource(true, 'Successfully Deleted Payment', null);
        }

        return new PaymentResource(false, 'Failed To Delete Payment', null);
    }
}
