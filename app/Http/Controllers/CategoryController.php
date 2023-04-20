<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    public function index(): \Illuminate\Http\JsonResponse
    {
        $categories = Category::all();
        if ($categories->isEmpty()) {
            return response()->json(['message' => 'No categories found'], 404);
        }
        return response()->json($categories);
    }

    public function store(Request $request): \Illuminate\Http\JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        $category = new Category([
            'name' => $request->input('name')
        ]);
        $category->save();
        return response()->json('Category created!');
    }

    public function show(int $id): \Illuminate\Http\JsonResponse
    {
        $category = Category::find($id);
        if (!$category) {
            return response()->json(['message' => 'Category not found'], 404);
        }
        return response()->json($category);
    }

    public function update(int $id, Request $request): \Illuminate\Http\JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        $category = Category::find($id);
        if (!$category) {
            return response()->json(['message' => 'Category not found'], 404);
        }
        $category->update([
            'name' => $request->input('name')
        ]);
        return response()->json('Category updated!');
    }

    public function destroy(int $id): \Illuminate\Http\JsonResponse
    {
        $category = Category::find($id);
        if (!$category) {
            return response()->json(['message' => 'Category not found'], 404);
        }
        $category->delete();
        return response()->json('Category deleted!');
    }
}
