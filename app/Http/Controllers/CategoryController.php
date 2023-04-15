<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use App\Services\Category\CategoryServiceInterface;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    protected $categoryService;

    public function __construct(CategoryServiceInterface $categoryService)
    {
        $this->middleware(['permission:categories.index|categories.create|categories.edit|categories.delete'])->except('index');
        
        $this->categoryService = $categoryService;
    }

    public function index()
    {
        $category = $this->categoryService->getAllData();

        return new CategoryResource(true, "List Data Category", $category);
    }

    public function store(CategoryRequest $request)
    {
        $payload = [
            'name' => $request->name
        ];
        
        $category = $this->categoryService->createData($payload);

        if($category)
        {
            return new CategoryResource(true, "Successfully Create Category", $category);
        }

        return new CategoryResource(false, 'Failed Create Category', null);

    }

    public function update(Request $request, Category $category)
    {
        $category = $this->categoryService->updateData($category, [
            'name' => $request->input('name')
        ]);
        
        if($category)
        {
            return new CategoryResource(true, 'Successfully Updated Category', $category);
        }

        return new CategoryResource(false, 'Failed Update Category', null);
    }
    public function show($id)
    {
        $category = $this->categoryService->showById($id);

        if($category)
        {
            return new CategoryResource(true, "Detail Category", $category);
        }

        return new CategoryResource(false, "Data Not Found", null);
    }

    public function destroy(Category $category)
    {
        $category = $this->categoryService->deleteData($category);

        return new CategoryResource(true, "Successfully Delete Category", $category);
    }
}
