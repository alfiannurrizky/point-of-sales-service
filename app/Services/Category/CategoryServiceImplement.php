<?php

namespace App\Services\Category;
use App\Models\Category;

class CategoryServiceImplement implements CategoryServiceInterface
{
    public function getAllData()
    {
        return Category::latest()->limit(5)->get();
    }

    public function createData(array $payload)
    {
        $category = new Category;

        $category->name = $payload['name'];
        $category->saveOrFail();

        return $category;
    }

    public function showById(int $id)
    {
        $category = Category::whereId($id)->first();

        return $category;
    }

    public function updateData(Category $category,array $payload)
    {
        $category->name = $payload['name'] ?? $category->name;

        $category->saveOrFail();

        return $category;

    }

    public function deleteData(Category $category)
    {
        $category->delete();
    }
}