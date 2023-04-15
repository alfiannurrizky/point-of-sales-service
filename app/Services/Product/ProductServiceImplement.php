<?php

namespace App\Services\Product;
use App\Http\Resources\ProductResource;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;

class ProductServiceImplement implements ProductServiceInterface
{
    public function getData()
    {
        $product = Product::with('category')->limit(5)->get();

        return $product;
    }

    public function create(array $payload)
    {
        $product = new Product;

        $product->category_id = $payload['category_id'];
        $product->name = $payload['name'];
        $product->stock = $payload['stock'];
        $product->price = $payload['price'];
        $product->image = $payload['image'];

        $product->saveOrFail();

        return $product;
    }

    public function uploadImage($image)
    {
        $fileName = $image->hashName();

        $path = $image->storeAs('/public/products', $fileName);

        return $fileName;
    }

    public function showData(int $id)
    {
        $product = Product::whereId($id)->first();

        return $product;
    }

    public function updateData(Product $product, array $payload)
    {
        Storage::disk('local')->delete('public/products/'.basename($product->image));

        $product->category_id = $payload['category_id'] ?? $product->category_id;
        $product->name  = $payload['name'] ?? $product->name;
        $product->stock = $payload['stock'] ?? $product->stock;
        $product->price = $payload['price'] ?? $product->price;
        $product->image = $payload['image'] ?? $product->image;

        $product->saveOrFail();

        return $product;
    }

    public function updateDataWithoutImage(Product $product, array $payload)
    {
        $product->category_id = $payload['category_id'] ?? $product->category_id;
        $product->name  = $payload['name'] ?? $product->name;
        $product->stock = $payload['stock'] ?? $product->stock;
        $product->price = $payload['price'] ?? $product->price;

        $product->saveOrFail();

        return $product;
    }

    public function reduceStock(Product $product, $qty)
    {
        $product->stock -= $qty;

        $product->saveOrFail();
    }

    public function deleteData(Product $product)
    {
        Storage::disk('local')->delete('public/products'.basename($product->image));

        $product->delete();
    }
}