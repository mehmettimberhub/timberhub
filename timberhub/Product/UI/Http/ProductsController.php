<?php

namespace Timberhub\Product\UI\Http;

use Illuminate\View\View;
use Timberhub\Product\Domain\Models\Product;

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
