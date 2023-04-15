<?php

namespace Tests\Feature;

use App\Services\Category\CategoryServiceInterface;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CategoryServiceTest extends TestCase
{
    private CategoryServiceInterface $categoryService;

    public function setUp(): void
    {
        parent::setUp();

        $this->app->make(CategoryServiceInterface::class);
    }

    public function test_instantiable_service_provider()
    {
        self::assertTrue(true);
    }
}
