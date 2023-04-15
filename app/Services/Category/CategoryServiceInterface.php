<?php

namespace App\Services\Category;
use App\Models\Category;

interface CategoryServiceInterface
{
    public function getAllData();

    public function createData(array $payload);

    public function showById(int $id);

    public function updateData(Category $category, array $payload);

    public function deleteData(Category $category);
}