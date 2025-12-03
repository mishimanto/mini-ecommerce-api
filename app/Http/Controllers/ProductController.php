<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // Public Products (search + pagination)
    public function index(Request $request)
    {
        $search = $request->query('search');

        $products = Product::when($search, function ($q) use ($search) {
            $q->where('name', 'like', "%$search%");
        })->paginate(5);

        return response()->json($products);
    }

    // Add product (Admin Only)
    public function store(Request $request)
    {
        if(auth()->user()->role !== 'admin'){
            return response()->json(['error'=>'Unauthorized'],403);
        }

        $request->validate([
            'name'=>'required',
            'price'=>'required|numeric',
            'stock'=>'required|integer'
        ]);

        $product = Product::create($request->all());

        return response()->json([
            'message'=>'Product added successfully',
            'product'=>$product
        ]);
    }
}