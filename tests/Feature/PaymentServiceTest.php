<?php

namespace Tests\Feature;

use App\Services\Payment\PaymentServiceInterface;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PaymentServiceTest extends TestCase
{
    private PaymentServiceInterface $paymentService;

    public function setUp(): void
    {
        parent::setUp();

        $this->app->make(PaymentServiceInterface::class);
    }

    public function test_instantiable_service()
    {
        self::assertTrue(true);
    }
}
