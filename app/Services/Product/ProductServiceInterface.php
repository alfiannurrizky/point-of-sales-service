<?php

namespace App\Services\Product;
use App\Models\Product;
use Illuminate\Http\UploadedFile;

interface ProductServiceInterface
{
    public function getData();

    public function create(array $payload);

    public function uploadImage($image);

    public function showData(int $id);

    public function updateData(Product $product, array $payload);

    public function updateDataWithoutImage(Product $product, array $payload);

    public function reduceStock(Product $product, $qty);

    public function deleteData(Product $product);
}