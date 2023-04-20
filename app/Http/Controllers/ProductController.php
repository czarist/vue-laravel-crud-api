<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function index(): \Illuminate\Http\JsonResponse
    {
        $products = Product::all();
        if ($products->isEmpty()) {
            return response()->json(['message' => 'No products found'], 404);
        }
        return response()->json($products);
    }

    public function store(Request $request): \Illuminate\Http\JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'detail' => 'required',
            'category_id' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        $product = new Product([
            'name' => $request->input('name'),
            'detail' => $request->input('detail'),
            'category_id' => $request->input('category_id')
        ]);
        $product->save();
        return response()->json('Product created!');
    }

    public function show(int $id): \Illuminate\Http\JsonResponse
    {
        $product = Product::find($id);
        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }
        return response()->json($product);
    }

    public function update(int $id, Request $request): \Illuminate\Http\JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'detail' => 'required',
            'category_id' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        $product = Product::find($id);
        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }
        $product->update([
            'name' => $request->input('name'),
            'detail' => $request->input('detail'),
            'category_id' => $request->input('category_id')
        ]);
        return response()->json('Product updated!');
    }

    public function destroy(int $id): \Illuminate\Http\JsonResponse
    {
        $product = Product::find($id);
        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }
        $product->delete();
        return response()->json('Product deleted!');
    }

    public function categories(): \Illuminate\Http\JsonResponse
    {
        $categories = Category::all();
        if ($categories->isEmpty()) {
            return response()->json(['message' => 'No categories found'], 404);
        }
        return response()->json($categories);
    }
}
