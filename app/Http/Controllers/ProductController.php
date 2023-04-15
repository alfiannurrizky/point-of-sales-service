<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use App\Services\Product\ProductServiceInterface;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    protected $productService;

    public function __construct(ProductServiceInterface $productService)
    {
        $this->middleware(['permission:products.index|products.create|products.edit|products.delete'])->except('index');

        $this->productService = $productService;
    }

    public function index()
    {
        $products = $this->productService->getData();

        return new ProductResource(true, 'List Data Product', $products);
    }

    public function store(ProductRequest $request)
    {
        $image = $request->file('image');

        $file = $this->productService->uploadImage($image);

        $product = $this->productService->create([
            'category_id' => $request->input('category_id'),
            'name' => $request->input('name'),
            'stock' => $request->input('stock'),
            'price' => $request->input('price'),
            'image' => $file
        ]);

        if($product)
        {
            return new ProductResource(true, 'Success Create Product', $product);
        }

        return new ProductResource(false, 'Failed Create Product', null);
    }

    public function update(ProductRequest $request, Product $product)
    {
        if($request->file('image'))
        {
            $image = $request->file('image');

            $file = $this->productService->uploadImage($image);

            $this->productService->updateData($product,[
                'category_id' => $request->input('category_id'),
                'name' => $request->input('name'),
                'stock' => $request->input('stock'),
                'price' => $request->input('price'),
                'image' => $file
            ]);
        }

        $this->productService->updateDataWithoutImage($product,$request->except(['image']));

        if($product)
        {
            return new ProductResource(true, 'Success Updated Product', $product);
        }

        return new ProductResource(false, 'Failed Updated Product', null);
    }

    public function show($id)
    {
        $product = $this->productService->showData($id);

        if($product)
        {
            return new ProductResource(true, 'Detail Data Product', $product);
        }

        return new ProductResource(false, 'Data Product Not Found', null);
    }

    public function destroy(Product $product)
    {
        $this->productService->deleteData($product);

        return new ProductResource(true, 'Success Deleted Product', null);
    }

    // public function reduceStock(Product $product, $amount)
    // {
    //     $product->stock -= $amount;
    //     $product->saveOrFail();
    // }
}
