<?php

namespace App\Http\Controllers\Products;

use Illuminate\View\View;
use App\Models\Products\Product;

class ProductsController
{
    public function index() : View
    {
        return view('products.index');
    }

    public function create() : View
    {
        return view('products.create');
    }

    public function edit(Product $product) : View
    {
        return view('products.edit', ['product' => $product]);
    }
}
