<?php

namespace Tests\Feature;

use App\Services\Product\ProductServiceInterface;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProductServicetTest extends TestCase
{
    private ProductServiceInterface $productService;

    public function setUp(): void
    {
        parent::setUp();

        $this->app->make(ProductServiceInterface::class);
    }

    public function test_instantiable_product_service()
    {
        self::assertTrue(true);
    }
}
