<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class ProductTest extends TestCase
{
    use RefreshDatabase;

    private User $user;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = $this->createUser();
    }

    public function test_show_products()
    {
        $response = $this->actingAs($this->user)->getJson('/api/products');

        $response->assertStatus(200);
    }

    public function test_unauthenticated_user_to_access_products()
    {
        $response = $this->getJson('/api/products');

        $response->assertStatus(401);
    }

    public function test_create_product()
    {
        $this->withoutMiddleware();

        Category::factory()->create();

        Storage::fake('public');

        $image = UploadedFile::fake()->image('test.jpg');

        $product = [
            'category_id' => 1,
            'name' => 'pizza',
            'stock' => 2,
            'price' => 10000,
            'image' => $image
        ];

        $response = $this->actingAs($this->user)->postJson('/api/products',$product);

        $response->assertStatus(201);
    }

    public function test_create_invalid_image_extension()
    {
        $this->withoutMiddleware();

        $image = UploadedFile::fake()->create('test.pdf');

        $response = $this->actingAs($this->user)->postJson('/api/products', [
            'category_id' => 1,
            'name' => "Marshall",
            'stock' => 2,
            'price' => 10000,
            'image' => $image
        ]);

        $response->assertStatus(422);

        $response->assertJsonValidationErrors(['image']);

        $this->assertStringContainsString('The image field must be a file of type: jpeg, png, jpg.', $response->getContent());
    }

    public function test_create_product_failed_required()
    {
        $this->withoutMiddleware();

        $response = $this->actingAs($this->user)->postJson("/api/products", [
            'category_id' => 1,
            'name' => 'pizza',
            'stock' => 2,
            'price' => 10000,
            'image' => ''
        ]);

        $response->assertStatus(422);

        $response->assertInvalid(['image']);

        $response->assertJson([
            'message' => 'The image field is required.',
        ]);
    }

    public function test_non_admin_cannot_create_product()
    {
        Category::factory()->create();

        Storage::fake('public');

        $image = UploadedFile::fake()->image('test.jpg');

        $product = [
            'category_id' => 1,
            'name' => 'pizza',
            'stock' => 2,
            'price' => 10000,
            'image' => $image
        ];

        $response = $this->actingAs($this->user)->postJson('/api/products',$product);

        $response->assertStatus(403);
    }

    public function test_show_detail_product()
    {
        $this->withoutMiddleware();

        $response = $this->actingAs($this->user)->getJson("/api/products/2");

        $response->assertStatus(200);
    }

    public function test_update_product_with_image()
    {
        $this->withoutMiddleware();

        Category::factory()->create();
        
        $image = UploadedFile::fake()->image('image.jpg');     

        $response = $this->actingAs($this->user)->putJson("/api/products/1", [
            'category_id' => 1,
            'name' => 'pizza updated',
            'stock' => 10,
            'price' => 10000,
            'image' => $image
        ]);

        $response->assertStatus(201);

        $response->assertJson([
            'message' => 'Success Updated Product',
        ]);
    }

    public function test_delete_product()
    {
        $this->withoutMiddleware();

        Storage::fake('public')->delete('public/products');

        $response = $this->actingAs($this->user)->deleteJson("/api/products/2");
    
        $response->assertStatus(200);

        $this->assertDatabaseMissing('products', ["id" => 2] );
    }

    private function createUser(): User
    {
        return User::factory()->create();
    }
}
