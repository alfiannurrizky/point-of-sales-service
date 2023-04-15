<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CategoryTest extends TestCase
{
    use RefreshDatabase;

    private User $user;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = $this->createUser();
    }

    public function test_page_categories()
    {
        $response = $this->actingAs($this->user)->getJson('/api/categories');

        $response->assertStatus(200);
    }

    public function test_page_categories_not_found()
    {
        $response = $this->actingAs($this->user)->getJson('/api/categoriessss');

        $response->assertStatus(404);
    }

    public function test_unauthenticated_to_access_categories()
    {
        $response = $this->getJson('/api/categories');

        $response->assertStatus(401);
    }

    public function test_create_category()
    {
        $this->withoutMiddleware();

        $category = [
            "name" => 'soda'
        ];
        
        $response = $this->actingAs($this->user)->postJson('/api/categories', $category);

        $response->assertStatus(201);

        $response->assertJson([
            'message' => 'Successfully Create Category'
        ]);
    }

    public function test_non_admin_cannot_create_category()
    {
        $this->withMiddleware();

        $category = [
            "name" => 'food'
        ];
        
        $response = $this->actingAs($this->user)->postJson('/api/categories', $category);

        $response->assertStatus(403);

    }

    public function test_create_category_failed_required()
    {
        $this->withoutMiddleware();

        $category = [
            "name" => ''
        ];
        
        $response = $this->actingAs($this->user)->postJson('/api/categories', $category);

        $response->assertStatus(422);

        $response->assertInvalid(['name']);

        $response->assertJson([
            'message' => 'The name field is required.'
        ]);
    }

    public function test_show_detail_category()
    {
        $this->withoutMiddleware();

        $response = $this->actingAs($this->user)->getJson('/api/categories/1');

        $response->assertStatus(200);
    }

    public function test_updated_category()
    {
        $this->withoutMiddleware();

        Category::factory()->create();

        $response = $this->actingAs($this->user)->putJson('/api/categories/1',[
            'name' => 'food updated'
        ]);

        $response->assertStatus(201);

        $this->assertDatabaseHas('categories', ['name' => 'food updated']);
    }

    public function test_delete_category()
    {
        $this->withoutMiddleware();

        Category::factory()->create();

        $response = $this->delete('/api/categories/1');

        $response->assertStatus(200);
    }

    private function createUser(): User
    {
        return User::factory()->create();
    }
}
