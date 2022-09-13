<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $category = $request->input('category') ?? '';
        $price = $request->input('price') ?? 0;
        $products = Product::getAll($category, $price);

        
        return response()->json([
            'products' => $products
        ]);
    }
}
